<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Document Consulaire')</title>
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
      }

      /* ── Filigrane ─────────────────────────────────────────────── */
      .dmd-container {
        position: relative;
        padding: 10px 20px;
      }
      .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        height: 330px;
        opacity: 0.1;
        z-index: 0;
      }
      .content {
        position: relative;
        z-index: 1;
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
        padding-right: 6px;
      }
      .field-value {
        border-bottom: 1px dotted #555;
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
        position: relative;
      }

      /* ── Bloc PHOTO ────────────────────────────────────────────── */
      .photo-box {
        border: 2px dashed #000;
        width: 150px;
        height: 170px;
        display: table-cell;
        vertical-align: middle;
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

      {{-- ── Filigrane ─────────────────────────────────────────────── --}}
      <img src="{{ public_path('assets/img/amoirie.png') }}"
           class="watermark" alt="Filigrane" />

      <div class="content">

        {{-- ── EN-TÊTE COMMUN ────────────────────────────────────────── --}}
        @include('pdf.partials.header', ['dataPDF' => $dataPDF])

        {{-- ── NUMÉRO DE RÉFÉRENCE ───────────────────────────────────── --}}
        <table class="ref-table" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60%" style="font-size:10pt;">
              <strong>N° {{ $dataPDF['reference'] }}</strong>
            </td>
            <td width="40%" style="text-align:right; font-size:11pt; font-weight:bold;">
              @yield('doc_code')
            </td>
          </tr>
        </table>

        {{-- ── TITRE DU DOCUMENT ─────────────────────────────────────── --}}
        <div class="doc-title">@yield('doc_title')</div>
        <div class="doc-ornement">
          <img src="{{ public_path('assets/img/ornement.jpg') }}"
               style="height: 20px;" alt="Ornement" />
        </div>

        {{-- ── CORPS SPÉCIFIQUE À CHAQUE DOCUMENT ───────────────────── --}}
        @yield('body')

        {{-- ── PIED DE PAGE COMMUN ───────────────────────────────────── --}}
        @include('pdf.partials.footer', ['dataPDF' => $dataPDF])

      </div>{{-- /content --}}
    </div>{{-- /dmd-container --}}
  </body>
</html>
