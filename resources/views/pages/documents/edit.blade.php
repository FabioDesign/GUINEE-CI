@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            @method('PUT')
            <input type="hidden" id="rootForm" value="documents/{{ $query->uuid }}">
            <span class="msgError" style="display: none;"></span>
            <div class="row mb-5">
                <div class="col-md-6 col-12">
                    <label class="fw-bolder text-dark fs-5">Libellé : <span class="text-danger">*</span></label>
                    <input type="text" name="label" value="{{ old('label', $query->label) }}" class="form-control requiredField" placeholder="Saisir le libellé" />
                </div>
                <div class="col-md-3 col-12">
                    <label class="fw-bolder text-dark fs-5">Montant : <span class="text-danger">*</span></label>
                    <input type="text" name="price" value="{{ old('price', $query->price) }}" class="form-control requiredField" placeholder="Saisir le montant" onKeyUp="verif_int(this)" />
                </div>
                <div class="col-md-3 col-12">
                    <label class="fw-bolder text-dark fs-5">Nombre de jours : <span class="text-danger">*</span></label>
                    <input type="text" name="number" value="{{ old('number', $query->number) }}" class="form-control requiredField" placeholder="Saisir le nombre" onKeyUp="verif_int(this)" />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 col-12">
                    <label class="fw-bolder text-dark fs-5">Description : <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control requiredField" placeholder="Saisir la description">{{ old('description', $query->description) }}</textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 col-12">
                    <label class="fw-bolder text-dark fs-5">Pièces jointes : <span class="text-danger">*</span></label>
                </div>
            </div>
            <div class="row mb-2">
            @php $selectedFileIds = $docFiles->pluck('file_id')->all(); @endphp
            @foreach ($files as $file)
                @php $check = in_array($file->id, $selectedFileIds, true) ? 'checked' : ''; @endphp
                <div class="col-md-12 col-12 checkbox-inline">
                    <label class="boxcheck">
                        <input type="checkbox" name="file_id[]" value="{{ $file->id }}" class="iCheck" {{ $check }} />
                        <span style="margin-left: 10px;">{{ $file->label }}</span>
                    </label>
                    <span style="margin-left: 10px;">
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank">
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