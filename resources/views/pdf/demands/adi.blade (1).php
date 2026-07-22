@extends('pdf.layouts.document')

@section('title', 'ATTESTATION D\'IDENTITE')
@section('doc_code', 'ADI')
@section('doc_title', 'ATTESTATION D\'IDENTITE')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0">
  <tr>
    {{-- ── Champs du demandeur ──────────────────────────────────── --}}
    <td width="75%" style="vertical-align:top;">
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">NOM :</td>
          <td class="field-value">{{ $dataPDF['lastname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PRÉNOM(S) :</td>
          <td class="field-value">{{ $dataPDF['firstname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">
            {{ $dataPDF['sex'] == 'M' ? 'NÉ' : 'NÉE' }} LE :
          </td>
          <td style="padding-bottom:18px;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="45%" class="field-value">{{ $dataPDF['birthday_at'] }}</td>
                <td width="10%" style="padding: 0 6px; white-space:nowrap; vertical-align:bottom;">
                  LIEU DE NAISSANCE :
                </td>
                <td class="field-value">{{ $dataPDF['birthplace'] }}</td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PRÉFECTURE :</td>
          <td class="field-value">{{ $dataPDF['prefecture'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">
            {{ $dataPDF['sex'] == 'M' ? 'FILS' : 'FILLE' }} DE :
          </td>
          <td class="field-value">{{ $dataPDF['father'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">ET DE :</td>
          <td class="field-value">{{ $dataPDF['mother'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PROFESSION :</td>
          <td class="field-value">{{ $dataPDF['profession'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">TAILLE :</td>
          <td style="padding-bottom:18px;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="30%" class="field-value">{{ $dataPDF['size'] }}</td>
                <td width="10%" style="padding: 0 6px; vertical-align:bottom;">TEINT :</td>
                <td width="25%" class="field-value">{{ $dataPDF['complexion'] }}</td>
                <td width="10%" style="padding: 0 6px; vertical-align:bottom;">CHEVEUX :</td>
                <td class="field-value">{{ $dataPDF['hairs'] }}</td>
              </tr>
            </table>
          </td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">SIGNES PARTICULIERS :</td>
          <td class="field-value">{{ $dataPDF['particular_sign'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">DOMICILE ET ADRESSE EN C.I. :</td>
          <td class="field-value">{{ $dataPDF['home_address'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label" style="white-space:nowrap;">COMMUNE DE RÉSIDENCE :</td>
          <td class="field-value">{{ $dataPDF['commune'] ?? '' }}</td>
        </tr>

      </table>
    </td>

    {{-- ── Bloc PHOTO ────────────────────────────────────────────── --}}
    <td width="25%" style="vertical-align:top; text-align:center; padding-left:20px;">
      <div class="photo-box">
        @if(!empty($dataPDF['avatar']))
          <img src="{{ public_path('storage/' . $dataPDF['avatar']) }}"
               style="width:100%; height:100%; object-fit:cover;" alt="Photo" />
        @else
          PHOTO
        @endif
      </div>
    </td>
  </tr>
</table>
@endsection
