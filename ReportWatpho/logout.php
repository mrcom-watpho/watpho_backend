<?php
session_start();
unset($_SESSION['cookie_session']);
session_destroy();
header('location:https://watphotickets.com/logout.php');
?>