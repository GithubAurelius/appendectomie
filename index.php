<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1) header('Location: login.php');

$ini_path = $_SESSION['INI-PATH'] ?? "";
if ($ini_path) require_once $ini_path;
else {
    echo "<h2><b>Sie wurden abgemeldet!</b><h3>Scannen Sie Ihren Code erneut ein ...<br><br>oder melden Sie sich bitte über die <a href='../'>Startseite<a> an, wenn Sie über Zugangsdaten verfügen!</h3>";
    exit;
}
check_path_change(__DIR__);
require 'index_param.php';

if (!isset($_SESSION['rl'])) header('Location: login.php'); // AGAIN: if user get no rights, even on token-login
require MIQ_ROOT_PHP . 'index_base.php';

?>
<!DOCTYPE html>
<html lang="de">
<html>

<head>
    <title><?php echo $_SESSION['PROJECTNAME'] ?> MIQ 8</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        miq_root_path = <?php echo json_encode(MIQ_PATH) ?>;
    </script>
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>css/index.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<?php echo MIQ_PATH ?>js/index.js?RAND=<?php echo random_bytes(5) ?>"></script>
    <script>
        var table_edit = <?php echo json_encode($_SESSION['table_edit'] ?? 0) ?>;
        var window_boxes = {};
        <?php
        write_js_winbox_def($data_a);

        ?>
    </script>
</head>

<body>
    <nav id="main_menue">
        <div class="menu-toggle">Menü</div>
        <ul class="main-nav"><?php build_menue($men_a); ?></ul>
    </nav>

    <?php if ($_SESSION['m_uid'] == 1): ?>
        <div class="dashboard-wrapper">
            <div class="dashboard-container">


                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">Statistiken</h2>
                        <p class="dashboard-card-text">Details zu Zahlen oder Kennzahlen.</p>
                    </div>

                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">Letzte Aktivitäten</h2>
                        <p class="dashboard-card-text">Log-Informationen oder Benutzeraktionen.</p>
                    </div>


                    <div class="dashboard-card">
                        <h2 class="dashboard-card-title">User und System</h2>
                        <p class="dashboard-card-text"><?php require_once MIQ_ROOT_PHP . 'sys_info.php'; ?></p>
                    </div>

                    <?php if ($_SESSION['uid'] == 1) { ?>
                        <div class="dashboard-card" style="padding:5px;">
                            <h2 class="dashboard-card-title">Session-Info</h2>
                            <div style="color:silver;max-height: 200px; overflow: auto;scrollbar-color: #888 transparent; scrollbar-width: thin;">
                                <p class="dashboard-card-text">
                                <pre><?php print_r($_SESSION); ?></pre>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class='fixed_logo_box'></div>
    <?php
    if (DEBUG) {
        echo "*** DEBUG-MODE ***<br>";
        echo "Upload:" . UPLOAD_BASE . UPLOAD_SUB_PATH . "<br>";
        echo "<pre>";
        echo print_r($_SESSION);
        echo "</pre>";
    }

    require_once 'session.php';
    ?>
    <script>
        document.querySelectorAll('li a').forEach(function(link) {
            if (link.textContent.includes('🚫Exit')) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Seite nicht sofort laden
                    // console.log("Exit geklickt!");
                    window.location.href = 'login.php'; // dann login.php aufrufen
                });
            }
        });

        document.getElementById("main_menue").style.setProperty("height", men_height + "px");
        eL_show_hide_menue();
        activate_menue();

        document.documentElement.style.cssText = `
            background-color: white;
            background-image: url('images/appendektomie_back.jpg');
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        `;
    </script>
</body>

</html>