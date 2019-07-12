<?php
	require_once('conn.php');

  setcookie("user", "", time()+3600*24);
	header('Location: ./index.php');
?>