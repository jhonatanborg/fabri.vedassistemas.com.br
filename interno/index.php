<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['s_login'])) {
  session_destroy();
  header("Location:logout.php"); exit;
}

?>
