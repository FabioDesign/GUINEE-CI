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
                        <input type="hidden" id="uuid" value="{{ $query->uuid }}">
                        <div class="body-step4 pb-5" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de l'utilisateur</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-2 col-12">
                                    <label class="fs-5">Civilité : <span class="fw-bold fs-5 text-dark">{{  optional($query->user)->civility }}</span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Nom : <span class="fw-bold fs-5 text-dark">{{ optional($query->user)->lastname }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Prénoms : <span class="firstname fw-bold fs-5 text-dark">{{ optional($query->user)->firstname }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="phone_number fw-bold fs-5 text-dark">+{{ optional($query->user)->phone_code }} {{ optional($query->user)->phone_number }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Email : <span class="email fw-bold fs-5 text-lowercase text-dark">{{ optional($query->user)->email }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Date de naissance : <span class="birthday_at fw-bold fs-5 text-dark">{{ optional($query->user)->birthday_at->format('d/m/Y') }}</span></label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Lieu de naissance : <span class="birthplace fw-bold fs-5 text-dark">{{ optional($query->user)->birthplace }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Pays de naissance : <span class="country fw-bold fs-5 text-dark">{{ $country->country }}</span></label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Préfecture de naissance : <span class="town_id fw-bold fs-5 text-dark">{{ $prefecture->label }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Profession : <span class="profession fw-bold fs-5 text-dark">{{ optional($query->user)->profession }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nationalité : <span class="nationality fw-bold fs-5 text-dark">{{ optional($query->user)->nationality->nationality }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Noms du père : <span class="father_fullname fw-bold fs-5 text-dark">{{ optional($query->user)->father_fullname }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Noms de la mère : <span class="mother_fullname fw-bold fs-5 text-dark">{{ optional($query->user)->mother_fullname }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Taille : <span class="size fw-bold fs-5 text-dark">{{ optional($query->user)->size }}</span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Teint : <span class="complexion fw-bold fs-5 text-dark">{{ optional($query->user)->complexion }}</span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Cheveux : <span class="hairs fw-bold fs-5 text-dark">{{ optional($query->user)->hairs }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Date d'arrivée : <span class="arrival_at fw-bold fs-5 text-dark">{{ optional($query->user)->arrival_at->format('d/m/Y') }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Signes particuliers : <span class="particular_sign fw-bold fs-5 text-dark">{{ optional($query->user)->particular_sign }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Domicile : <span class="home_address fw-bold fs-5 text-dark">{{ optional($query->user)->home_address }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-4">Personne à prévenir :</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms : <span class="person_fullname fw-bold fs-5 text-dark">{{ optional($query->user)->person_fullname }}</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="person_number fw-bold fs-5 text-dark">+{{ optional($query->user)->person_code }} {{ optional($query->user)->person_number }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Adresse : <span class="person_address fw-bold fs-5 text-dark">{{ optional($query->user)->person_address }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de la demande</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="document_id fw-bold fs-4 text-dark">{{ optional($query->document)->label }}</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Nombre : <span class="number fw-bold fs-5 text-dark">{{ $query->number }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Montant : <span class="price fw-bold fs-5 text-dark">{{ number_format(optional($query->document)->price, 0, ',', ' ') }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Copie : <span class="copy fw-bold fs-5 text-dark">{{ $query->copy }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Total : <span class="total fw-bold fs-5 text-dark">{{ number_format($query->price, 0, ',', ' ') }}</span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 text-gray-700 fw-bolder fs-4">Documents joints</div>
                            </div>
                            <div class="row mb-5">
                                @foreach ($docFiles as $docFile)
                                    <div class="mb-2 d-flex align-items-center">
                                        <i class="ki-duotone ki-check following fs-3 me-3"></i> {{ $docFile->file->label }} : 
                                        <a href="{{ asset('storage/' . $docFile->path) }}" target="_blank" class="text-primary ms-2">(Voir la pièce jointe)</a>
                                    </div>
                                @endforeach
                            </div>
                            @if($query->motif)
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-5">Motif du rejet :</label>
                                    <textarea class="form-control" readonly>{{ $query->motif }}</textarea>
                                </div>
                            </div>
                            @endif
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
    <script>
		$(document).on('click', '.btn-rjt', function() {
			Swal.fire({
				title: 'Rejeter la demande',
				text: 'Veuillez confirmer votre action.',
				icon: 'warning',
				input: "textarea",
				inputPlaceholder: "Veuillez saisir le motif du rejet...",
    			inputAttributes: { required: true },
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirmer',
				cancelButtonText: 'Annuler',
				inputValidator: (value) => {
					if (!value || !value.trim()) {
						return "<span style='color: #f27474;font-weight: 600;'>Le motif du rejet est obligatoire !</span>";
					}
					if (value.trim().length < 10) {
						return "<span style='color: #f27474;font-weight: 600;'>Veuillez fournir un motif plus détaillé.</span>";
					}
				},
			}).then((result) => {
				if (result.isConfirmed) {
					const motif = result.value.trim();
					// Afficher un chargement
					Swal.fire({
						title: 'Traitement en cours...',
						text: 'Rejet de la demande en cours',
						allowOutsideClick: false,
						didOpen: () => {
							Swal.showLoading();
						}
					});
					// Appel AJAX
					axios.post('/reject', {
						motif: motif,
						uuid: $('#uuid').val()
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