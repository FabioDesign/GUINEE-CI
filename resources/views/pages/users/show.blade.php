@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css"/>
    <link href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            <input type="hidden" id="code" value="{{ $query->code }}">
            <input type="hidden" id="alpha" value="{{ $code->alpha }}">
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5 code">Civilité :</label>
                    <input type="text" value="{{ $query->civility }}" class="form-control" />
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom :</label>
                    <input type="text" value="{{ $query->lastname }}" class="form-control" />
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Prénoms :</label>
                    <input type="text" value="{{ $query->firstname }}" class="form-control" />
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone :</label>
                    <input type="text" id="number" value="{{ $query->number }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Email :</label>
                    <input type="text" value="{{ $query->email }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Profession :</label>
                    <input type="text" value="{{ $query->profession }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Profil :</label>
                    <input type="text" value="{{ $query->profile->libelle }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Ambassade :</label>
                    <select id="embassy_id" class="form-control">
						<option data-alpha="{{ $query->country->alpha }}" data-code="+{{ $query->country->code }}">{{ $query->country->libelle }}</option>
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nationalité :</label>
                    <select id="nationality_id" class="form-control">
						<option data-alpha="{{ $query->nationality->alpha }}" data-code="+{{ $query->nationality->code }}">{{ $query->nationality->libelle }}</option>
					</select>
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Date de naissance :</label>
                    <input type="text" value="{{ $query->birthday_at->format('d-m-Y') }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Pays de naissance :</label>
                    <select id="pays_id" class="form-control">
						<option value="" selected disabled>Sélectionner</option>
						@foreach($pays as $data)
							<option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == $ville->country_id ? 'selected':'' @endphp>{{ $data->libelle }}</option>
						@endforeach
					</select>
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Préfecture de naissance :</label>
                    <input type="text" value="{{ $query->town->libelle }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Lieu de naissance :</label>
                    <input type="text" value="{{ $query->birthplace }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms du père :</label>
                    <input type="text" value="{{ $query->father_fullname }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms de la mère :</label>
                    <input type="text" value="{{ $query->mother_fullname }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Taille :</label>
                    <input type="text" value="{{ $query->size }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Teint :</label>
                    <input type="text" value="{{ $query->complexion }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Cheveux :</label>
                    <input type="text" value="{{ $query->hairs }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Signes particuliers :</label>
                    <input type="text" value="{{ $query->particular_sign }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Adresse domiciliale :</label>
                    <input type="text" value="{{ $query->home_address }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Date d'arrivée :</label>
                    <input type="text" value="{{ $query->arrival_at->format('d-m-Y') }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-5">
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Nom et prénoms :</label>
                    <input type="text" value="{{ $query->person_fullname }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone :</label>
                    <input type="text" value="{{ $query->person_number }}" class="form-control">
                </div>
                <div class="col-md-4 col-12">
                    <label class="fw-bolder text-dark fs-5">Adresse :</label>
                    <input type="text" value="{{ $query->person_address }}" class="form-control">
                </div>
            </div>
            <div class="row form-group fv-row mb-2">
                <div class="col-md-6 col-12 text-center position-relative">
                    @php $signature = $query->signature ? asset('storage/' . $query->signature) : ''; @endphp
                    <img id="previewSignature" class="img-responsive" src="{{ $signature }}">
                </div>
                <div class="col-md-6 col-12 text-center position-relative mt-2">
                    @php $stamp = $query->stamp ? asset('storage/' . $query->stamp) : ''; @endphp
                    <img id="previewStamp" class="img-responsive" src="{{ $stamp }}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
	<script src="/assets/js/custom/select2.js"></script>
    <script>
        $(document).ready(function() {

            const input = document.querySelector("#number");

            const iti = window.intlTelInput(input, {
                initialCountry: "gn", // Guinée par défaut
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

            $('.iti__selected-dial-code').html('+' + $('#code').val());
            $('.iti__flag').removeClass('iti__gn').addClass('iti__' + $('#alpha').val());
        });
    </script>
@endsection