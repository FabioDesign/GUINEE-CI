@extends('layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
  <div class="card-body py-4">
    <form class="formField">
      @method('PUT')
      <input type="hidden" id="rootForm" value="towns/{{ $query->uid }}">
        <div class="row mb-2">
          <div class="col-md-6 col-12">
            <label class="fw-bolder text-dark fs-5">Pays : <span class="text-danger">*</span></label>
            <select id="country_id" name="country_id" class="form-control">
              <option value="" selected disabled>Sélectionner</option>
              @foreach($list as $data)
							<option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == $query->country_id ? 'selected':'' @endphp>{{ $data->libelle }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 col-12">
            <label class="fw-bolder text-dark fs-5">Ville : <span class="text-danger">*</span></label>
            <input type="text" name="libelle" value="{{ old('libelle', $query->libelle) }}" class="form-control requiredField" placeholder="Saisir la ville" />
          </div>
      </div>
      <span class="msgError" style="display: none;"></span>
    </form>
  </div>
</div>
@endsection

@section('scripts')
  <script src="/assets/js/custom/select2.js"></script>
  <script>
    $(document).ready(function() {
      $('#country_id').select2({
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
    });
  </script>
@endsection