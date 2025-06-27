<?php require_once base_path("views/partials/head.php") ?>
<?php require_once base_path("views/partials/nav.php") ?>
<?php require_once base_path("views/partials/header.php") ?>

<div class="wrapper">
    <table class="tb-account">
        <caption class="caption-account">
            Alle geregistreerde accounts
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

                    <!-- Wijzigen knop -->
                    <td class="data-cell td-account" data-cell="Wijzigen">
                        <a href="/edit?id=<?= $account['Id'] ?>" class="icon-button">
                            <img class="icon" src="/img/update.png" alt="Update">
                        </a>
                    </td>

                    <!-- Verwijderen knop -->
                    <td class="data-cell td-account" data-cell="Verwijderen">
                        <form method="POST" action="/accounts/destroy"
                            onsubmit="return confirm('Weet je zeker dat je dit account wilt verwijderen?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $account['Id'] ?? '' ?>">
                            <button type="submit" class="icon-button">
                                <img class="icon" src="/img/delete.png" alt="Delete">
                            </button>
                        </form>
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