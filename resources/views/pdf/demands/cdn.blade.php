@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 70px;">
  <tr>
    <td style="vertical-align:top;">

      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 30px;line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE<br>
        {{ $dataPDF['consulat'] }},<br>
        SUR LA FOI DES DOCUMENTS PRESENTES,
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        ATTESTE :
      </p>

      {{-- ── Champs du demandeur ───────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">QUE </td>
          <td class="field-value">: {{ $dataPDF['civility'] }} {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">EST {{ $dataPDF['sex'] == 'M' ? 'NE' : 'NEE' }} LE</td>
          <td class="field-value">: {{ $dataPDF['birthday_at'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">A</td>
          <td class="field-value">: {{ $dataPDF['birthplace'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">PREFECTURE DE</td>
          <td class="field-value">: {{ $dataPDF['prefecture'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">{{ $dataPDF['sex'] == 'M' ? 'FILS' : 'FILLE' }} DE</td>
          <td class="field-value">: {{ $dataPDF['father'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">ET DE</td>
          <td class="field-value">: {{ $dataPDF['mother'] }}</td>
        </tr>

      </table>

      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-top: 60px; margin-bottom: 15px;">
        EST DE NATIONALITE GUINEENNE
      </p>

      <p style="font-size:12pt; line-height: 1.5;">
        DELIVREE SUR LA DEMANDE DE L'{{ $dataPDF['sex'] == 'M' ? 'INTERESSE' : 'INTERESSEE' }} POUR JOUIR DE TOUTES LES
        PREROGATIVES DECOULANT DE LA POSSESSION D'ETAT SUBVISE.
      </p>

    </td>
  </tr>
</table>
@endsection
