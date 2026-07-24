<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>{{ $dataPDF['document'] }}</title>
    <style>
      @page {
        size: 21cm 29.7cm;
        margin: 1cm;
      }
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body {
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size: 12pt;
        margin: 0;
        padding: 0;
      }

      .dmd-container {
        position: relative;
        padding: 20px;
      }
      /* ── Image de fond avec opacité ──────────────────────────────── */
      .bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.2;
        z-index: 0;
      }
      /* ── Filigrane ─────────────────────────────────────────────── */
      .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        height: 330px;
        opacity: 0.3;
        z-index: 1;
      }
      .content {
        position: relative;
        z-index: 2;
      }
      /* ── En-tête ───────────────────────────────────────────────── */
      .header-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
      }
      .header-logo {
        width: 20%;
        text-align: center;
        vertical-align: middle;
        font-size: 9pt;
      }
      .header-center {
        width: 60%;
        text-align: center;
        vertical-align: middle;
        font-size: 10pt;
        line-height: 1.6;
      }
      .header-right {
        width: 20%;
        text-align: center;
        vertical-align: middle;
      }

      /* ── Numéro de référence ────────────────────────────────────── */
      .ref-table {
        width: 100%;
        margin: 5px 0;
      }

      /* ── Titre du document ─────────────────────────────────────── */
      .doc-title {
        text-align: center;
        font-size: 20pt;
        font-weight: bold;
        margin: 20px 0 0;
      }
      .doc-ornement {
        text-align: center;
        margin: 4px 0 0;
      }

      /* ── Corps ─────────────────────────────────────────────────── */
      .body-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
      }

      /* ── Champs avec ligne pointillée ─────────────────────────── */
      .field-row td {
        padding-bottom: 18px;
        vertical-align: bottom;
      }
      .field-label {
        white-space: nowrap;
        padding-right: 10px;
      }
      .field-value {
        font-weight: bold;
        width: 100%;
      }

      /* ── Pied de page ──────────────────────────────────────────── */
      .footer-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: @yield('footer_margin', '80px');
      }
      .footer-qr {
        width: 20%;
        text-align: center;
        vertical-align: bottom;
      }
      .footer-middle {
        width: 50%;
      }
      .footer-signature {
        width: 30%;
        text-align: center;
      }

      /* ── Bloc PHOTO ────────────────────────────────────────────── */
      .photo-box {
        border: 2px dashed #000;
        width: 150px;
        height: 170px;
        text-align: center;
        color: #999;
        font-size: 10pt;
      }

      /* ── Styles additionnels par document ─────────────────────── */
      @yield('extra_styles')
    </style>
  </head>
  <body>
    <div class="dmd-container">

      {{-- ── Image de fond avec opacité ──────────────────────────────── --}}
      <img src="{{ public_path('assets/img/background.png') }}" class="bg-image" alt="Image de fond" />

      {{-- ── Filigrane ─────────────────────────────────────────────── --}}
      <img src="{{ public_path('assets/img/amoirie.png') }}" class="watermark" alt="Filigrane" />

      <div class="content">

        {{-- ── EN-TÊTE COMMUN ────────────────────────────────────────── --}}
        @include('pdf.partials.header', ['dataPDF' => $dataPDF])

        {{-- ── NUMÉRO DE RÉFÉRENCE ───────────────────────────────────── --}}
        <table class="ref-table" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" style="font-size:10pt;">
              <strong>N° {{ $dataPDF['reference'] }}</strong>
            </td>
          </tr>
        </table>

        {{-- ── TITRE DU DOCUMENT ─────────────────────────────────────── --}}
        <div class="doc-title">{{ $dataPDF['document'] }}</div>
        <div class="doc-ornement">
          <img src="{{ public_path('assets/img/ornement.jpg') }}" style="height: 20px;" alt="Ornement" />
        </div>

        {{-- ── CORPS SPÉCIFIQUE À CHAQUE DOCUMENT ───────────────────── --}}
        @yield('body')

        {{-- ── PIED DE PAGE COMMUN ───────────────────────────────────── --}}
        @include('pdf.partials.footer', ['dataPDF' => $dataPDF])

      </div>{{-- /content --}}
    </div>{{-- /dmd-container --}}
  </body>
</html>
