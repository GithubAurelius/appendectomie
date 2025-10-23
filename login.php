<?php
// ini_set('session.cookie_httponly', 1);
// ini_set('ssession.cookie_secure', 1);
// ini_set('session.use_only_cookies', 1);
// ini_set('session.gc_probability', 1);
// ini_set('session.gc_divisor', 100);
session_start();
// session_regenerate_id();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$_SESSION = [];
$_SESSION['debug'] = 1;
$_SESSION = parse_ini_file("/mainData/mdueffelmeyer/MIQ_projects/appendectomie/appendectomie.ini"); // CONFIG
require_once $_SESSION['INI-PATH'];
require_once MIQ_ROOT . "modules/patches/update_db.php";
require_once MIQ_ROOT_PHP . "login_base.php";


?>


<!DOCTYPE html>
<html lang="de">
<html>

<head>
    <title><?php echo $_SESSION['PROJECTNAME'] ?> Anmeldeformular</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>css/login.css?RAND=<?php echo random_bytes(5); ?>">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h2>Appendektomie<br><font style='font-size:16px'>bei therapierefraktärer Colitis ulcerosa</font></h2>
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Anmelden</button><br><br><?php echo $message ?>
    </form>

</body>

</html>