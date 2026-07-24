@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 110px;">
  <tr>
    <td style="vertical-align:top;">

      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 30px;line-height: 1.5;">
        L'AMBASSADE DE LA RÉPUBLIQUE DE GUINÉE EN RÉPUBLIQUE DE CÔTE D'IVOIRE<br>
        {{ $dataPDF['agency'] }},<br>
        SUR LA FOI DES DOCUMENTS PRÉSENTÉS,
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
          <td class="field-label">EST {{ $dataPDF['sex'] == 'M' ? 'NÉ' : 'NÉE' }} LE</td>
          <td class="field-value">: {{ $dataPDF['birthday_at'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">À</td>
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
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-top: 25px; margin-bottom: 15px;">
        EST DE NATIONALITÉ GUINÉENNE
      </p>

      <p style="font-size:12pt; line-height: 1.5;">
        DELIVRÉE SUR LA DEMANDE DE L'{{ $dataPDF['sex'] == 'M' ? 'INTERÉSSÉ' : 'INTERÉSSÉE' }} POUR JOUIR DE TOUTES LES
        PREROGATIVES DÉCOULANT DE LA POSSESSION D'ÉTAT SUSVISE.
      </p>

    </td>
  </tr>
</table>
@endsection
