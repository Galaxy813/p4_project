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

<?php if (!empty($_SESSION['success'])): ?>
    <div id="popup-success" style="
    position: fixed;
    bottom: 0%;
    right: 0%;
    transform: translate(-50%, -50%);
    background-color: #4ea253;
    color: rgb(255, 255, 255);
    padding: 25px 40px;
    font-size: 1.6em;
    border-radius: 10px;
    border: 1px solid rgb(79, 111, 79);
    box-shadow: 0 5px 30px rgba(0,0,0,0.2);
    font-weight: bold;
    z-index: 9999;
    opacity: 0.9;
    transition: opacity 0.5s ease-out;
">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <script>
        setTimeout(() => {
            const popup = document.getElementById('popup-success');
            if (popup) {
                popup.style.opacity = '0';
                setTimeout(() => popup.remove(), 500);
            }
        }, 3000);

        // Optioneel: sluit popup bij klikken
        document.getElementById('popup-success').addEventListener('click', () => {
            const popup = document.getElementById('popup-success');
            popup.style.opacity = '0';
            setTimeout(() => popup.remove(), 500);
        });
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php require_once base_path("views/partials/footer.php") ?>