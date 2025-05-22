<?php require_once base_path("views/partials/head.php") ?>

<?php require_once base_path("views/partials/nav.php") ?>

<?php require_once base_path("views/partials/header.php") ?>

<div class="wrapper">
    <table class="tb-account">
        <caption class="caption-account">
            Alle geregristreerde accounten
        </caption>
        <tr>
            <th class="th-account">Volledige naam</th>
            <th class="th-account">Email</th>
            <th class="th-account">Wijzigen</th>
            <th class="th-account">Verwijderen</th>
        </tr>

        <?php if (!empty($accounts)): ?>
            <?php foreach ($accounts as $account): ?>
                <tr>
                    <td class="data-cell td-account" data-cell="Volledige naam">
                        <?= htmlspecialchars($account['VolledigeNaam']) ?>
                    </td>
                    <td class="data-cell td-account" data-cell="Email">
                        <?= htmlspecialchars($account['Gebruikersnaam']) ?>
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
                <td colspan="4" class="error-message">
                    Er zijn geen geregistreerde accounts gevonden.
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<?php require_once base_path("views/partials/footer.php") ?>