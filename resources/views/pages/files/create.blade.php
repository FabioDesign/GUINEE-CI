@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            <input type="hidden" id="rootForm" value="files">
            <div class="row form-group fv-row mb-2">
                <div class="col-lg-6">
                    <label class="fw-bolder text-dark fs-5">Libellé : <span class="text-danger">*</span></label>
                    <input type="text" name="libelle" class="form-control requiredField" placeholder="Saisir le libellé" />
                </div>

                <div class="col-lg-6">
                    <label class="fw-bolder text-dark fs-5">Spécimen : <span class="text-danger">*</span></label>
                    <input type="file" id="specimen" name="specimen" class="form-control requiredField" accept=".png,.jpg,.jpeg" />
                </div>
            </div>
            <span class="msgError" style="display: none;"></span>
            <!-- Aperçu image -->
            <div class="mt-3 text-center">
              <img id="previewImage" alt="Aperçu de l'image" style="display: none;" />
            </div>
        </form>
    </div>
</div>
@endsection