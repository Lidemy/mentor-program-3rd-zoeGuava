<?php
	require_once('conn.php');
	include_once('utils.php');
?>

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
					<!-- 登入、登出 -->
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
									$cookie_sql = "SELECT username from zoeGuava_certificates where user_id = $_COOKIE[user_id]";
									$cookie_result = $conn->query($cookie_sql);
								  $cookie_row = $cookie_result->fetch_assoc();
								  $cookie_username = $cookie_row['username'];

								  // 比對 users 資料庫裡面符合 cookie 所存帳號的 username, nickname 抓出來
									$certificate_sql = "
										SELECT u.username, u.nickname 
										from zoeGuava_certificates as c
										LEFT JOIN zoeGuava_users as u
										ON u.username = " . "'$cookie_username'";
									$certificate_result = $conn->query($certificate_sql);
								  $certificate_row = $certificate_result->fetch_assoc();

							    echo '<div>帳號：' . $certificate_row["username"] . '</div>';
							    echo '<div>暱稱：' . $certificate_row["nickname"] . '</div>';
							    echo '<input type="hidden" name="nickname" value="' . $certificate_row["nickname"] . '">';
							    echo '<input type="hidden" name="username" value="' . $certificate_row["username"] . '">';
							    echo '<input type="hidden" name="parent_id" value=0>';
							    echo '留言內容：<textarea name="comments" rows="10" class="edit_comments"></textarea>';
							    echo '<input type="submit" value="送出">';
							    $login = true;
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
					<!-- <div class="row test_row">
						<div class="comment_head">
							<div class="set_btn">
								<a href='#'>編輯</a>
								<a href='#'>刪除</a>
							</div>
							<div class="comment_title">
								<div class="title_nickname">暱稱</div>
								<div class="title_comments">留言內容</div>
								<div class="title_time">留言時間</div>
							</div>
							<div class="comment_main">
								<div class="nickname">15315645</div
								><div class="comments">氣泣泣泣泣</div
								><div class="created_time">2077-07-07 17:17:07</div>
							</div>
							<div>其他人的回覆</div>
							<div class="comment_sub">
								<div class="set_btn">
									<a href='#'>編輯</a>
									<a href='#'>刪除</a>
								</div>
								<div>暱稱：sub排版用ㄉ</div>
								<div>內容：sub氣泣泣泣泣</div>
								<div>留言時間：2077-07-07 17:17:07</div>
							</div>
							<div class="comment_reply">
								<div>帳號：</div>
								<div>暱稱：</div>
								<div>輸入留言內容：</div>
								<textarea name="comments" rows="5" cols="35" class="edit_comments"></textarea>
								<input type="submit" value="送出">
							</div>
						</div>
					</div> -->
					<!-- 留言板 -->
					<?php
					  // $start 是在 page.php 裡面的 $start = ($page-1) * $limit;
					  // 所產生的是每一頁第一個留言在資料庫中的編號
						// $sql = 'SELECT * from zoeGuava_comments ORDER BY created_at DESC LIMIT ' . $start . ',' . $limit;
						$sql = '
							SELECT *
							from zoeGuava_comments as c 
							WHERE c.parent_id = 0
							ORDER BY created_at DESC 
							LIMIT ' . $start . ',' . $limit;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo '<div class="row">';
								echo '<div class="comment_head">';
								echo $comment_title;
								echo '<div class="comment_main">';
								echo '<div class="nickname">' . $row['nickname'] . '</div>';
								// echo '<div class="comments">' . $row['comments'] . '</div>';
								// 解決 XSS 問題，把輸出轉換為純文字
								echo '<div class="comments">' . htmlspecialchars($row['comments'], ENT_QUOTES, 'utf-8') . '</div>';
								echo '<div class="created_time">' . $row['created_at'] . '</div>';
								echo '</div>';
								// 如果欄位中的暱稱符合 cookie 中所存的；則在旁邊加上編輯、刪除的按鈕
								if ($login === true && $row['nickname'] === $certificate_row['nickname']) {
									set_btn($row['id']);
								}

								$sql_sub = "
										SELECT * 
										FROM zoeGuava_comments as c 
										WHERE c.parent_id = $row[id]
										ORDER BY created_at DESC
									";
								$result_sub = $conn->query($sql_sub);
								if ($result_sub->num_rows > 0) {
									echo '<div class="comment_status">其他人的回覆</div>';
									while ($row_sub = $result_sub->fetch_assoc()) {
										if ($row_sub['nickname'] === $row['nickname']) {
											echo '<div class="comment_sub comment_parent">';
										} else {
											echo '<div class="comment_sub">';											
										}
										if ($login === true && $row_sub['nickname'] === $certificate_row['nickname']) {
											set_btn($row_sub['id']);
										}
										echo '
											<div>暱稱：'.$row_sub["nickname"].'</div>
											<div>內容：'.$row_sub["comments"].'</div>
											<div>留言時間：'.$row_sub["created_at"].'</div>
										';
										echo '</div>';
									}
								} else {
									echo '<div class="comment_status">來搶頭香吧！</div>';
								}

								if(isset($_COOKIE["user_id"])) {
									echo '
										<form method="POST" action="handle_add.php" class="comment_reply">
											<div>帳號：' . $certificate_row["username"] . '</div>
											<div>暱稱：' . $certificate_row["nickname"] . '</div>
											<div>輸入留言內容：</div>
											<textarea name="comments" rows="5" cols="35" class="edit_comments"></textarea>
											<input type="hidden" name="nickname" value="' . $certificate_row["nickname"] . '">
											<input type="hidden" name="username" value="' . $certificate_row["username"] . '">
											<input type="hidden" name="parent_id" value="' . $row["id"] . '">
											<input type="submit" value="送出">
										</form>
									';
								}
								echo '</div>';
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