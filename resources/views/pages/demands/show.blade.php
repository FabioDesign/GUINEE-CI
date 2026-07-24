@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <!--begin::Wizard-->
        <div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first" data-wizard-clickable="true" data-kt-stepper="false">
            <div class="row justify-content-center my-10 px-8 px-lg-10">
                <div class="col-xl-12 col-xxl-7">
                    <!--begin::Form Wizard Form-->
                    <form class="formField" id="kt_contact_add_form" data-wizard-validation="false">
                        <input type="hidden" id="rootForm" value="demands">
                        <input type="hidden" id="user_id" name="user_id" value="0">
                        <input type="hidden" id="codeDoc" name="codeDoc" value="{{ old('code', $firstDoc->code) }}">
                        <input type="hidden" id="step2" value="0">
                        <input type="hidden" id="step3" value="0">
                        <div class="body-step4 pb-5" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de l'utilisateur</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-2 col-12">
                                    <label class="fs-5">Civilité : <span class="civility fw-bold fs-5 text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Nom : <span class="lastname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Prénoms : <span class="firstname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="phone_number fw-bold fs-5 text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Email : <span class="email fw-bold fs-5 text-lowercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Date de naissance : <span class="birthday_at fw-bold fs-5 text-dark">@php echo date('d-m-Y') @endphp</span></label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Lieu de naissance : <span class="birthplace fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">
                                        Pays de naissance : 
                                        <span class="country_id fw-bold fs-5 text-uppercase text-dark">                                            
                                        @foreach($country as $data)
                                            @php echo $data->id == 61 ? $data->country : '' @endphp
                                        @endforeach
                                        </span>
                                </label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Préfecture de naissance : <span class="town_id fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Profession : <span class="profession fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">
                                        Nationalité : 
                                        <span class="nationality_id fw-bold fs-5 text-uppercase text-dark">
                                        @foreach($nationality as $data)
                                            @php echo $data->id == 61 ? $data->nationality : '' @endphp
                                        @endforeach
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms du père : <span class="father_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms de la mère : <span class="mother_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Taille : <span class="size fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Teint : <span class="complexion fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Cheveux : <span class="hairs fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Date d'arrivée : <span class="arrival_at fw-bold fs-5 text-dark">@php echo date('d-m-Y') @endphp</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Signes particuliers : <span class="particular_sign fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Domicile : <span class="home_address fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-4">Personne à prévenir :</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms : <span class="person_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="person_number fw-bold fs-5 text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Adresse : <span class="person_address fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de la demande</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="document_id fw-bold fs-4 text-uppercase text-dark">{{ $firstDoc->label }}</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Nombre : <span class="number fw-bold fs-5 text-uppercase text-dark">{{ $firstDoc->number }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Montant : <span class="price fw-bold fs-5 text-uppercase text-dark">{{ number_format($firstDoc->price, 0, ',', ' ') }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Copie : <span class="copy fw-bold fs-5 text-uppercase text-dark">1</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Total : <span class="total fw-bold fs-5 text-uppercase text-dark">{{ number_format($firstDoc->price, 0, ',', ' ') }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 text-gray-700 fw-bolder fs-4">Documents joints</div>
                            </div>
                            <div class="files-valid"></div>
                        </div>
                        <!--end::Form Wizard Step 4-->
                    </form>
                    <!--end::Form Wizard Form-->
                </div>
            </div>
        </div>
        <!--end::Wizard-->
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/assets/js/custom/wizard.js?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
            // Masquer les boutons précédent et envoyer
            $('.btn-previous, .btn-submit').hide();
            $(document).on('click', '.user-item', function (e) {
                // éviter de déclencher 2 fois si on clique directement sur le radio
                if (!$(e.target).is('input')) {
                    $(this).find('input[type="radio"]').iCheck('check');
                }
            });
            // Rechercher les utilisateurs
            $(document).on('keyup', '#search', function() {
                // Initialiser l'ID de l'utilisateur à 0
                $('#user_id').val(0);
                let emptyUsers = `
                    <div class="mh-375px scroll-y me-n7 pe-7">
                        <div class="fw-semibold">
                            <span class="fs-6 text-gray-800">Aucun utilisateur trouvé</span>
                        </div>
                    </div>
                `;
                $('#users-list').html(emptyUsers);
                let search = $('#search').val();
                if (search.length > 1) {
                    const searchUsers = async () => {
                        try {
                            const response = await axios.post('/searchUsers', {
                                search: search
                            }, {
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            });
                            return response.data.data || [];
                        } catch (e) {
                            console.error(e);
                            return [];
                        }
                    }

                    searchUsers().then(
                        response => {
                            let outUsers = ``;
                            if (response.length > 0) {
                                response.map(data => {
                                    outUsers += `
                                        <!--begin::Users-->
                                        <div class="mh-375px scroll-y me-n7 pe-7">
                                            <!--begin::User-->
                                            <a class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1 user-item">
                                                <!--begin::Avatar-->
                                                <label class="boxcheck"><input type="radio" name="user" value="${data.id}" class="iCheck user_id"></label>
                                                <div class="symbol symbol-35px symbol-circle mx-5">
                                                    <img src="/storage/${data.avatar}" alt="${data.username}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Info-->
                                                <div class="fw-semibold">
                                                    <div class="fs-6 text-gray-800 me-2">${data.username}</div>
                                                    <div class="fs-6 badge badge-primary">${data.nationality}</div>
                                                </div>
                                                <!--end::Info-->
                                            </a>
                                            <!--end::User-->
                                        </div>
                                    `;
                                });
                            } else {
                                outUsers += emptyUsers;
                            }
                            $('#users-list').html(outUsers);
                            $('.iCheck').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                                increaseArea: '20%'
                            });
                        }
                    );
                }
            });
            // Récupérer l'ID de l'utilisateur sélectionné
            $(document).on('ifChecked', '.user_id', function(event) {
                $('#user_id').val($(this).parents('label').find('input').val());
                let id = $('#user_id').val();
				if (!id) return;
                // Récupérer les informations de l'utilisateur
                const getUsers = async (id) => {
                    try {
                        const response = await axios.get( `/getUsers/${id}`);
                        return response.data?.data || null;
                    } catch (e) {
                        console.error(e);
                    }
                }
                getUsers(id).then(
                    response => {
                        if (response) {
                            $('#lastname').val(response.user.lastname);
                            $('.lastname').text(response.user.lastname);
                            $('#firstname').val(response.user.firstname);
                            $('.firstname').text(response.user.firstname);
                            $('#email').val(response.user.email);
                            $('.email').text(response.user.email);
                            phoneInstances["phone_number"].setCountry(response.phone.alpha);
                            $('#phone_number').val(response.user.phone_number);
                            $('.phone_number').text(`+${response.user.phone_code} ${response.user.phone_number}`);
                            $('#profession').val(response.user.profession);
                            $('.profession').text(response.user.profession);
                            $('#nationality_id').val(response.user.nationality_id);
                            $('.nationality_id').text(response.user.nationality_id);
                            $('#town_id').val(response.user.town_id);
                            document.querySelector("#birthday_at")._flatpickr.setDate(response.user.birthday_at);
                            let birthday_date = response.user.birthday_at.slice(0, 10);
                            let birthday_parts = birthday_date.split('-');
                            let birthday_at = `${birthday_parts[2]}-${birthday_parts[1]}-${birthday_parts[0]}`;
                            $('.birthday_at').text(birthday_at);
                            $('#birthplace').val(response.user.birthplace);
                            $('.birthplace').text(response.user.birthplace);
                            $('#father_fullname').val(response.user.father_fullname);
                            $('.father_fullname').text(response.user.father_fullname);
                            $('#mother_fullname').val(response.user.mother_fullname);
                            $('.mother_fullname').text(response.user.mother_fullname);
                            $('#size').val(response.user.size);
                            $('.size').text(response.user.size);
                            $('#complexion').val(response.user.complexion);
                            $('.complexion').text(response.user.complexion);
                            $('#hairs').val(response.user.hairs);
                            $('.hairs').text(response.user.hairs);
                            $('#particular_sign').val(response.user.particular_sign);
                            $('.particular_sign').text(response.user.particular_sign);
                            $('#home_address').val(response.user.home_address);
                            $('.home_address').text(response.user.home_address);
                            document.querySelector("#arrival_at")._flatpickr.setDate(response.user.arrival_at);
                            let arrival_date = response.user.arrival_at.slice(0, 10);
                            let arrival_parts = arrival_date.split('-');
                            let arrival_at = `${arrival_parts[2]}-${arrival_parts[1]}-${arrival_parts[0]}`;
                            $('.arrival_at').text(arrival_at);
                            $('#person_fullname').val(response.user.person_fullname);
                            $('.person_fullname').text(response.user.person_fullname);
                            phoneInstances["person_number"].setCountry(response.person.alpha);
                            $('#person_number').val(response.user.person_number);
                            $('.person_number').text(`+${response.user.person_code} ${response.user.person_number}`);
                            $('#person_address').val(response.user.person_address);
                            $('.person_address').text(response.user.person_address);
                            $('#civility').html(response.civility.map(civility => 
    `<option value="${civility}" ${civility == response.user.civility ? 'selected' : ''}>${civility}</option>`
).join(''));
                            $('.civility').text(response.user.civility);
                            $('#nationality_id').html(response.nationality.map(nationality => `<option value="${nationality.id}" data-alpha="${nationality.alpha}" data-code="+${nationality.code}" ${nationality.id == response.user.nationality_id ? 'selected' : ''}>${nationality.nationality}</option>`).join(''));
                            $('.nationality_id').text(response.label_nation);
                            $('#country_id').html(response.country.map(country => `<option value="${country.id}" data-alpha="${country.alpha}" data-code="+${country.code}" ${country.id == response.ville.country_id ? 'selected' : ''}>${country.country}</option>`).join(''));
                            $('#town_id').html(response.town.map(town => `<option value="${town.id}" ${town.id == response.user.town_id ? 'selected' : ''}>${town.label}</option>`).join(''));
                            $('.town_id').text(response.ville.label);
                            $('#step2').val(1);
                        }
                    }
                );
            });
            // Rechercher les documents
            $(document).on('change', '#document_id', function() {
                let id = $(this).val();
				if (!id) return;
                const getDocs = async (id) => {
                    try {
                        const response = await axios.get( `/getDocs/${id}`);
                        return response.data?.data || null;
                    } catch (e) {
                        console.error(e);
                    }
                }
                getDocs(id).then(
                    response => {
                        if (response) {
                            $('#copy').val(1);
                            $('#codeDoc').val(response.docs.code);
                            $('#number').val(response.docs.number);
                            $('.number').text(response.docs.number);
                            $('#price, #total').val(response.docs.price);
                            $('.price, .total').text(response.docs.price);
                            $('.files-list').html(response.files.map(file => `<div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fw-bolder text-dark fs-6">
                                        ${file.label} : <span class="text-danger">*</span>
                                        <a href="/storage/${file.path}" target="_blank">
                                        (Voir le specimen)
                                        </a>
                                    </label>
                                    <input type="file" name="filename[${file.id}]" class="form-control filename" data-id="${file.id}" data-label="${file.label}" accept=".pdf,.png,.jpg,.jpeg" />
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="file-view fw-bolder text-dark fs-6 mt-10" style="display: none;">
                                        <a href="" class="file-link" target="_blank">
                                        (Voir la pièce jointe)
                                        </a>
                                        &nbsp;&nbsp;
                                        <span class="btn btn-icon btn-circle btn-active-color-danger w-25px h-25px bg-body shadow btn-remove" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Supprimer le fichier" data-bs-original-title="Supprimer le fichier" data-kt-initialized="1">
                                            <i class="ki-duotone ki-cross fs-3 text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </label>
                                </div>
                            </div>`).join(''));
                            dmdForm();
                        }
                    }
                );
            });
            // Bouton précédent
            $('.btn-previous').on('click', function() {
                var step = $(this).data('step') - 1;
                $('.btn-step').data('step', step).attr('data-step', step);
                // Step 1
                if (step == 1) {
                    $('.btn-previous').hide();
                    $('.body-step1').addClass('current');
                    $('.body-step2').removeClass('current');
                    $('.header-step2').removeAttr('data-wizard-state');
                    $('.btn-next').addClass('btn-primary').removeClass('not-active');
                }
                // Step 2
                if (step == 2) {
                    $('.body-step2').addClass('current');
                    $('.body-step3').removeClass('current');
                    $('.header-step3').removeAttr('data-wizard-state');
                }
                // Step 3
                if (step == 3) {
                    $('.body-step3').addClass('current');
                    $('.body-step4').removeClass('current');
                    $('.header-step4').removeAttr('data-wizard-state');
                    $('.btn-next').show();
                    $('.btn-submit').hide();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            // Bouton suivant
            $('.btn-next').on('click', function () {
                // Gestion visibilité des boutons
                $('.btn-previous').show();
                var step = $(this).data('step') + 1;
                // Action de data-wizard-type="action-next"
                $('.btn-step').data('step', step).attr('data-step', step);
                // Step 2
                if (step == 2) {
                    let step2 = $('#step2').val();
                    if (step2 == 0) {
                        $('.btn-next').addClass('not-active');
                    } else {
                        $('.btn-next').addClass('btn-primary').removeClass('not-active');
                    }
                    $('.body-step2').addClass('current');
                    $('.body-step1').removeClass('current');
                    $('.header-step2').attr('data-wizard-state', 'current');
                }
                // Step 3
                if (step == 3) {
                    let step3 = $('#step3').val();
                    if (step3 == 0) {
                        $('.btn-next').addClass('not-active');
                    } else {
                        $('.btn-next').addClass('btn-primary').removeClass('not-active');
                    }
                    $('.body-step3').addClass('current');
                    $('.body-step2').removeClass('current');
                    $('.header-step3').attr('data-wizard-state', 'current');
                }
                // Step 4
                if (step == 4) {
                    $('.body-step4').addClass('current');
                    $('.body-step3').removeClass('current');
                    $('.header-step4').attr('data-wizard-state', 'current');
                    $('.btn-next').hide();
                    $('.btn-submit').show();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            // Changement du pays
            $(document).on('change', '#country_id', function() {
                $('.userError').show().html("Veuillez renseigner tous les champs obligatoires.");
                $('.btn-next').addClass('not-active').removeClass('btn-primary');
            });
            // Changement de la civilité et de la préfecture
            $(document).on('change', '#civility, #town_id', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                userForm();
            });
            // Zone de texte Utilisateur
            $(document).on('keyup', '.requiredUser', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                userForm();
            });
            // Zone de email
            $(document).on('keyup', '.email', function() {
                let value = jQuery.trim($(this).val());
                if (value != '') {
                    let regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (!regex.test(value)) {
                        $('#step2').val(0);
                        $('.userError').show().html("Adresse e-mail non valide.");
                        $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    } else userForm();
                } else userForm();
            });
            // Validation du formulaire de l'utilisateur
            function userForm() {
                var sum = 0;
                $('.body-step2 .requiredUser').each(function() {
                    let value = $(this).attr('name') == undefined ? 0 : 1;
                    if (value == 1) {
                        sum += $(this).data('valid');
                    }
                });
                if (sum > 0) {
                    $('#step2').val(0);
                    $('.userError').show().html("Veuillez renseigner tous les champs obligatoires.");
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                } else {
                    $('#step2').val(1);
                    $('.userError').hide().html("");
                    $('.btn-next').addClass('btn-primary').removeClass('not-active');
                }
            }
            // Zone de Montant et de Copie
            $(document).on('keyup', '#price, #copy', function() {
                let price = parseInt($('#price').val()) || 0;
                let copy = parseInt($('#copy').val()) || 1;
                let total = price * copy;
                $('#total').val(total);
                $('.total').text(total);
            });
            // Validation + affichage fichier
            $(document).on('change', '.filename', function() {
                $('.dmdError').html('');
                // Récupérer le fichier
                var input = this;
                var fileObj = input.files[0];
                // Si le fichier n'est pas sélectionné, retourner.
                if (!fileObj) return;
                // Récupérer la taille du fichier
                var iSize = fileObj.size;
                var fileName = fileObj.name.toLowerCase();
                var iExt = fileName.split('.').pop();
                // Les types autorisés : PDF ou Image.
                var ValidTypes = ['pdf', 'jpg', 'jpeg', 'png'];
                // Les types autorisés : PDF ou Image.
                if ($.inArray(iExt, ValidTypes) < 0) {
                    $('#step3').val(0);
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    $('.dmdError').html('Les types autorisés : PDF ou Image.');
                    return;
                }
                // Taille max : 2MB.
                if (iSize > 2000000) {
                    $('#step3').val(0);
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    $('.dmdError').html('Taille max : 2MB.');
                    return;
                }
                // Récupérer la ligne correspondante
                var parentRow = $(this).closest('.row');
                var fileView = parentRow.find('.file-view');
                var fileLink = parentRow.find('.file-link');
                // Récupérer l'ID et le label du fichier
                var docId = $(this).data('id');
                var label = $(this).data('label');
                // URL temporaire
                var fileURL = URL.createObjectURL(fileObj);
                // Injecter lien
                fileLink.attr('href', fileURL);
                // Afficher le bloc
                fileView.show();
                // Supprimer ancienne ligne si existe
                $('.files-valid').find('[data-id="'+docId+'"]').remove();
                // Ajouter dans la liste
                var html = `
                    <div class="mb-2 d-flex align-items-center" data-id="${docId}">
                        <i class="ki-duotone ki-check following fs-3 me-3"></i> ${label} : 
                        <a href="${fileURL}" target="_blank" class="text-primary ms-2">(Voir la pièce jointe)</a>
                    </div>
                `;
                $('.files-valid').append(html);
                // Activer bouton suivant
                dmdForm();
            });
            // Supprimer le fichier
            $(document).on('click', '.btn-remove', function() {
                $('#step3').val(0);
                $('.btn-next').addClass('not-active').removeClass('btn-primary');
                $('.dmdError').show().html("Veuillez renseigner la pièce jointe.");
                var parentRow = $(this).closest('.row');
                var input = parentRow.find('.filename');
                var docId = input.data('id');
                // reset input file
                input.val('');
                // cacher le lien
                parentRow.find('.file-view').hide();
                // vider le lien
                parentRow.find('.file-link').attr('href', '');
                // supprimer dans la liste
                $('.files-valid').find('[data-id="'+docId+'"]').remove();
            });
            // Zone de texte Document
            $(document).on('keyup', '.requiredDmd', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                dmdForm();
            });
            // Validation du formulaire de l'document
            function dmdForm() {
                var sum = 0;
                $('.body-step3 .requiredDmd').each(function() {
                    let value = $(this).attr('name') == undefined ? 0 : 1;
                    if (value == 1) {
                        sum += $(this).data('valid');
                    }
                });
                if (sum > 0) {
                    $('#step3').val(0);
                    $('.dmdError').show().html("Veuillez renseigner tous les champs obligatoires.");
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                } else {
                    $('#step3').val(1);
                    $('.dmdError').hide().html("");
                    $('.btn-next').addClass('btn-primary').removeClass('not-active');
                }
            }
            // Champs texte / input
            var textFields = [
                'lastname', 'firstname', 'phone_number', 'email', 'profession', 'birthplace', 'father_fullname', 'mother_fullname', 'size', 'complexion', 'hairs', 'particular_sign', 'home_address', 'person_fullname', 'person_number', 'person_address', 'number', 'price', 'copy', 'total',
            ];
            $.each(textFields, function (i, field) {
                $('[name="' + field + '"]').on('keyup change', function () {
                    if ((field == 'phone_number') || (field == 'person_number')) {
                        let number = $(this).val();
                        let code = phoneInstances[field].getSelectedCountryData().dialCode;
                        $('.' + field).text(`+${code} ${number}`);
                    } else {
                        $('.' + field).text($(this).val());
                    }
                });
            });
            // Dates : reformatage Y-m-d → d-m-Y
            var dateFields = ['birthday_at', 'arrival_at'];
            $.each(dateFields, function (i, field) {
                $('[name="' + field + '"]').on('change', function () {
                    var val = $(this).val();
                    if (val) {
                        var parts     = val.split('-');
                        var formatted = parts[2] + '-' + parts[1] + '-' + parts[0];
                        $('.' + field).text(formatted);
                    } else {
                        $('.' + field).text('');
                    }
                });
            });
            var selectFields = [
                'civility', 'country_id', 'town_id', 'nationality_id', 'document_id',
            ];
            $.each(selectFields, function (i, field) {
                $('[name="' + field + '"]').on('change', function () {
                    $('.' + field).text($('option:selected', this).text());
                });
            });
        });
    </script>
@endsection