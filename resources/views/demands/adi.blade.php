<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>ATTESTATION D'IDENTITE</title>
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
      /* ── Filigrane centré ──────────────────────────────────────── */
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
              <strong>
                AMBASSADE DE LA RÉPUBLIQUE DE GUINÉE<br>
                EN CÔTE D'IVOIRE - {{ $dataPDF['agency'] }}<br>
              </strong>
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
            <td style="text-align:center; font-size:20pt; font-weight:bold;">
              ATTESTATION D'IDENTITE<br>
              <img src="{{ public_path('assets/img/ornement.jpg') }}" style="height: 20px;" alt="Ornement" />
            </td>
          </tr>
        </table>

        <!-- ── CORPS PRINCIPAL ────────────────────────────────────── -->
        <table width="100%" cellspacing="0" cellpadding="4" style="margin-top: 50px;">
          <tr>
            <td width="75%" style="vertical-align:top;">
              <table width="100%" cellspacing="0" cellpadding="0">
                <!-- NOM -->
                <tr>
                  <td width="35%" style="padding-bottom: 20px;">
                    NOM :
                  </td>
                  <td width="65%" style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['lastname'] }}</span>
                  </td>
                </tr>
                <!-- PRENOM -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    PRENOM :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['firstname'] }}</span>
                  </td>
                </tr>
                <!-- DATE DE NAISSANCE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    @php echo $dataPDF['sex'] == 'M' ? 'NÉ' : 'NÉE' @endphp LE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['birthday_at'] }}</span>
                  </td>
                </tr>
                <!-- LIEU DE NAISSANCE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    À :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['birthplace'] }}</span>
                  </td>
                </tr>
                <!-- PREFECTURE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                  PREFECTURE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['prefecture'] }}</span>
                  </td>
                </tr>
                <!-- PÈRE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                  @php echo $dataPDF['sex'] == 'M' ? 'FILS' : 'FILLE' @endphp DE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['father'] }}</span>
                  </td>
                </tr>
                <!-- MÈRE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                  ET DE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['mother'] }}</span>
                  </td>
                </tr>
                <!-- PROFESSION -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    PROFESSION :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['profession'] }}</span>
                  </td>
                </tr>
                <!-- TAILLE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    TAILLE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['size'] }}</span>
                  </td>
                </tr>
                <!-- TEINT -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    TEINT :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['complexion'] }}</span>
                  </td>
                </tr>
                <!-- CHEVEUX -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    CHEVEUX :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['hairs'] }}</span>
                  </td>
                </tr>
                <!-- SIGNES PARTICULIERS -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    SIGNES PARTICULIERS :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['particular_sign'] }}</span>
                  </td>
                </tr>
                <!-- DOMICILE -->
                <tr>
                  <td style="padding-bottom: 20px;">
                    DOMICILE :
                  </td>
                  <td style="padding-bottom: 20px;">
                    <span style="font-weight: bold;">{{ $dataPDF['home_address'] }}</span>
                  </td>
                </tr>
              </table>
            </td>
            <!-- PHOTO -->
            <td width="25%" style="vertical-align:top; text-align:center; padding-left: 20px;">
              <div style="border: 2px dashed #000; width: 150px; height: 170px; display: flex; align-items: center; justify-content: center; margin: 0 auto; color: #555;">
              </div>
            </td>
          </tr>
        </table>
        
        <!-- ── PIED DE PAGE ───────────────────────────────────────── -->
        <table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 100px;">
          <tr>
            <td width="20%" style="text-align: center;">
              <img src="{{ public_path('assets/img/qrcode.jpeg') }}" style="height: 130px;" alt="QR Code" />
            </td>
            <td width="50%"></td>
            <td width="30%" style="text-align: center;position: relative;">
              Fait à {{ $dataPDF['agency'] }}, le {{ $dataPDF['validated_at'] }}
              <div style="font-weight: bold;margin: 5px 0 100px;">Le Consul</div >
              @if($dataPDF['stamp'])
                <img src="{{ public_path('storage/' . $dataPDF['stamp']) }}" style="height: 80px;position: absolute; top: 50px; left: 0;" alt="Cachet" />
              @endif
              @if($dataPDF['signature'])
                <img src="{{ public_path('storage/' . $dataPDF['signature']) }}" style="height: 60px;position: absolute; top: 50px; right: 0;" alt="Signature" />
              @endif
              <div style="font-weight: bold;">{{ $dataPDF['consul'] }}</div>
            </td>
          </tr>
        </table>
      </div><!-- /content -->
    </div><!-- /dmd-container -->
  </body>
</html>