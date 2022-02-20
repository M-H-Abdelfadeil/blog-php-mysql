<?php
session_start();
unset($_SESSION['user']);


return header('location:login.php');