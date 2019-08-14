<?php
	require_once('./conn.php');

  $id = $_GET['id'];
  $sql = "DELETE FROM zoeGuava_comments WHERE id =" . $id;
  if ($conn->query($sql)) {
  	header("Location: ./index.php?page=1");
  } else {
  	die("failed.");
  }

?>