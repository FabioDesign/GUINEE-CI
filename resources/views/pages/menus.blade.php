@extends('layouts.master')

@section('content')
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body py-4">
      <!--begin::Table-->
      <table id="kt_datatable" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
          <tr class="fw-bolder fs-6 text-gray-800 px-7">
            <th>#</th>
            <th>Libellé</th>
            <th>lien</th>
            <th class="text-center">Icone</th>
            <th class="text-center">Position</th>
            <th class="text-center">Statut</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
            foreach ($query as $data) :
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
            <td>{{ $i++ }}</td>
            <td>{{ $data->libelle }}</td>
            <td>{{ $data->target }}</td>
            <td class="text-center">{{ $data->icone }}</td>
            <td class="text-center">{{ $data->position }}</td>
            <td class="text-center"><span data-kt-element="status" class="badge {{ $badge }}">{{ $status }}</span></td>
            <td class="text-center">
              @if(in_array(3, $actionIds))
              <a href="#" class="modalform" data-h="{{ $data->id }}|menuForm|" data-bs-toggle="tooltip" data-bs-theme="tooltip-dark" data-bs-placement="top" title="Modifier le menu" submitbtn="Modifier"><i class="fas fa-edit fa-size text-warning"></i></a>
              @else
              <a href="#"><i class="fas fa-edit fa-size text-muted"></i></a>
              @endif
              @if(in_array(5, $actionIds))
              <a href="#" class="status" data-url="/menus/status/{{ $data->uid }}" data-bs-toggle="tooltip" data-bs-theme="tooltip-dark" data-bs-placement="top" title="{{ $action }} de le menu"><i class="fas fa-question fa-size text-danger"></i></a>
              @else
              <a href="#"><i class="fas fa-question fa-size text-muted"></i></a>
              @endif
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