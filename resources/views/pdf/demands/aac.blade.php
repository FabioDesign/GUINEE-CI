@extends('pdf.layouts.master')

@section('body')
@php
    // Choix du sexe
    $isMale = ($dataPDF['sex'] ?? 'M') == 'M';
@endphp
<table class="body-table" style="margin: 30px 0 40px;">
  <tr>
    <td style="vertical-align:top;">
      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 15px; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE - {{ $dataPDF['consulat'] }}
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        ATTESTE :
      </p>
      <p style="font-size:12pt; margin-bottom: 20px; text-align: justify; line-height: 1.5;">
        LA CARTE D'IDENTITE CONSULAIRE BIOMETRIQUE N&deg; <strong>{{ $dataPDF['number'] }}</strong>
        DELIVREE LE <strong>{{ $dataPDF['delivery_at'] }}</strong> PAR CES SERVICES COMPETENTS A<br>
        <strong>{{ $dataPDF['civility'] }} {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</strong>
      </p>
      {{-- ── Identité du titulaire (tableau aligné, comme adn.blade.php) ── --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr class="field-row">
          <td class="field-label">{{ $isMale ? 'NE' : 'NEE' }} LE</td>
          <td class="field-value">: {{ $dataPDF['birthday_at'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">A</td>
          <td class="field-value">: {{ $dataPDF['birthplace'] }}</td>
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
          <td class="field-label">{{ $isMale ? 'DOMICILIE' : 'DOMICILIEE' }} A</td>
          <td class="field-value">: {{ $dataPDF['home_address'] }}</td>
        </tr>
      </table>
      {{-- ── Mention d'authenticité ────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 5px; text-align: justify; line-height: 1.5;">
        EST AUTHENTIQUE CONFORMEMENT AUX DISPOSITIONS EXIGEES SUR LES TITRES DU MEME GENRE.
      </p>
      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 20px; text-align: justify; line-height: 1.5;">
        EN FOI DE QUOI NOUS AVONS DELIVRE CE CERTIFICAT POUR SERVIR ET VALOIR CE QUE DE DROIT.
      </p>
    </td>
  </tr>
</table>
@endsection
