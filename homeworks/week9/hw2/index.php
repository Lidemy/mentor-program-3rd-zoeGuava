<?php require_once('conn.php'); ?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
		<title>留言板</title>
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="container_alert">
					<h3>本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼</h3>
				</div>
				<div class="container_add">
					<form method="POST" action="handle_add.php" >
						<?php
							if(!isset($_COOKIE["user"])) {
							    echo '<div class="login_title">請先登入 or 註冊</div>';
							    echo '<div class="login_item">';
							    echo '<a href="login.php">登入</a>';
							    echo '<a href="registered.php">註冊</a>';
							    echo '</div>';
							} else {
									$nickname_sql = 'SELECT * from zoeGuava_users WHERE username="' . $_COOKIE["user"] . '"';
									$nickname_result = $conn->query($nickname_sql);
								  $nickname_row = $nickname_result->fetch_assoc();
							    echo '<div>帳號：' . $_COOKIE["user"] . '</div>';
							    echo '<div>暱稱：' . $nickname_row["nickname"] . '</div>';
							    echo '<input type="hidden" name="nickname" value="' . $nickname_row["nickname"] . '">';
							    echo '<input type="hidden" name="username" value="' . $_COOKIE["user"] . '">';
							    echo '留言內容：<textarea name="comments" rows="10" class="edit_comments"></textarea>';
							    echo '<input type="submit" value="送出">';
							}
						?>
					</form>
					<form method="POST" action="handle_logout.php">
						<?php
						  if (isset($_COOKIE["user"])) {
						  	echo '<input type="submit" value="點此登出">';
						  }
						?>
					</form>
				</div>
				<div class="container_list">
					<div class="head">
						<div class="title_nickname">暱稱</div>
						<div class="title_comments">留言內容</div>
						<div class="title_time">留言時間</div>
					</div>
					<?php
						$sql = 'SELECT * from zoeGuava_comments ORDER BY created_at DESC LIMIT 50';
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo '<div class="row">';
								echo '<div class="nickname">' . $row['nickname'] . '</div>';
								echo '<div class="comments">' . $row['comments'] . '</div>';
								echo '<div class="created_time">' . $row['created_at'] . '</div>';
								echo '</div>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
	</html>	