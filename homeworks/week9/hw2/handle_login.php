<?php
	require_once('conn.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
  	die('有地方沒輸入資料');
  }

  $sql = 'SELECT * FROM zoeGuava_users WHERE username="' . $username . '" and password="' . $password . '"';
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  	// echo 'successful~登入成功';
    setcookie("user", "$username", time()+3600*24);
  	// 輸出一個 http 的 response header
  	header('Location: ./index.php');
  } else {
  	echo 'failed' . $conn->error;
    echo $result;
  }
?>