<?php
  require_once('./conn.php');

  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $comments = $_POST['comments'];
  $id = $_POST['id'];

  if(empty($comments) || empty($id)) {
    die('empty data');
  }

  $sql = "UPDATE zoeGuava_comments SET comments = '$comments' WHERE id = " . $id;
  $result = $conn->query($sql);
  if ($result) {
    header("Location: ./index.php?page=1");
  } else {
    die('failed. ' . $conn->error);
  }
?>