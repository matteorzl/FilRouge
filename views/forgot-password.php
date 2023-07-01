<?php
session_start();
if (isset($_SESSION['message'])) {
  echo "{$_SESSION['message']}";
  unset($_SESSION['message']);
}
require_once "header.php";
require_once "database.php";
require_once "sendgrid-php/sendgrid-php.php"
?>