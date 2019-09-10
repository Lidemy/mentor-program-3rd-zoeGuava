<?php
	require_once('conn.php');

  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $comments = $_POST['comments'];
  $parent_id = $_POST['parent_id'];

  if (empty($comments)) {
  	die('請輸入留言');
  }

  $stmt = $conn->prepare("INSERT INTO zoeGuava_comments(username, nickname, comments, parent_id) VALUES(?, ?, ?, ?)");
  $stmt->bind_param("ssss", $username, $nickname, $comments, $parent_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($stmt->affected_rows > 0) {
  	// echo 'successful~';
  	// 輸出一個 http 的 response header
  	header('Location: ./index.php?page=1');
  } else {
  	echo '出錯原因：' . $conn->error;
  }
?>