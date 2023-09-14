<?php
session_start();
// session_destroy();
unset($_SESSION['admin_connected']);
header('Location: login.php');
?>