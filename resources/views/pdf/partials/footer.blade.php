{{-- ══ PIED DE PAGE COMMUN ════════════════════════════════════════════════ --}}
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    {{-- QR Code --}}
    <td width="20%" style="text-align:center; vertical-align:middle;">
        <img src="{{ public_path('assets/img/qrcode.jpeg') }}" style="height: 120px;" alt="QR Code" />
    </td>
    {{-- Espace central --}}
    <td width="45%"></td>
    {{-- Bloc signature --}}
    <td width="35%" style="text-align:center; vertical-align:middle;">
      <div style="margin-bottom: 5px;">
        Fait à {{ $dataPDF['consulat'] }}, le {{ $dataPDF['validated_at'] }}
      </div>
      <div style="font-weight:bold;">LE CONSUL</div>
      {{-- Cachet + Signature côte à côte (sans position absolute) --}}
      <table width="100%" cellspacing="5" cellpadding="0">
        <tr>
          <td width="50%" style="text-align:center; vertical-align:middle;height: 100px;">
            @if($dataPDF['stamp'])
              <img src="{{ public_path('storage/' . $dataPDF['stamp']) }}" style="height: 80px;" alt="Cachet" />
            @endif
          </td>
          <td width="50%" style="text-align:center; vertical-align:middle;height: 100px;">
            @if($dataPDF['signature'])
              <img src="{{ public_path('storage/' . $dataPDF['signature']) }}" style="height: 80px;" alt="Signature" />
            @endif
          </td>
        </tr>
      </table>
      <div style="font-weight:bold; margin-top: 10px;">
        {{ $dataPDF['consul'] }}
      </div>
    </td>
  </tr>
</table>

{{-- ── Mention légale ────────────────────────────────────────── --}}
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 30px;">
  <tr>
    <td style="text-align:center; font-size: 8pt; font-style: italic; border-top: 1px solid #000; padding-top: 6px;">
      Ce document n'est valable que muni du sticker de l'Ambassade de Guinée en Côte d'Ivoire
    </td>
  </tr>
</table>