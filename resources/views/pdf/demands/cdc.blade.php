@extends('pdf.layouts.master')

@section('body')
<table class="body-table" cellspacing="0" cellpadding="0" style="margin: 30px 0 40px;">
  <tr>
    <td style="vertical-align:top;">

      {{-- ── Texte introductif ─────────────────────────────────── --}}
      <p style="font-size:12pt; margin-bottom: 15px; text-align: justify; line-height: 1.5;">
        L'AMBASSADE DE LA REPUBLIQUE DE GUINEE EN REPUBLIQUE DE COTE D'IVOIRE,<br>
        SUR LA FOI DES PIECES PRESENTEES ET LES RENSEIGNEMENTS RECUEILLIS AUPRES DE<br>
        TEMOINS MAJEURS REGULIEREMENT DOMICILIES EN COTE ET EN GUINEE :
      </p>

      <p style="font-size:12pt; font-weight:bold; text-align:center; margin-bottom: 20px;">
        CERTIFIE PAR LA PRESENTE
      </p>

      {{-- ── Champs du demandeur ───────────────────────────────── --}}
      <table width="100%" cellspacing="0" cellpadding="0">

        <tr class="field-row">
          <td class="field-label">QUE</td>
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

        <tr class="field-row">
          <td class="field-label">PROFESSION</td>
          <td class="field-value">: {{ $dataPDF['profession'] }}</td>
        </tr>

        <tr class="field-row">
          <td class="field-label">{{ $dataPDF['sex'] == 'M' ? 'DOMICILIE' : 'DOMICILIEE' }} A</td>
          <td class="field-value">: {{ $dataPDF['home_address'] }}</td>
        </tr>

      </table>

      {{-- ── Mention célibat ───────────────────────────────────── --}}
      <p style="font-size:12pt; font-weight:bold; text-align:center; margin: 20px 0;">
        EST CELIBATAIRE A CE JOUR.
      </p>

      {{-- ── Texte de clôture ──────────────────────────────────── --}}
      <p style="font-size:12pt; margin-top: 20px; text-align:justify; line-height: 1.5;">
        EN FOI DE QUOI, NOUS LUI DELIVRONS LE PRESENT CERTIFICAT DE CELIBAT POUR SERVIR ET VALOIR
        CE QUE DE DROIT.
      </p>

    </td>
  </tr>
</table>
@endsection
