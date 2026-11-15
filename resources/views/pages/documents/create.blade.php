@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            <input type="hidden" id="rootForm" value="documents">
            <span class="msgError" style="display: none;"></span>
            <div class="row mb-5">
                <div class="col-md-6 col-12">
                    <label class="fw-bolder text-dark fs-5">Libellé : <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control requiredField" placeholder="Saisir le libellé" />
                </div>
                <div class="col-md-2 col-12">
                    <label class="fw-bolder text-dark fs-5">Code : <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control requiredField" placeholder="Saisir le code" />
                </div>
                <div class="col-md-2 col-12">
                    <label class="fw-bolder text-dark fs-5">Montant : <span class="text-danger">*</span></label>
                    <input type="text" name="price" class="form-control requiredField" placeholder="Saisir le montant" onKeyUp="verif_int(this)" />
                </div>
                <div class="col-md-2 col-12">
                    <label class="fw-bolder text-dark fs-5">Nombre : <span class="text-danger">*</span></label>
                    <input type="text" name="number" class="form-control requiredField" placeholder="Saisir le nombre" onKeyUp="verif_int(this)" />
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 col-12">
                    <label class="fw-bolder text-dark fs-5">Description : <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control requiredField" placeholder="Saisir la description"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 col-12">
                    <label class="fw-bolder text-dark fs-5">Pièces jointes : <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="row mb-2">
            @foreach ($query as $data)
                <div class="col-md-12 col-12 checkbox-inline">
                    <label class="boxcheck">
                        <input type="checkbox" name="file_id[]" value="{{ $data->id }}" class="iCheck" />
                        <span style="margin-left: 10px;">{{ $data->label }}</span>
                    </label>
                    <span style="margin-left: 10px;">
                        <a href="{{ asset('storage/' . $data->path) }}" target="_blank">
                            (Voir le spécimen)
                        </a>
                    </span>
                </div>
            @endforeach
            </div>
        </form>
    </div>
</div>
@endsection