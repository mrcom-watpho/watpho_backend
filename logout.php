<?php
    unset($_COOKIE['id']);
    unset($_COOKIE['emp_fullname']);
    unset($_COOKIE['auth']);

    setcookie('id', '', time()-(86400 * 30));
    setcookie('emp_fullname', '', time()-(86400 * 30));
    setcookie('auth', '', time()-(86400 * 30));

    $url = "login.php";
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=".$url."\" />";
?>