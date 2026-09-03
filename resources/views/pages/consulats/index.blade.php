@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <!--begin::Table-->
      <table id="kt_datatable" class="table table-striped table-row-bordered gs-7 border rounded">
        <thead>
          <tr class="fw-bolder fs-6 text-gray-800">
            <th>#</th>
            <th>Pays</th>
            <th>Consulat</th>
            <th class="text-center w-70">Date</th>
            <th class="text-center">Statut</th>
            <th class="text-center w-170">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
            $href_edit = $class_status = $class_delete = '';
            $color_edit = $color_status = $color_delete = 'text-muted';
            if (in_array(5, $actionIds)) {
              $class_status = "status";
              $color_status = 'text-info';
            }
            if (in_array(4, $actionIds)) {
              $class_delete = "status";
              $color_delete = 'text-danger';
            }
            foreach ($query as $data) :
            if (in_array(3, $actionIds)) {
              $href_edit = "/consulats/{$data->uuid}/edit";
              $color_edit = 'text-warning';
            }
            if ($data->status == 1) {
              $status = 'Activé';
              $action = 'Désactivé';
              $badge = 'badge-light-success';
            } else {
              $status = 'Désactivé';
              $action = 'Activé';
              $badge = 'badge-light-danger';
            }
          @endphp
          <tr>
            <td class="align-middle">{{ $i++ }}</td>
            <td class="align-middle">
              <img src="/assets/flags/{{ $data->country->alpha }}.svg" alt="{{ $data->country->country }}" class="h-20px me-2" /> 
              {{ $data->country->country }}
            </td>
            <td class="align-middle">{{ $data->label }}</td>
            <td class="text-center align-middle">{{ $data->created_at->format('d-m-Y H:i') }}</td>
            <td class="text-center align-middle"><span data-kt-element="status" class="badge {{ $badge }} fw-bold px-4 py-3">{{ $status }}</span></td>
            <td class="text-end align-middle">
              <a href="/consulats/{{ $data->uuid }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir détail du consulat" class="btn btn-icon btn-bg-light btn-sm me-1">
                <i class="ki-duotone ki-text-align-center text-primary fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </a>
              <a href="{{ $href_edit }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le consulat" class="btn btn-icon btn-bg-light btn-sm me-1">
                <i class="ki-duotone ki-pencil {{ $color_edit }} fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </a>
              <a href="#" data-url="/consulats/status/{{ $data->uuid }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $action }} le consulat" class="btn btn-icon btn-bg-light btn-sm me-1 {{ $class_status }}">
                <i class="ki-duotone ki-filter {{ $color_status }} fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </a>
              <a href="#" data-url="/consulats/{{ $data->uuid }}" data-type="DELETE" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimé le consulat" class="btn btn-icon btn-bg-light btn-sm {{ $class_delete }}">
                <i class="ki-duotone ki-trash {{ $color_delete }} fs-2">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
                  <span class="path4"></span>
                  <span class="path5"></span>
                </i>
              </a>
            </td>
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