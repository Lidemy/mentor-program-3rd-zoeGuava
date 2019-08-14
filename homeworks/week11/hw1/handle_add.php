<?php
	require_once('conn.php');

  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $comments = $_POST['comments'];

  if (empty($comments)) {
  	die('有地方沒輸入資料');
  }

  $sql = "INSERT INTO zoeGuava_comments(username, nickname, comments) VALUES('$username', '$nickname', '$comments')";
  $result = $conn->query($sql);

  if ($result) {
  	// echo 'successful~';
  	// 輸出一個 http 的 response header
  	header('Location: ./index.php?page=1');
  } else {
  	echo 'failllll' . $conn->error;
  }
?>