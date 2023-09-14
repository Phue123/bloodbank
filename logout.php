<?php
session_start();
// session_destroy();
unset($_SESSION['user_connected']);
header('Location: index.php');
?>