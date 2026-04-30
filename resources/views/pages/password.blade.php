@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body py-4">
        <form class="formField">
            @method('PUT')
            <input type="hidden" id="rootForm" value="password">
            <span class="msgError" style="display: none;"></span>
            <div class="row mb-5">
                <div class="col-md-4 col-12 position-relative">
                    <label class="fw-bolder text-dark fs-5">Ancien mot de passe : <span class="text-danger">*</span></label>
                    <input type="password" name="oldpass" class="form-control requiredField" placeholder="Saisir ancien mot de passe" />
                    <i class="fa fa-eye-slash backPass"></i>
                </div>
                <div class="col-md-4 col-12 position-relative">
                    <label class="fw-bolder text-dark fs-5">Nouveau mot de passe : <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control requiredField" placeholder="Saisir nouveau mot de passe" />
                    <i class="fa fa-eye-slash backPass"></i>
                </div>
                <div class="col-md-4 col-12 position-relative">
                    <label class="fw-bolder text-dark fs-5">Confirmer mot de passe : <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control requiredField" placeholder="Saisir confirmer mot de passe" />
                    <i class="fa fa-eye-slash backPass"></i>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection