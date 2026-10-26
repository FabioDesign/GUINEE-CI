@extends('pdf.layouts.master')

@section('body')
@php
    // Choix du sexe
    $isMale   = ($dataPDF['sex'] ?? 'M') == 'M';

    // Nombre d'enfants
    $children = $dataPDF['count'] == 0
    ? 'SANS ENFANT'
    : ($dataPDF['count'] == 1 ? '1 ENFANT' : $dataPDF['count'] . ' ENFANTS');
@endphp
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 40px;">
  <tr>
    <td style="vertical-align:top;">
      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 30px; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE - {{ $dataPDF['consulat'] }}<br>
        SUR LA FOI DES DOCUMENTS PRESENTS,
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        ATTESTE :
      </p>
      {{-- ── Champs du demandeur ───────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr class="field-row">
          <td class="field-label">PAR LA PRESENTE QUE</td>
          <td class="field-value">: {{ $dataPDF['civility'] }} {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">{{ $isMale ? 'NE' : 'NEE' }} LE</td>
          <td class="field-value">: {{ $dataPDF['birthday_at'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">{{ $isMale ? 'FILS' : 'FILLE' }} DE</td>
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
          <td class="field-label">{{ $isMale ? 'DOMICILIE' : 'DOMICILIEE' }} EN COTE D'IVOIRE DEPUIS LE</td>
          <td class="field-value">: {{ $dataPDF['arrival_at'] }} - {{ $dataPDF['maritalstatus'] }} {{ $children }}</td>
        </tr>
      </table>
      {{-- ── Mention de bonne conduite ─────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 25px; text-align:justify; line-height: 1.5;">
        A CE JOUR, A TOUJOURS EU UN COMPORTEMENT SOCIAL IRREPROCHABLE A NOS SERVICES ET DANS LA
        COMMUNAUTE GUINEENNE.
      </p>
      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 25px; text-align:justify; line-height: 1.5;">
        EN FOI DE QUOI, NOUS LUI DELIVRONS LA PRESENTE ATTESTATION DE BONNE MORALITE POUR SERVIR ET
        VALOIR CE QUE DE DROIT.
      </p>
    </td>
  </tr>
</table>
@endsection
