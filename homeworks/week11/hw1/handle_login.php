<?php
	require_once('conn.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
  	die('有地方沒輸入資料');
  }

  $sql = "SELECT `password` FROM `zoeGuava_users` WHERE username=". "'$username'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (password_verify($password, $row['password'])) {
  	// echo 'successful~登入成功';
    // 亂數產生一個通行證 ID，並且在資料庫裡面記下通行證 ID 與會員 ID 的對應關係
    $user_id = rand(10000000,99999999);
    $sql_certificate = "INSERT INTO zoeGuava_certificates(user_id, username) VALUES('$user_id', '$username')";
    $result_certificate = $conn->query($sql_certificate);
    setcookie("user_id", "$user_id", time()+3600*24);
  	header('Location: ./index.php?page=1');
  } else {
  	echo 'failed' . $conn->error;
    echo $result;
  }
?>