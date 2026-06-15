@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
      <form class="formField">
        <div class="row mb-5">
            <div class="col-md-6 col-12">
                <label class="fw-bolder text-dark fs-5">Libellé :</label>
                <input type="text" value="{{ $query->label }}" class="form-control" />
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Montant :</label>
                <input type="text" value="{{ $query->amount }}" class="form-control" />
            </div>
            <div class="col-md-3 col-12">
                <label class="fw-bolder text-dark fs-5">Nombre de jours :</label>
                <input type="text" value="{{ $query->day }}" class="form-control" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 col-12">
                <label class="fw-bolder text-dark fs-5">Description :</label>
                <textarea class="form-control">{{ $query->description }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 col-12">
                <label class="fw-bolder text-dark fs-5">Pièces jointes :</label>
            </div>
        </div>
        <div class="row mb-2">
        @foreach ($docFiles as $docFile)
            <div class="col-md-12 col-12 checkbox-inline">
                <label class="boxcheck">
                    <input type="checkbox" class="iCheck" readonly checked />
                    <span style="margin-left: 10px;">{{ $docFile->file->label }}</span>
                </label>
            </div>
        @endforeach
        </div>
      </form>
    </div>
  </div>
@endsection