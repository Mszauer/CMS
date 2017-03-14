<?php include "db.php"; ?>
<?php include ob_start() ?>
<?php session_start(); ?>
<?php
    $_SESSION['username'] = null;
    header("Location: ../index.php");
?>