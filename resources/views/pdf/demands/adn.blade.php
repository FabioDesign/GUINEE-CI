@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 60px;">
  <tr>
    <td style="vertical-align:top;">

      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 20px;text-align: justify;line-height: 1.5;">
        NOUS CONSUL, FONCTIONNAIRE CONSULAIRE DE LA REPUBLIQUE DE GUINEE<br>
        EN REPUBLIQUE DE COTE D'IVOIRE - {{ $dataPDF['consulat'] }}<br>
        CERTIFIONS<br>
        SUR LA FOI DES PIECES PRESENTEES ET LES RENSEIGNEMENTS RECUEILLIS<br>
        AUPRES DES TEMOINS MAJEURS REGULIEREMENT DOMICILIES EN COTE ET EN GUINEE,<br>
        QU'IL EST DE NOTORIETE PUBLIQUE, CONSTANTE ET ETABLIE
      </p>

      {{-- ── Champs du demandeur ───────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">QUE</td>
          <td class="field-value">: {{ $dataPDF['civility'] }} {{ $dataPDF['lastname'] }} {{ $dataPDF['firstname'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">SEXE</td>
          <td class="field-value">: {{ $dataPDF['sex'] == 'M' ? 'MASCULIN' : 'FEMININ' }}</td>
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

        <tr class="field-row">
          <td class="field-label">{{ $dataPDF['sex'] == 'M' ? 'DOMICILIE' : 'DOMICILIEE' }} A</td>
          <td class="field-value">: {{ $dataPDF['home_address'] }}</td>
        </tr>

      </table>

      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 20px;line-height: 1.5;">
        EN FOI DE QUOI, LUI A ETE DELIVRE LE PRESENT ACTE POUR SERVIR ET VALOIR CE QUE DE DROIT.
      </p>

    </td>
  </tr>
</table>
@endsection
