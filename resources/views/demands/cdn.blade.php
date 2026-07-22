<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>CERTIFICAT DE NAISSANCE</title>
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
        font-size: 10pt;
      }
      /* ── Filigrane centré ──────────────────────────────────────── */
      .dmd-container {
        position: relative;
        padding: 10px 15px;
      }
      .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 300px;
        opacity: 0.1;
        z-index: 0;
      }
      .content {
        position: relative;
        z-index: 1;
      }
      /* ── En-tête ──────────────────────────────────────────────── */
      .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 15px;
      }
      .header-left {
        text-align: center;
        width: 30%;
      }
      .header-center {
        text-align: center;
        width: 40%;
        font-size: 10pt;
      }
      .header-right {
        text-align: center;
        width: 30%;
      }
      .header img {
        height: 90px;
      }
      .header-title {
        font-size: 13pt;
        font-weight: bold;
        text-transform: uppercase;
      }
      .header-subtitle {
        font-size: 9pt;
      }
      /* ── Numéro CNI ───────────────────────────────────────────── */
      .cni-block {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
      }
      .cni-number {
        font-size: 10pt;
      }
      /* ── Titre principal ──────────────────────────────────────── */
      .main-title {
        text-align: center;
        font-size: 20pt;
        font-weight: bold;
        text-transform: uppercase;
        border-top: 2px solid #000;
        border-bottom: 2px solid #000;
        padding: 6px 0;
        margin-bottom: 15px;
        letter-spacing: 3px;
      }
      .title-sub {
        text-align: center;
        font-size: 11pt;
        font-weight: bold;
        letter-spacing: 2px;
        margin-bottom: 15px;
      }
      /* ── Corps du document ────────────────────────────────────── */
      .body-content {
        display: flex;
        justify-content: space-between;
        gap: 20px;
      }
      .body-left {
        width: 75%;
      }
      .body-right {
        width: 25%;
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10pt;
      }
      /* ── Champs du formulaire ─────────────────────────────────── */
      .field-row {
        display: flex;
        margin-bottom: 8px;
        align-items: baseline;
        border-bottom: 1px dotted #555;
        padding-bottom: 4px;
      }
      .field-label {
        font-weight: bold;
        min-width: 220px;
        font-size: 10pt;
        white-space: nowrap;
      }
      .field-value {
        flex: 1;
        font-size: 10pt;
        padding-left: 5px;
      }
      .field-inline {
        display: inline-flex;
        gap: 30px;
      }
      /* ── Signature ─────────────────────────────────────────────── */
      .footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
      }
      .footer-left {
        font-size: 10pt;
        font-style: italic;
      }
      .footer-right {
        text-align: center;
        font-size: 10pt;
      }
      .signature-block {
        border: 1px solid #000;
        width: 180px;
        height: 80px;
        margin-top: 5px;
      }
    </style>
  </head>
  <body>
    <div class="dmd-container">

      <!-- Filigrane -->
      <img src="{{ public_path('assets/img/amoirie.png') }}" class="watermark" alt="Filigrane" />

      <div class="content">

        <!-- ── EN-TÊTE ─────────────────────────────────────────────── -->
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" style="text-align:center; vertical-align:middle; font-size:9pt;">
              <img src="{{ public_path('assets/img/amoirie.png') }}" style="height: 90px;" alt="Armoirie" /><br>
              <strong>RÉPUBLIQUE DE GUINÉE</strong><br>
              <span style="font-size: 8pt;font-style: italic;">Travail - Justice - Solidarité</span><br>
              ----------------
            </td>
            <td width="60%" style="text-align:center; vertical-align:middle; font-size:10pt;">
              MINISTÈRE D'ÉTAT, MINISTÈRE DES AFFAIRES ÉTRANGÈRES<br>
              ET DES GUINÉENS DE L'ÉTRANGER<br>
              ----------------<br>
              <strong>AMBASSADE DE LA RÉPUBLIQUE DE GUINÉE<br>
              EN CÔTE D'IVOIRE - {{ $dataPDF['agency'] }}<br></strong>
              ----------------
            </td>
            <td width="20%" style="text-align:center; vertical-align:middle;">
              <img src="{{ public_path('assets/img/nimba.png') }}" style="height: 150px;" alt="Nimba" />
            </td>
          </tr>
        </table>

        <!-- ── N° et ADI ──────────────────────────────────────────── -->
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" style="font-size:10pt;">
              <strong>N° {{ $dataPDF['reference'] }}</strong>
            </td>
          </tr>
        </table>

        <!-- ── TITRE PRINCIPAL ────────────────────────────────────── -->
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 20px;">
          <tr>
            <td style="text-align:center; font-size:18pt; font-weight:bold;">
              CERTIFICAT DE NAISSANCE<br>
              <img src="{{ public_path('assets/img/ornement.jpg') }}" style="height: 20px;" alt="Ornement" />
            </td>
          </tr>
        </table>

      </div><!-- /content -->
    </div><!-- /dmd-container -->
  </body>
</html>