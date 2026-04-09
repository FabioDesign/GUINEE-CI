@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <form class="formField">
        <input type="hidden" id="rootForm" value="profiles">
        <div class="row form-group fv-row mb-2">
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Libellé : <span class="text-danger">*</span></label>
            <input type="text" name="libelle" class="form-control requiredField" placeholder="Saisir le libellé" />
          </div>
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Description : <span class="text-danger">*</span></label>
            <input type="text" name="description" class="form-control requiredField" placeholder="Saisir la description" />
          </div>
        </div>
        <div class="row form-group fv-row mt-10 mb-2">
          <label class="col-sm-12 col-xl-12 col-form-label text-lg-right fw-bolder text-dark fs-5">
            <span class="me-3">Gestion des permissions</span>
          </label>
        </div>
        @foreach($menusWithActions as $menu)
          <div class="row form-group fv-row mb-2">
            <label class="col-sm-12 col-xl-2 col-form-label text-lg-right fw-bolder text-dark fs-5">{{ $menu->libelle }}</label>
            <div class="col-sm-12 col-xl-10 checkbox-inline">
                @foreach($menu->actions as $action)
                  @php $class = $action->id == 1 ? 'show' : 'check'; @endphp
                  <label class="boxcheck"><input type="checkbox" name="permissions[]" value="{{ $menu->id . '|' . $action->id }}" class="iCheck checked {{ $class }}"> <span style="margin: 0 15px 0 3px;">{{ $action->libelle }}</span></label>
                @endforeach
            </div>
          </div>
        @endforeach
        <span class="msgError" style="display: none;"></span>
      </form>
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
@endsection