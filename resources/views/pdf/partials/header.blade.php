{{-- ══ EN-TÊTE COMMUN AMBASSADE DE GUINÉE ══════════════════════════════════ --}}
<table class="header-table" cellspacing="0" cellpadding="0">
  <tr>
    {{-- Armoirie + République --}}
    <td class="header-logo">
      <img src="{{ public_path('assets/img/amoirie.png') }}" style="height: 90px;" alt="Armoirie" /><br>
      <strong>RÉPUBLIQUE DE GUINÉE</strong><br>
      <span style="font-size: 8pt; font-style: italic;">
        Travail - Justice - Solidarité
      </span><br>
      --------
    </td>

    {{-- Ministère + Ambassade --}}
    <td class="header-center">
      MINISTÈRE D'ÉTAT, MINISTÈRE DES AFFAIRES ÉTRANGÈRES<br>
      ET DES GUINÉENS DE L'ÉTRANGER<br>
      ----------------<br>
      <strong>
        AMBASSADE DE LA RÉPUBLIQUE DE GUINÉE<br>
        EN CÔTE D'IVOIRE - {{ $dataPDF['agency'] }}
      </strong><br>
      ----------------
    </td>

    {{-- Logo Nimba --}}
    <td class="header-right">
      <img src="{{ public_path('assets/img/nimba.png') }}" style="height: 120px;" alt="Nimba" />
    </td>
  </tr>
</table>
