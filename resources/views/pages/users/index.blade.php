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
            <th>Nom complet</th>
            <th>Genre</th>
            <th>Profil</th>
            <th>Contacts</th>
            <th>Date</th>
            <th class="text-center">Statut</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
            foreach ($query as $data) :
            $action = 'Activé';
            $badge = 'badge-light-danger';
            if ($data->status == 1) {
              $status = 'Activé';
              $action = 'Désactivé';
              $badge = 'badge-light-success';
            } else if ($data->status == 2)
              $status = 'Bloqué';
            else
              $status = 'Inactif';
          @endphp
          <tr>
            <td class="align-middle">{{ $i++ }}</td>
            <td class="align-middle">{{ $data->firstname . " " . $data->lastname }}</td>
            <td class="align-middle">{{ $data->gender }}</td>
            <td class="align-middle">{{ $data->profile->libelle }}</td>
            <td class="align-middle">{{ $data->number }}</td>
            <td class="text-center align-middle">{{ $data->created_at->format('d-m-Y H:i') }}</td>
            <td class="text-center align-middle"><span data-kt-element="status" class="badge {{ $badge }} fw-bold px-4 py-3">{{ $status }}</span></td>
            <td class="text-center align-middle">
              <a href="/users/{{ $data->uid }}" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Voir détail document"><i class="fas fa-eye fa-size text-primary me-1"></i></a>
              @if(in_array(3, $actionIds))
              <a href="/users/{{ $data->uid }}/edit" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Modifier l'utilisateur"><i class="fas fa-edit fa-size text-warning me-1"></i></a>
              @else
              <a href="#"><i class="fas fa-edit fa-size text-muted me-1"></i></a>
              @endif
              @if(in_array(4, $actionIds))
              <a href="#" class="status" data-url="/users/status/{{ $data->uid }}" data-type="PATCH" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="{{ $action }} l'utilisateur"><i class="fas fa-question fa-size text-info"></i></a>
              @else
              <a href="#"><i class="fas fa-question fa-size text-muted"></i></a>
              @endif
              @if(in_array(5, $actionIds))
              <a href="#" class="status" data-url="/users/{{ $data->uid }}" data-type="DELETE" data-bs-toggle="tooltip" data-bs-theme="dark" data-bs-placement="top" title="Supprimé l'utilisateur"><i class="fas fa-trash-alt fa-size text-danger"></i></a>
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