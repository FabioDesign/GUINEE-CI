{{-- ══ EN-TÊTE COMMUN AMBASSADE DE GUINEE ══════════════════════════════════ --}}
<table class="header-table" cellspacing="0" cellpadding="0">
  <tr>
    {{-- Armoirie + REPUBLIQUE --}}
    <td class="header-logo">
      <img src="{{ public_path('assets/img/amoirie.png') }}" style="height: 90px;" alt="Armoirie" /><br>
      <strong>REPUBLIQUE DE GUINEE</strong><br>
      <span style="font-size: 8pt; font-style: italic;">
        Travail - Justice - Solidarité
      </span><br>
      --------
    </td>

    {{-- Ministère + Ambassade --}}
    <td class="header-center">
      MINISTERE D'ETAT, MINISTERE DES AFFAIRES ETRANGERES<br>
      ET DES GUINEENS DE L'ETRANGER<br>
      ----------------<br>
      <strong>
        AMBASSADE DE LA REPUBLIQUE DE GUINEE<br>
        EN COTE D'IVOIRE - {{ $dataPDF['agency'] }}
      </strong><br>
      ----------------
    </td>

    {{-- Logo Nimba --}}
    <td class="header-right">
      <img src="{{ public_path('assets/img/branding.png') }}" style="height: 50px;" alt="Branding" />
    </td>
  </tr>
</table>
