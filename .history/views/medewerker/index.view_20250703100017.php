<?php require_once base_path("views/partials/head.php") ?>

<?php require_once base_path("views/partials/nav.php") ?>

<?php require_once base_path("views/partials/header.php") ?>

<div class="wrapper">
    <a href="medewerker"></a>
    <table class="tb-account">
        <caption class="caption-account">
            Alle geregristreerde Medewerker
        </caption>
        <tr>
            <th class="th-account">Medewerker naam</th>
            <th class="th-account">Nummer</th>
            <th class="th-account">Soort Medewerker</th>
            <th class="th-account">Wijzigen</th>
            <th class="th-account">Verwijderen</th>
        </tr>

        <?php if (!empty($medewerker)): ?>
            <?php foreach ($medewerker as $medewerk): ?>
                <tr>
                    <td class="data-cell td-account" data-cell="Volledige naam">
                        <?= htmlspecialchars($medewerk['VolledigeNaam']) ?>
                    </td>
                    <td class="data-cell td-account" data-cell="Nummer">
                        <?= htmlspecialchars($medewerk['Nummer']) ?>
                    </td>
                    <td class="data-cell td-account" data-cell="Soort Medewerker">
                        <?= htmlspecialchars($medewerk['Medewerkersoort']) ?>
                    </td>
                    <td class="data-cell td-account" data-cell="Wijzigen">
                        <a href="#"><img class="icon" src="/img/update.png" alt="Update"></a>
                    </td>
                    <td class="data-cell td-account" data-cell="Verwijderen">
                        <a href="#"><img class="icon" src="/img/delete.png" alt="Delete"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="error-message">
                    Er zijn geen geregistreerde Medewerker gevonden.
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php require_once base_path("views/partials/footer.php") ?>