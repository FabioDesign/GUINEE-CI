@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
      <!--begin::Card title-->
      <div class="card-title">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
          <!--begin::Select-->
				  <select id="tableLength" class="form-select form-select-sm form-select-solid w-80px" data-control="select2" data-hide-search="true">
            <option value="" disabled>Afficher</option>
            <option value="10" selected="selected">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <!--end::Select-->
        </div>
        <!--end::Toolbar-->
      </div>
      <!--begin::Card title-->
      <!--begin::Card toolbar-->
      <div class="card-toolbar">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
          <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
          <input type="text" id="tableSearch" class="form-control form-control-solid form-select-sm w-200px ps-9" placeholder="Rechercher..." />
        </div>
        <!--end::Search-->
      </div>
      <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-2">
      <!--begin::Table-->
      <div class="table-responsive" id="tableData">
        <div class="loading-spinner text-center mt-10">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
          </div>
          <div class="mt-5">Chargement des données...</div>
        </div>
      </div>
      <!--end::Table-->
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
@endsection

@section('scripts')
  <script>
    const actionIds = {{ json_encode($actionIds) }};
    const getDemands = async () => {
      try {
        const response = await axios.get( '/getDemands');
        return response.data.data || [];
      } catch (e) {
        console.error(e);
        return [];
      }
    }

    getDemands().then(
      response => {
        if (response.length > 0) {
          let i = 1;
          let outTable = `
            <table id="dmdTable" class="table table-striped table-row-bordered gs-7 border rounded align-middle">
              <thead>
                <tr class="fw-bolder text-gray-800 fs-6">
                  <th>#</th>
                  <th>Requérant</th>
                  <th>Document</th>
                  <th class="text-center">Jours</th>
                  <th class="text-center">Copies</th>
                  <th class="text-center">Montant</th>
                  <th class="text-center">Statut</th>
                  <th class="text-center" width="90">Actions</th>
                </tr>
              </thead>
              <tbody class="text-gray-600 fw-semibold">
          `;
				  response.map(data => {
            switch (data.status) {
              case 0:
                status = 'Brouillon';
                color = 'badge-light-info';
                break;
              case 1:
                status = 'Transmise';
                color = 'badge-light-warning';
                break;
              case 2:
                status = 'Validée';
                color = 'badge-light-success';
                break;
              case 3:
                status = 'Rejetée';
                color = 'badge-light-danger';
                break;
              default:
                status = 'N/A';
                color = 'badge-light-secondary';
            }
            if (data.recovered_at) {
              tit = 'Récupérée';
              color = 'badge-light-success';
            } else {
              tit = 'Récupérée';
              color = 'badge-light-success';
            }
            outTable += `<tr>
              <td>${i}</td>
              <td>${data.user}</td>
              <td>${data.label}</td>
              <td class="text-center">${data.number}</td>
              <td class="text-center">${data.copy}</td>
              <td class="text-center">${data.price}</td>
              <td class="text-center align-middle"><span data-kt-element="status" class="badge ${color} fw-bold px-4 py-3">${status}</span></td>
              <td class="text-center align-middle">
                <a href="/demands/${data.uuid}" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir détail de la demande" class="btn btn-icon btn-bg-light btn-sm me-1">
                  <i class="ki-duotone ki-switch text-primary fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                  </i>
                </a>`;
                if (actionIds.includes(3) && data.status == 0) {
                  outTable += `<a href="/demands/${data.uuid}/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier la demande" class="btn btn-icon btn-bg-light btn-sm me-1">
                    <i class="ki-duotone ki-pencil text-warning fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </a>`;
                }
                if (actionIds.includes(9) && data.status == 2) {
                  outTable += `<a href="${data.path}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Imprimer la demande" class="btn btn-icon btn-bg-light btn-sm me-1">
                    <i class="ki-duotone ki-printer text-warning fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </a>`;
                }
                if (actionIds.includes(10) && data.status == 2 && !data.recovered_at) {
                  outTable += `<a href="#" data-uuid="${data.uuid}" data-delivered_at="${data.delivered_at}" data-bs-toggle="tooltip" data-bs-placement="top" title="Récupérer la demande" class="btn btn-icon btn-bg-light btn-sm btn-recup me-1">
                    <i class="ki-duotone ki-message-text-2 text-info fs-2">
                      <span class="path1"></span>
                      <span class="path2"></span>
                    </i>
                  </a>`;
                }
                outTable += `</td></tr>`;
            i++;
          });
          outTable += `</tbody></table>`;
          $('#tableData').html(outTable);
              
          // Initialiser DataTable avec pagination et recherche
          dmdTable = $('#dmdTable').DataTable({
            paging: true,
            searching: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            info: false,
            ordering: true,
            responsive: true,
            dom: 'rtip', // Masquer les contrôles par défaut de DataTables
          });
          
          // Personnaliser la recherche
          $('#tableSearch').on('keyup', function() {
            dmdTable.search(this.value).draw();
          });
          
          // Personnaliser le nombre d'entrées affichées
          $('#tableLength').on('change', function() {
            dmdTable.page.len(this.value).draw();
          });
          
          // Mettre à jour le sélecteur de longueur lorsque DataTable change
          dmdTable.on('length.dt', function(e, settings, length) {
            $('#tableLength').val(length);
          });
        }
      }
    );
    $(document).on('click', '.btn-recup', function() {
      const uuid = $(this).data('uuid');
      const date = $(this).data('delivered_at');
			Swal.fire({
        title: 'Récupérer la demande',
        text: 'Veuillez saisir la date de récupération.',
        icon: 'warning',
        input: "text",
        inputPlaceholder: "JJ-MM-AAAA HH:MM",
        inputAttributes: { required: true },
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Valider',
        cancelButtonText: 'Annuler',
        didOpen: () => {
          const input = Swal.getInput();
          input.setAttribute('readonly', true);
          flatpickr(input, {
            locale: "fr",
            enableTime: true,
            time_24hr: true,
            dateFormat: "d-m-Y H:i",
            defaultDate: "today",
            maxDate: "today",
            minDate: date,
            allowInput: false,
          });
        },
        inputValidator: (value) => {
          if (!value || !value.trim()) {
            return "<span style='color: #f27474;font-weight: 600;'>La date de récupération est obligatoire !</span>";
          }
        }
      }).then((result) => {
				if (result.isConfirmed) {
					const date = result.value.trim();
					// Afficher un chargement
					Swal.fire({
						title: 'Traitement en cours...',
						text: 'Récupération de la demande en cours',
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});
					// Appel AJAX
					axios.patch('/recover', {
						date: date,
						uuid: uuid
					}).then(response => {
						if (response.data.status == 1) {
							Swal.fire({
								title: "Félicitation !",
								text: response.data.message,
								icon: 'success',
								confirmButtonText: "Fermer",
								customClass:{
									confirmButton: "btn btn-square font-weight-bold btn-light-success"
								}
							}).then(function() {
								location.reload();
							});
						} else {
							Swal.fire({
								title: 'Erreur !',
								text: response.data.message,
								icon: 'error',
								confirmButtonText: 'Fermer',
								customClass: {
									confirmButton: "btn btn-square font-weight-bold btn-light-success"
								},
							});
						}
					})
					.catch(error => {
						Swal.fire({
							title: 'Erreur !',
							text: 'Une erreur est survenue lors du rejet',
							icon: 'error',
							confirmButtonText: "Fermer",
							customClass:{
								confirmButton: "btn btn-square font-weight-bold btn-light-success"
							}
						});
					});
				}
			});
		});
  </script>
@endsection