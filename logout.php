<?php
    /* STARTING SESSION */
    session_start();

    /* CLEARING VARIABLES */
    $_SESSION = array();

    /* DESTROYING SESSION */
    session_destroy();

    /* REDIRECTING TO LOGIN PAGE */
    header("location: index.php");
    exit;
?>