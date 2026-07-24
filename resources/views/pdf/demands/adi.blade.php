@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin:50px 0 80px;">
  <tr>
    {{-- ── Champs du demandeur ──────────────────────────────────── --}}
    <td width="75%" style="vertical-align:top;">
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">NOM</td>
          <td class="field-value">: {{ $dataPDF['lastname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PRÉNOM(S)</td>
          <td class="field-value">: {{ $dataPDF['firstname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">{{ $dataPDF['sex'] == 'M' ? 'NÉ' : 'NÉE' }} LE</td>
          <td class="field-value">: {{ $dataPDF['birthday_at'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">À</td>
          <td class="field-value">: {{ $dataPDF['birthplace'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PRÉFECTURE</td>
          <td class="field-value">: {{ $dataPDF['prefecture'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">
            {{ $dataPDF['sex'] == 'M' ? 'FILS' : 'FILLE' }} DE :
          </td>
          <td class="field-value">: {{ $dataPDF['father'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">ET DE</td>
          <td class="field-value">: {{ $dataPDF['mother'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PROFESSION</td>
          <td class="field-value">: {{ $dataPDF['profession'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">TAILLE</td>
          <td class="field-value">: {{ $dataPDF['size'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">TEINT</td>
          <td class="field-value">: {{ $dataPDF['complexion'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">CHEVEUX</td>
          <td class="field-value">: {{ $dataPDF['hairs'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">SIGNES PARTICULIERS</td>
          <td class="field-value">: {{ $dataPDF['particular_sign'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">DOMICILE</td>
          <td class="field-value">: {{ $dataPDF['home_address'] }}</td>
        </tr>

      </table>
    </td>

    {{-- ── Bloc PHOTO ────────────────────────────────────────────── --}}
    <td width="25%" style="vertical-align:top; text-align:center; padding-left:20px;">
      <div class="photo-box"></div>
    </td>
  </tr>
</table>
@endsection
