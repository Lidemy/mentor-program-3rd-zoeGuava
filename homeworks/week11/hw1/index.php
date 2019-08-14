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
							if(!isset($_COOKIE["user_id"])) {
							    echo '<div class="login_title">請先登入 or 註冊</div>';
							    echo '<div class="login_item">';
							    echo '<a href="login.php">登入</a>';
							    echo '<a href="registered.php">註冊</a>';
							    echo '</div>';
							} else {
								  // 把 certificates 資料庫裡面符合 cookie user_id 的 username 抓出來
									$cookie_sql = "SELECT username from zoeGuava_certificates where user_id =" . "$_COOKIE[user_id]";
									$cookie_result = $conn->query($cookie_sql);
								  $cookie_row = $cookie_result->fetch_assoc();
								  $cookie_username = $cookie_row['username'];

								  // 比對 users 資料庫裡面符合 cookie 所存帳號的 username, nickname 抓出來
									$certificate_sql = "
										SELECT zoeGuava_users.username, zoeGuava_users.nickname 
										from zoeGuava_certificates 
										LEFT JOIN zoeGuava_users 
										ON zoeGuava_users.username = " . "'$cookie_username'";
									$certificate_result = $conn->query($certificate_sql);
								  $certificate_row = $certificate_result->fetch_assoc();

							    echo '<div>帳號：' . $certificate_row["username"] . '</div>';
							    echo '<div>暱稱：' . $certificate_row["nickname"] . '</div>';
							    echo '<input type="hidden" name="nickname" value="' . $certificate_row["nickname"] . '">';
							    echo '<input type="hidden" name="username" value="' . $certificate_row["username"] . '">';
							    echo '留言內容：<textarea name="comments" rows="10" class="edit_comments"></textarea>';
							    echo '<input type="submit" value="送出">';
							}
						?>
					</form>
					<form method="POST" action="handle_logout.php">
						<?php
						  if (isset($_COOKIE["user_id"])) {
						  	echo '<input type="submit" value="點此登出">';
						  }
						?>
					</form>
				</div>
				<div class="container_page">
					<?php
					  // 產生分頁
				    include('page.php');
					?>
				</div>
				<div class="container_list">
					<div class="head">
						<div class="title_nickname">暱稱</div>
						<div class="title_comments">留言內容</div>
						<div class="title_time">留言時間</div>
					</div>
					<?php
					  // $start 是在 page.php 裡面的 $start = ($page-1) * $limit;
					  // 所產生的是每一頁第一個留言在資料庫中的編號
						$sql = 'SELECT * from zoeGuava_comments ORDER BY created_at DESC LIMIT ' . $start . ',' . $limit;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo '<div class="row">';
								// 如果欄位中的暱稱符合 cookie 中所存的；則在旁邊加上編輯、刪除的按鈕
								if (isset($_COOKIE["user_id"]) && $row['nickname'] === $certificate_row['nickname']) {
									echo '<div class="set_btn">';
									echo "<a href='update.php?id=$row[id]'>編輯</a>";
									echo "<a href='delete.php?id=$row[id]'>刪除</a>";
									echo '</div>';
								}
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
		<script>
			// 阻止再次點擊當前頁面會重新跳轉
			const active = document.querySelector('.active');
			active.addEventListener('click', function(e) {
				e.preventDefault();
			}, false)
		</script>
	</body>
	</html>	