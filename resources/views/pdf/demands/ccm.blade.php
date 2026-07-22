@extends('pdf.layouts.document')

@section('title', 'CERTIFICAT DE CAPACITÉ MATRIMONIALE')
@section('doc_code', 'CCM')
@section('doc_title', 'CERTIFICAT DE CAPACITE MATRIMONIALE')

@section('body')
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:20px; font-size:11pt;">
  <tr>
    <td style="text-align:center; padding:10px 0;">
      L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE<br>
      CÔTE D'IVOIRE - {{ strtoupper($dataPDF['agency'] ?? 'ABIDJAN') }},<br><br>
      <strong>CERTIFIE</strong>
    </td>
  </tr>
</table>

{{-- ── Section DEMANDEUR ──────────────────────────────────────── --}}
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:15px;">

  <tr class="field-row">
    <td class="field-label" width="25%">Que M. (Mlle) :</td>
    <td class="field-value">{{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Né(e) :</td>
    <td class="field-value">
      le {{ $dataPDF['birthday_at'] }} à {{ $dataPDF['birthplace'] }}
    </td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Fils(e) de :</td>
    <td class="field-value">{{ $dataPDF['father'] }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Et de :</td>
    <td class="field-value">{{ $dataPDF['mother'] }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Profession :</td>
    <td class="field-value">{{ $dataPDF['profession'] }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Domicile :</td>
    <td class="field-value">{{ $dataPDF['home_address'] }}</td>
  </tr>
</table>

<p style="margin: 15px 0; font-size:11pt;">
  Est apte d'après la loi matrimoniale guinéenne à contracter un mariage ou une union valable
</p>

{{-- ── Section CONJOINT ───────────────────────────────────────── --}}
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:10px;">

  <tr class="field-row">
    <td class="field-label" width="25%">Avec M. (Mlle) :</td>
    <td class="field-value">{{ $dataPDF['spouse_lastname'] ?? '' }} {{ $dataPDF['spouse_firstname'] ?? '' }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Né(e) :</td>
    <td class="field-value">
      le {{ $dataPDF['spouse_birthday'] ?? '' }} à {{ $dataPDF['spouse_birthplace'] ?? '' }}
    </td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Fils(e) de :</td>
    <td class="field-value">{{ $dataPDF['spouse_father'] ?? '' }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Et de :</td>
    <td class="field-value">{{ $dataPDF['spouse_mother'] ?? '' }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Profession :</td>
    <td class="field-value">{{ $dataPDF['spouse_profession'] ?? '' }}</td>
  </tr>

  <tr class="field-row">
    <td class="field-label">Domicile :</td>
    <td class="field-value">{{ $dataPDF['spouse_address'] ?? '' }}</td>
  </tr>
</table>

<p style="margin-top: 15px; font-size:11pt;">
  Qu'il ou elle propose d'épouser.
</p>

<p style="margin-top: 10px; font-size: 9pt; font-style: italic;">
  Ce document n'est valable que muni du sticker de l'Ambassade de Guinée en Côte d'Ivoire
</p>
@endsection
