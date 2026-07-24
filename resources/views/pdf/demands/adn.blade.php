@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 60px;">
  <tr>
    <td style="vertical-align:top;">

      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 20px;text-align: justify;line-height: 1.5;">
        NOUS CONSUL, FONCTIONNAIRE CONSULAIRE DE LA RÉPUBLIQUE DE GUINÉE<br>
        EN RÉPUBLIQUE DE CÔTE D'IVOIRE - {{ $dataPDF['agency'] }}<br>
        CERTIFIONS<br>
        SUR LA FOI DES PIÈCES PRÉSENTÉES ET LES RENSEIGNEMENTS RECUEILLIS<br>
        AUPRÈS DES TÉMOINS MAJEURS REGULIEREMENT DOMICILIÉS EN CÔTE D'IVOIRE,<br>
        QU'IL EST DE NOTORIÉTÉ PUBLIQUE, CONSTANTE ET ÉTABLIE
      </p>

      {{-- ── Champs du demandeur ───────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">QUE</td>
          <td class="field-value">: {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">SEXE</td>
          <td class="field-value">: {{ $dataPDF['sex'] == 'M' ? 'MASCULIN' : 'FÉMININ' }}</td>
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

        <tr class="field-row">
          <td class="field-label">DOMICILIÉ À</td>
          <td class="field-value">: {{ $dataPDF['home_address'] }}</td>
        </tr>

      </table>

      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 20px;line-height: 1.5;">
        EN FOI DE QUOI, LUI A ÉTÉ DÉLIVRÉ LE PRÉSENT ACTE POUR SERVIR ET VALOIR CE QUE DE DROIT.
      </p>

    </td>
  </tr>
</table>
@endsection
