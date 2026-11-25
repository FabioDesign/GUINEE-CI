@extends('pdf.layouts.master')

@php
    // Type d'attestation : APC = permis de conduire, APP = passeport
    $isPassport = ($dataPDF['code'] ?? 'APC') === 'APP';
    $typeLabel  = $isPassport ? 'PASSEPORT' : 'PERMIS DE CONDUIRE';
    $titreDoc   = $isPassport ? 'LE PASSEPORT' : 'LE PERMIS DE CONDUIRE';
    // Autorité émettrice (à confirmer pour le passeport)
    $autorite   = $isPassport
        ? 'DIRECTION GENERALE DE LA POLICE NATIONALE'
        : 'DIRECTION GENERALE DES TRANSPORTS TERRESTRES';
    $isMale     = ($dataPDF['sex'] ?? 'M') == 'M';
@endphp

{{-- Titre + type de document sur la ligne en dessous --}}
@section('doc_title')
ATTESTATION D'AUTHENTICITE<br>
<span style="font-size:12pt; font-weight:normal;">({{ $typeLabel }})</span>
@endsection

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 40px;">
  <tr>
    <td style="vertical-align:top;">
      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 15px; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE - {{ $dataPDF['consulat'] }}
      </p>
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        ATTESTE :
      </p>
      {{-- ── Champs + photo ── --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="75%" style="vertical-align:top;">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr class="field-row">
                <td class="field-label">QUE {{ $titreDoc }} N&deg;</td>
                <td class="field-value">: {{ $dataPDF['number'] }}</td>
              </tr>
              <tr class="field-row">
                <td class="field-label">DELIVRE LE</td>
                <td class="field-value">: {{ $dataPDF['delivery_at'] }}</td>
              </tr>
              <tr class="field-row">
                <td class="field-label">A {{ $dataPDF['civility'] }}</td>
                <td class="field-value">: {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
              </tr>
            </table>
          </td>
          {{-- ── Bloc PHOTO ────────────────────────────────────────── --}}
          <td width="25%" style="vertical-align:top; text-align:center; padding-left:20px;">
            <div class="photo-box"><img src="{{ public_path('storage/' . $dataPDF['photo']) }}" alt="" style="width:100%; height:auto;"></div>
          </td>
        </tr>
      </table>
      {{-- ── Autorité émettrice ────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 10px; line-height: 1.5;">
        PAR L'AUTORITE GUINEENNE ( {{ $autorite }} )<br>
        CONAKRY;
      </p>
      <p style="font-size:12pt; margin-top: 15px; line-height: 1.5;">
        EST AUTHENTIQUE CONFORMEMENT AUX MENTIONS PORTEES SUR LES TITRES DU MEME GENRE.
      </p>
      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 15px; line-height: 1.5;">
        DELIVREE A L'{{ $isMale ? 'INTERESSE' : 'INTERESSEE' }} POUR JOUIR DE TOUTES LES PREROGATIVES
        DECOULANT DE LA POSSESSION D'ETAT SUSVISEE.
      </p>
    </td>
  </tr>
</table>
@endsection
