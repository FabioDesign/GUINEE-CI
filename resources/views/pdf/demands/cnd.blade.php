@extends('pdf.layouts.master')

{{-- Titre avec retour à la ligne imposé (comme sur le modèle CND.pdf) --}}
@section('doc_title')
CERTIFICAT DE NON DIVORCE<br>ET DE NON SEPARATION DE CORPS
@endsection

@section('body')
@php
    // Choix du sexe du demandeur (le conjoint décédé est de sexe opposé)
    $isMale = ($dataPDF['sex'] ?? 'M') == 'M';
@endphp
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 40px;">
  <tr>
    <td style="vertical-align:top;">
      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 15px; text-align: justify; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE,<br>
        SUR LA FOI DES PIECES PRESENTEES ET LES RENSEIGNEMENTS RECUEILLIS AUPRES DE<br>
        TEMOINS MAJEURS REGULIEREMENT DOMICILIES EN COTE D'IVOIRE ET EN GUINEE :
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        CERTIFIE
      </p>
      {{-- ── Champs du mariage ─────────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr class="field-row">
          <td class="field-label">QUE LE MARIAGE CONTRACTE LE</td>
          <td class="field-value">: {{ $dataPDF['wedding_at'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">A</td>
          <td class="field-value">: {{ $dataPDF['wedding_place'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">ACTE DE MARIAGE N&deg;</td>
          <td class="field-value">: {{ $dataPDF['number'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">ENTRE {{ $isMale ? 'LA DEFUNTE' : 'LE DEFUNT' }}</td>
          <td class="field-value">: {{ $dataPDF['lastname_cnd'] }} {{ $dataPDF['firstname_cnd'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">ET {{ $isMale ? 'LE VEUF' : 'LA VEUVE' }}</td>
          <td class="field-value">: {{ $dataPDF['civility'] }} {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>
      </table>
      {{-- ── Mention de non divorce ────────────────────────────── --}}
      <p style="font-size:12pt; font-weight:bold; margin: 20px 0; line-height: 1.5;">
        N'A JAMAIS ETE DISSOUT PAR UN DIVORCE PRONONCE JUDICIAIREMENT CONTRE LA FEMME
      </p>
      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 20px; text-align:justify; line-height: 1.5;">
        EN FOI DE QUOI, NOUS LUI AVONS DELIVRE LE PRESENT CERTIFICAT POUR SERVIR ET VALOIR
        CE QUE DE DROIT.
      </p>
    </td>
  </tr>
</table>
@endsection
