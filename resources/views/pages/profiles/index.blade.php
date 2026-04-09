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
            <th>Description</th>
            <th class="text-center">Date</th>
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
            <td>{{ $data->description }}</td>
            <td class="text-center">{{ $data->created_at->format('d-m-Y H:i') }}</td>
            <td class="text-center"><span data-kt-element="status" class="badge {{ $badge }} fw-bold px-4 py-3">{{ $status }}</span></td>
            <td class="text-center">
              <a href="/profiles/{{ $data->uid }}" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Voir détail profil"><i class="fas fa-eye fa-size text-primary me-1"></i></a>
              @if(in_array(3, $actionIds))
              <a href="/profiles/{{ $data->uid }}/edit" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Modifier profil"><i class="fas fa-edit fa-size text-warning me-1"></i></a>
              @else
              <a href="#"><i class="fas fa-edit fa-size text-muted me-1"></i></a>
              @endif
              @if(in_array(5, $actionIds))
              <a href="#" class="status" data-url="/profiles/status/{{ $data->uid }}" data-type="PATCH" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="{{ $action }} le profil"><i class="fas fa-question fa-size text-info"></i></a>
              @else
              <a href="#"><i class="fas fa-question fa-size text-muted"></i></a>
              @endif
              @if(in_array(5, $actionIds))
              <a href="#" class="status" data-url="/profiles/{{ $data->uid }}" data-type="DELETE" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Supprimé le profil"><i class="fas fa-trash-alt fa-size text-danger"></i></a>
              @else
              <a href="#"><i class="fas fa-trash-alt fa-size text-muted"></i></a>
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