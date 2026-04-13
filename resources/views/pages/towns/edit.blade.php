@extends('layouts.master')

@section('content')
<div class="card">
  <div class="card-body py-4">
    <form class="formField">
      @method('PUT')
      <input type="hidden" id="rootForm" value="towns/{{ $town->uid }}">
        <div class="row form-group fv-row mb-2">
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Pays : <span class="text-danger">*</span></label>
            <select id="country_id" name="country_id" class="form-control">
              <option value="" selected disabled>Sélectionner</option>
              @foreach($query as $data)
                <option value="{{ $data->id }}" @php echo $data->id == $town->country_id ? 'selected':'' @endphp>{{ $data->libelle }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Ville : <span class="text-danger">*</span></label>
            <input type="text" name="libelle" value="{{ old('libelle', $town->libelle) }}" class="form-control requiredField" placeholder="Saisir la ville" />
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
        placeholder: "Sélectionner le pays",
        width: '100%'
      });
    });
</script>
@endsection