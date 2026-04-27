@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css"/>
    <link href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            <input type="hidden" id="rootForm" value="users">
            <span class="msgError" style="display: none;"></span>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Civilité : <span class="text-danger">*</span></label>
                    <select name="civility" class="form-control requiredField">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($civility as $civil)
							<option value="{{ $civil }}">{{ $civil }}</option>
						@endforeach
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom : <span class="text-danger">*</span></label>
                    <input type="text" name="lastname" class="form-control requiredField" placeholder="Saisir nom" />
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Prénoms : <span class="text-danger">*</span></label>
                    <input type="text" name="firstname" class="form-control requiredField" placeholder="Saisir prénoms" />
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone : <span class="text-danger">*</span></label>
                    <input type="text" id="number" name="number" class="form-control requiredField number" onKeyUp="verif_int(this)">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Email : <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control requiredField email" placeholder="Saisir email">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Profession : <span class="text-danger">*</span></label>
                    <input type="text" name="profession" class="form-control requiredField" placeholder="Saisir profession">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Profil : <span class="text-danger">*</span></label>
                    <select id="profile_id" name="profile_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($profile as $data)
							<option value="{{ $data->id }}">{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Ambassade : <span class="text-danger">*</span></label>
                    <select id="embassy_id" name="embassy_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($country as $data)
							<option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}">{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nationalité : <span class="text-danger">*</span></label>
                    <select id="nationality_id" name="nationality_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($nationality as $data)
							<option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == 38 ? 'selected':'' @endphp>{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Date de naissance : <span class="text-danger">*</span></label>
                    <input type="text" name="birthday_at" class="form-control requiredField date_at" placeholder="Saisir date de naissance">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Pays de naissance : <span class="text-danger">*</span></label>
                    <select id="pays_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($pays as $data)
							<option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == 61 ? 'selected':'' @endphp>{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Préfecture de naissance : <span class="text-danger">*</span></label>
                    <select id="town_id" name="town_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($town as $data)
							<option value="{{ $data->id }}">{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Lieu de naissance : <span class="text-danger">*</span></label>
                    <input type="text" name="birthplace" class="form-control requiredField" placeholder="Saisir lieu de naissance">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms du père : <span class="text-danger">*</span></label>
                    <input type="text" name="father_fullname" class="form-control requiredField" placeholder="Saisir nom et prénoms du père">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms de la mère : <span class="text-danger">*</span></label>
                    <input type="text" name="mother_fullname" class="form-control requiredField" placeholder="Saisir nom et prénoms de la mère">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Taille : <span class="text-danger">*</span></label>
                    <input type="text" name="size" class="form-control requiredField" placeholder="Saisir taille">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Teint : <span class="text-danger">*</span></label>
                    <input type="text" name="complexion" class="form-control requiredField" placeholder="Saisir teint">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Cheveux : <span class="text-danger">*</span></label>
                    <input type="text" name="hairs" class="form-control requiredField" placeholder="Saisir cheveux">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Signes particuliers : <span class="text-danger">*</span></label>
                    <input type="text" name="particular_sign" class="form-control requiredField" placeholder="Saisir signes particuliers">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Adresse domiciliale : <span class="text-danger">*</span></label>
                    <input type="text" name="home_address" class="form-control requiredField" placeholder="Saisir adresse domiciliale">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Date d'arrivée : <span class="text-danger">*</span></label>
                    <input type="text" name="arrival_at" class="form-control requiredField date_at" placeholder="Saisir date d'arrivée">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms : <span class="text-danger">*</span></label>
                    <input type="text" name="person_fullname" class="form-control requiredField" placeholder="Saisir nom complet (Personne à prévenir)">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone : <span class="text-danger">*</span></label>
                    <input type="text" name="person_number" class="form-control requiredField" placeholder="Saisir numéro (Personne à prévenir)">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Adresse : <span class="text-danger">*</span></label>
                    <input type="text" name="person_address" class="form-control requiredField" placeholder="Saisir adresse (Personne à prévenir)">
                </div>
            </div>
            <div class="row form-group fv-row mb-2">
                <div class="col-md-6 col-12">
                    <label class="fw-bolder text-dark fs-5">Signature :</label>
                    <input type="file" id="signature" name="signature" class="form-control" accept=".png,.jpg,.jpeg" />
                </div>
                <div class="col-md-6 col-12">
                    <label class="fw-bolder text-dark fs-5">Cachet :</label>
                    <input type="file" id="stamp" name="stamp" class="form-control" accept=".png,.jpg,.jpeg" />
                </div>
            </div>
            <div class="row form-group fv-row mb-2">
                <div class="col-md-6 col-12 text-center position-relative mt-2">
                    <img id="previewSignature" class="img-responsive" />
                    <button type="button" id="remove_sig" class="btn btn-sm btn-danger btn-remove" style="display: none;">
                        ✕
                    </button>
                </div>
                <div class="col-md-6 col-12 text-center position-relative mt-2">
                    <img id="previewStamp" class="img-responsive" />
                    <button type="button" id="remove_sta" class="btn btn-sm btn-danger btn-remove" style="display: none;">
                        ✕
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
	<script src="/assets/js/custom/flatpickr_fr.js"></script>
	<script src="/assets/js/custom/select2.js"></script>
    <script>
        $(document).ready(function() {
            $(".date_at").flatpickr({
                locale: "fr",
                altInput: true,
                altFormat: "d-m-Y",
                dateFormat: "Y-m-d",
                maxDate: "today",
            });
            
            const input = document.querySelector("#number");

            const iti = window.intlTelInput(input, {
                initialCountry: "gn", // Côte d'Ivoire 🇨🇮
                separateDialCode: true,
                preferredCountries: ["gn", "ci"],
                utilsScript: "/assets/js/custom/utils.js"
            });
            $('#embassy_id, #pays_id, #nationality_id').select2({
                placeholder: "Sélectionner un pays",
                width: '100%',

                templateResult: formatCountry,
                templateSelection: formatCountrySelection,

                escapeMarkup: function (markup) {
                    return markup;
                }
            });
            function formatCountry(country) {
                if (!country.id) return country.text;

                let code = $(country.element).data('code');
                let flag = $(country.element).data('alpha').toLowerCase();

                return `
                    <span>
                        <span class="fi fi-${flag}" style="margin-right:8px;"></span>
                        ${country.text} (${code})
                    </span>
                `;
            }

            function formatCountrySelection(country) {
                if (!country.id) return country.text;

                let code = $(country.element).data('code');
                let flag = $(country.element).data('alpha').toLowerCase();

                return `
                    <span>
                        <span class="fi fi-${flag}" style="margin-right:5px;"></span>
                        ${country.text} (${code})
                    </span>
                `;
            }
            const selectFields = [
                { selector: '#profile_id', placeholder: "Sélectionner le profil" },
                { selector: '#town_id', placeholder: "Sélectionner la préfecture" }
            ];

            selectFields.forEach(field => {
                $(field.selector).select2({
                    width: '100%',
                    placeholder: field.placeholder
                });
            });
        });
    </script>
@endsection