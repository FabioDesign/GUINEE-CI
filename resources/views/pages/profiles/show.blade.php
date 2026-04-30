@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <form class="formField">
        <div class="row mb-2">
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Libellé :</label>
            <input type="text" class="form-control" value="{{ $query->libelle }}" readonly />
          </div>
          <div class="col-lg-6">
            <label class="fw-bolder text-dark fs-5">Description :</label>
            <input type="text" class="form-control" value="{{ $query->description }}" readonly />
          </div>
        </div>
        <div class="row mb-2">
          <label class="col-sm-12 col-xl-12 col-form-label text-lg-right fw-bolder text-dark fs-5">
            <span class="me-3">Gestion des permissions</span>
          </label>
        </div>
        @foreach($menusWithActions as $menu)
          <div class="row mb-2">
            <label class="col-md-2 col-12 col-form-label text-lg-right fw-bolder text-dark fs-5">{{ $menu->libelle }}</label>
            <div class="col-md-10 col-12 checkbox-inline">
                @foreach($menu->actions as $action)
                  @php
                    $isChecked = in_array($menu->id . '|' . $action->id, $currentPermissions);
                    $check = $isChecked ? 'checked' : '';
                  @endphp
                  <label class="boxcheck">
                    <input type="checkbox" class="iCheck" {{ $check }}>
                    <span style="margin: 0 15px 0 3px;">{{ $action->libelle }}</span>
                  </label>
                @endforeach
            </div>
          </div>
        @endforeach
      </form>
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
@endsection