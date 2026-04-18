//Nombre entier
function verif_int(champ) {
  var chiffres = new RegExp('[0-9]');
  for(x = 0; x < champ.value.length; x++) {
    verif = chiffres.test(champ.value.charAt(x));
    if (verif == false) {
      champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;
    }
  }
}
//Cocher afficher
$(document).on('ifChecked', '.check', function(event) {
  $(this).parents('.boxcheck').siblings().find('.show').each(function() {
    $(this).parent().addClass('checked');
    $(this).attr('checked', 'checked');
  });
});
$(document).on('ifUnchecked', '.show', function(event) {
  $(this).parents('.boxcheck').siblings().find('input:checkbox').each(function() {
    $(this).parent().removeClass('checked');
    $(this).removeAttr('checked');
  });
});
//Checkbox
$('.iCheck').iCheck({
  checkboxClass: 'icheckbox_square-blue',
  radioClass: 'iradio_square-blue',
  increaseArea: '20%'
});
//View Password
$('.viewPass, .backPass').on('click', function() {
  var password = $(this).siblings('input');
  if (password.attr('type') == 'password') {
    password.attr('type', 'text');
    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
  } else{
    password.attr('type', 'password');
    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
  }
});
$('#specimen').on('change', function() {
  let file = this.files[0];
  if (file) {
    // ✅ Vérifier que c’est bien une image
    if (!file.type.startsWith('image/')) {
      $('.msgError').html("Veuillez sélectionner une image valide !");
      $(this).val('');
      $('#previewImage').hide();
      return;
    }
    let reader = new FileReader();
    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result).fadeIn(); // effet sympa
    }
    reader.readAsDataURL(file);
  }
});
//X-CSRF-TOKEN
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
// Gestionnaire pour le changement de statut
$(document).on('click', '.status', function(e) {
  e.preventDefault();
  var urlStatus = $(this).data('url');
  var typeStatus = $(this).data('type');
  var actionTitle = $(this).attr('data-bs-original-title') || $(this).attr('title');
  Swal.fire({
    title: actionTitle,
    text: 'Veuillez confirmer votre action.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Confirmer',
    cancelButtonText: 'Annuler'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: urlStatus,
        type: 'POST',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content'),
          _method: typeStatus
        },
        beforeSend: function() {
          Swal.fire({
            title: 'Chargement en cours...',
            text: 'Veuillez patienter...',
            timer: 50000,
            showConfirmButton: false,
          }).then(function(result) {
            if (result.dismiss === "timer") {
              console.log("I was closed by the timer")
            }
          })
        },
        success: function(response) {
          var splitter = response.split('|');
          if (splitter[0] == '1') {
            Swal.fire({
              title: "Félicitation !",
              text: splitter[1],
              icon: 'success',
              confirmButtonText: "Fermer",
              customClass:{
                confirmButton: "btn btn-square font-weight-bold btn-light-success"
              }
            }).then(function() {
              location.reload();
            });
          } else if (splitter[0] == '0') {
            Swal.fire({
              title: 'Erreur !',
              text: splitter[1],
              icon: 'error',
              confirmButtonText: 'Fermer',
              customClass: {
                confirmButton: "btn btn-square font-weight-bold btn-light-success"
              },
            });
          } else if (response == 'x') {
            window.location.href = '/';
          }
        },
        error: function(xhr) {
          Swal.fire({
            title: 'Erreur!',
            text: 'Une erreur est survenue.',
            icon: 'error',
          });
        }
      });
    }
  });
});
//Form Add/Mod
$(document).on('click', '.submitForm', function(e) {
  e.preventDefault();
  let iCheck = false;
  let hasError = false;
  $('.msgError').html('');
  let submitForm = $(this).html();
  $('.is-invalid').removeClass('is-invalid');
  let rootForm = $('#rootForm').val();
  let datasT = new FormData();
  $('.formField').find('input, select, textarea').each(function() {
    if ($(this).is(':input:file')) {
      if ($(this).val() !== '') datasT.append(this.name, $(this)[0].files[0]);
    } else if ($(this).is(':checkbox')) {
      if ($(this).is(':checked')) {
        datasT.append(this.name, $(this).val());
        iCheck = true;
      }
    } else if ($(this).is(':radio')) {
      if ($(this).is(':checked')) {
        datasT.append(this.name, $(this).val());
        iCheck = true;
      }
    } else datasT.append(this.name, $(this).val());
  });
  $('.formField .requiredField').each(function() {
    if (jQuery.trim($(this).val()) === '') {
      $('.msgError').html("Veuillez renseigner les champs obligatoires !");
      $(this).addClass('is-invalid');
      hasError = true;
    }
  });
  $('.formField .checked').each(function() {
    if (!hasError) {
      if (!iCheck) {
        $('.msgError').html('Veuillez cocher au moins une case.');
        $(this).addClass('is-invalid');
        hasError = true;
      }
    }
  });
  $('.formField .number').each(function() {
    if (!hasError) {
      let value = jQuery.trim($(this).val());
      let regex = /^[0-9\s]*$/;
      if ((value != '')&&(!regex.test(value))) {
        $('.msgError').html("Téléphone non valide.");
        $(this).addClass('is-invalid');
        hasError = true;
      }
    }
  });
  $('.formField .email').each(function() {
    if (!hasError) {
      let value = jQuery.trim($(this).val());
      let regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if ((value != '')&&(!regex.test(value))) {
        $(this).addClass('is-invalid');
        $('.msgError').html("Adresse e-mail non valide.");
        hasError = true;
      }
    }
  });
  $('.formField .password').each(function() {
    if (!hasError) {
      if ($(this).val().length < 5) {
        $('.msgError').html("Les mots de passe doivent être supérieur à 5 caractères");
        $(this).addClass('is-invalid');
        hasError = true;
      } else if ($('#newpass').val() !== $('#confirmpass').val()) {
        $('.msgError').html("Les mots de passe ne sont pas identiques");
        $('#newpass, #confirmpass').addClass('is-invalid');
        hasError = true;
      }
    }
  });
  if (!hasError) {
    $.ajax({
      type: 'POST',
      data: datasT,
      contentType: false, 
      processData: false,
      url: '/'+ rootForm,
      beforeSend: function() {
        $('.submitForm').addClass('not-active').html('<i class="fa fa-spinner fa-pulse"></i> Patienter...');
      },
      success:function(response) {
        let splitter = response.split('|');
        if (splitter[0] == 'x') {
          location.href = '/';
        } else if (splitter[0] != 0) {
          $('#modalform').hide();
          swal.fire({
            title: "Félicitation !",
            text: splitter[1],
            icon: 'success',
            confirmButtonText: "Fermer",
            customClass:{
              confirmButton: "btn btn-square font-weight-bold btn-light-success"
            }
          }).then(function() {
            if (splitter[0] == 1)
              location.reload();
            else
              location.href = '/';
          });
        } else{
          $('.msgError').html(splitter[1]);
          $(splitter[2]).addClass('is-invalid');
          $('.submitForm').removeClass('not-active').addClass('btn-success').html(submitForm);
        }
      }
    });
  }
});