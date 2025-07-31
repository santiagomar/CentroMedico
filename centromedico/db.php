<?php
$db = new mysqli("localhost","root","","centromedico_db");
if ($db->connect_error) die("Conexión fallida: ".$db->connect_error);
session_start();

// Timeout de inactividad (30 min)
$timeout = 1800;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset(); session_destroy();
    header('Location: login.php?timeout=1'); exit;
}
session_regenerate_id(true);
$_SESSION['LAST_ACTIVITY'] = time();
?>
