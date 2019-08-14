<?php
	require_once('conn.php');

  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password_hash = password_hash($password, PASSWORD_DEFAULT);

  if (empty($username) || empty($nickname) || empty($password)) {
  	die('有地方沒輸入資料');
  }

  $sql = "INSERT INTO zoeGuava_users(username, nickname, password) VALUES('$username', '$nickname', '$password_hash')";
  $result = $conn->query($sql);

  if ($result) {
  	// echo 'successful~';
  	// 輸出一個 http 的 response header
  	header('Location: ./login.php');
  } else {
  	echo 'failed' . $conn->error;
  }
?>