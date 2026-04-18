@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <!--begin::Table-->
      <table id="kt_datatable" class="table table-striped table-row-bordered gs-7 border rounded">
        <thead>
          <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>#</th>
            <th>Acteur</th>
            <th>Profil</th>
            <th class="text-center">Action</th>
            <th>Libellé</th>
            <th class="text-center">Date</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
            foreach ($query as $data) :
          @endphp
          <tr>
            <td class="align-middle">{{ $i++ }}</td>
            <td class="d-flex align-items-center">
              <!--begin:: Avatar -->
              <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                <a href="#">
                  <div class="symbol-label">
                    <img src="{{ asset('storage/' . $data->avatar) }}" alt="{{ $data->username }}" class="w-100" />
                  </div>
                </a>
              </div>
              <!--end::Avatar-->
              <!--begin::User details-->
              <div class="d-flex flex-column">
                <a href="#" class="text-gray-800 text-hover-primary mb-1">{{ $data->username }}</a>
              </div>
              <!--begin::User details-->
            </td>
            <td class="align-middle">{{ $data->profil }}</td>
            <td class="text-center align-middle"><span class="badge badge-light-{{ $data->color }} fw-bold px-4 py-3">{{ $data->action }}</span></td>
            <td class="align-middle">{{ $data->libelle }}</td>
            <td class="text-center align-middle">{{ $data->created_at->format('d-m-Y H:i') }}</td>
          </tr>
          @php endforeach; @endphp
        </tbody>
      </table>
      <!--end::Table-->
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
@endsection