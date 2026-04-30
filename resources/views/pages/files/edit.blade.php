@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <form class="formField">
        @method('PUT')
        <input type="hidden" id="rootForm" value="files/{{ $query->uid }}">
        <div class="row mb-2">
            <div class="col-md-6 col-12">
                <label class="fw-bolder text-dark fs-5">Libellé : <span class="text-danger">*</span></label>
                <input type="text" name="libelle" class="form-control requiredField" placeholder="Saisir le libellé" value="{{ old('libelle', $query->libelle) }}" />
            </div>

            <div class="col-md-6 col-12">
                <label class="fw-bolder text-dark fs-5">Spécimen : <span class="text-danger">*</span></label>
                <input type="file" id="specimen" name="specimen" class="form-control requiredField" accept=".png,.jpg,.jpeg" />
            </div>
        </div>
        <span class="msgError" style="display: none;"></span>
        <!-- Aperçu image -->
        <div class="mt-3 text-center">
          @php $style = $query->specimen ? "" : "display: none;"; @endphp
          <img id="previewImage" src="{{ asset('storage/' . $query->specimen) }}" alt="{{ $query->libelle }}" style="{{ $style }}">
        </div>
      </form>
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
@endsection