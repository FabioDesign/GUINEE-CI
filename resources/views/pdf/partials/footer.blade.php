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
        Fait à {{ $dataPDF['agency'] }}, le {{ $dataPDF['validated_at'] }}
      </div>
      <div style="font-weight:bold;">Le Consul</div>
      {{-- Cachet + Signature côte à côte (sans position absolute) --}}
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%" style="text-align:left; vertical-align:middle;height: 100px;">
            @if(!$dataPDF['stamp'])
              <img src="{{ public_path('storage/' . $dataPDF['stamp']) }}" style="height: 80px;" alt="Cachet" />
            @endif
          </td>
          <td width="50%" style="text-align:right; vertical-align:middle;height: 100px;">
            @if(!$dataPDF['signature'])
              <img src="{{ public_path('storage/' . $dataPDF['signature']) }}" style="height: 80px;" alt="Signature" />
            @endif
          </td>
        </tr>
      </table>
      <div style="font-weight:bold; margin-top: 5px;">
        {{ $dataPDF['consul'] }}
      </div>
    </td>
  </tr>
</table>