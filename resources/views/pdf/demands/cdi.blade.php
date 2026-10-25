@extends('pdf.layouts.master')

@section('body')
@php
    // Choix du nom à retenir (radio number : 1 = Nom 1, 2 = Nom 2)
    $isMale   = ($dataPDF['sex'] ?? 'M') == 'M';
    $choix    = $dataPDF['number'] ?? 1;
    $retenu   = '';
    if ($choix == 1) {
        $retenu = trim(($dataPDF['lastname'] ?? '') . ' ' . ($dataPDF['firstname'] ?? ''));
    } elseif ($choix == 2) {
        $retenu = trim(($dataPDF['lastname_cdi'] ?? '') . ' ' . ($dataPDF['firstname_cdi'] ?? ''));
    }
@endphp
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 50px;">
  <tr>
    <td style="vertical-align:top;">
      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 30px; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE,<br>
        {{ $dataPDF['consulat'] ?? '- ABIDJAN' }}
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        CERTIFIE
      </p>
      {{-- ── Un seul tableau : la colonne des libellés est commune à toutes les lignes,
           donc toutes les valeurs sont alignées verticalement ─────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        {{-- Premiers noms --}}
        <tr class="field-row">
          <td class="field-label">QUE LES NOMS</td>
          <td class="field-value">: {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">&nbsp;</td>
          <td class="field-value">&nbsp;&nbsp;{{ $isMale ? 'NE' : 'NEE' }} LE {{ $dataPDF['birthday_at'] }}</td>
        </tr>

        {{-- ET --}}
        <tr class="field-row">
          <td colspan="2" class="field-label" style="text-align:center; font-weight:bold; padding: 15px 0;">ET</td>
        </tr>

        {{-- Seconds noms --}}
        <tr class="field-row">
          <td class="field-label">&nbsp;</td>
          <td class="field-value">: {{ $dataPDF['lastname_cdi'] }} {{ $dataPDF['firstname_cdi'] }}</td>
        </tr>
        <tr class="field-row">
          <td class="field-label">&nbsp;</td>
          <td class="field-value">&nbsp;&nbsp;{{ $isMale ? 'NE' : 'NEE' }} LE {{ $dataPDF['birthdayat_cdi'] }}</td>
        </tr>

        {{-- Mention de concordance --}}
        <tr class="field-row">
          <td class="field-label">&nbsp;</td>
          <td class="field-value" style="font-weight:bold; padding-top: 15px;">&nbsp;&nbsp;CONCERNENT ET INDIQUENT LA MEME PERSONNE.</td>
        </tr>

        {{-- Nom à retenir --}}
        <tr class="field-row">
          <td class="field-label" style="padding-top: 15px;">&nbsp;</td>
          <td class="field-value" style="padding-top: 15px;">&nbsp;&nbsp;A RETENIR :&nbsp;&nbsp;{{ $retenu }}</td>
        </tr>
      </table>
      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 50px; line-height: 1.5;">
        DELIVRE SUR LA DEMANDE DE L'{{ $isMale ? 'INTERESSE' : 'INTERESSEE' }} POUR JOUIR DE TOUTES LES
        PREROGATIVES DECOULANT DE LA POSSESSION D'ETAT SUSVISEE.
      </p>
    </td>
  </tr>
</table>
@endsection