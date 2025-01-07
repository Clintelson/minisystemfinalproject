<?php

session_start();

unset($_SESSION['ID']);

header('location: signin.php');

?>