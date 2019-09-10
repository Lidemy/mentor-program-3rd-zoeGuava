## 請說明 SQL Injection 的攻擊原理以及防範方法

### 關於原理以及攻擊方式

SQL Injection 是透過登入時把輸入的帳號密碼直接帶入登入的 SQL 語法的這個做法來安插一些 SQL 的語法達到不用輸入密碼就能登入、或是竊取資料庫資料的目的。

以下面的例子來說：

```SQL
-- 這是原本寫的語法
SELECT * FROM u WHERE user='$user' and pwd='$pwd'

-- 當 $user 被輸入 `' or 1=1 -- '`
SELECT * FROM users WHERE username='' or 1=1 -- '' and password=''
```

選擇 user 中的所有欄位，當 username = 空字串 或是 1 = 1 的時候回傳，
後面的 `--` 是註解的意思，因為 1 = 1 是一定成立的，所以會直接通過這個語法。
當前面的布林值都為 true 而且後面的部分都被註解掉之後，你就可以在中間插入你想要他執行的語法。

### 關於防範方法

**Prepare Statement**
一個資料庫常常會執行到一些非常類似的語法，像是留言板的取得使用者暱稱以及留言內容就是一個重複執行多次的語法，所以要預先準備這個語法給資料庫來增加執行的效率。
原本的執行步驟是：**檢查 > 解析 > 執行 > 回傳**
先用 prepare statement 準備：**檢查 > 解析 > 保存**
執行進行過 prepare statement 的語法：**執行 > 回傳**

我們的寫法會改成
```php
// 宣告要執行的語法給 $conn->prepare
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? and password=?");
$stmt->bind_param("ss", $username, $password); // 把變數加入 parameter 裡
$stmt->execute(); // 執行 SQL 語法
$result = $stmt->get_result(); // 取得 SQL 執行後的結果
if ($result->num_rows > 0) { // 判斷執行後有無取得值
  $row = $result->fetch_assoc();
  setcookie("user_id", $row['id'], time()+3600*24);
} else {
  $error_message = '帳號密碼錯誤';
}
```
這個寫法會先建立一個模板，並且設定參數的型別，`bind_param("ss"...)` 的 S 指的便是 string，若是輸入的資料不符合規定的類型便無法執行。

參考文章：[MySQL 超新手入門（12）Prepared Statement](http://www.codedata.com.tw/database/mysql-tutorial-12-prepared-statement/)

---

## 請說明 XSS 的攻擊原理以及防範方法

### XSS 攻擊原理

XSS（Cross - Site Scripting）跨站式腳本攻擊，亦即將惡意代碼植入網站內達到竊取使用者資料、將網站導向釣魚網站、影響使用者體驗...等目的。
目前最為熟悉的部分是植入 JacaSvript 或是 HTML 標籤來達到目的，依據植入、執行攻擊的方式有下列三種：

- Stored XSS (儲存型)
透過保存在資料庫中的程式碼來引起攻擊的方式，以留言板來說就是在留言欄位中輸入帶有 `<script>` 標籤的 JavaScript 代碼，儲存到資料庫中，待要把它顯示時，便會執行標籤內的程式碼。

- Reflected XSS (反射型)
不是儲存在資料庫中，而是透過更改網址，待使用者點擊後會執行特定的語法。常見於在傳送資料至伺服器時，把該頁面的變數顯示在 url 上，若在要傳送時輸入的是 `<script>`，內容同樣會作為 JavaScript 而被執行。

- DOM-Based XSS (基於 DOM 的類型)
與前兩者不同的地方在於這個的防護要在用戶端去做，這類型的攻擊是對於 HTML 的 DOM 進行操控來導入惡意的程式碼，在使用 innerHTML 時會將內容視為 HTML 來執行，需改為 innerText 來確保內容會作為純文字顯示。

### XSS 防範方法

上述的攻擊方式前兩種都是因為把帶有 HTML 標籤的內容輸入，等到網頁把輸入的內容輸出時會把它作為 HTML 標籤來執行。
當然可以在輸入的時候就先進行過濾，把 `<script>` 等字元給過濾掉，但是這治標不治本，當他輸入 `<scr<script>ipt>` 的時候結果還是不會變，最根本的方式是在顯示內容的時候將所有內容作為**純文字**顯示。

這個方法稱為：escape

```php
// 原本的是這樣
echo $row['content'];

// 改成
echo htmlspecialchars($str, ENT_QUOTES, 'utf-8');
echo htmlspecialchars($row['content'], ENT_QUOTES, 'utf-8');
// 這樣就不會被當成是一個 HTML 的標籤來執行了，而是變成純文字來顯示
```
這麼一來在這個區塊（`$row['content']`）所輸入的東西就會以純文字的方式**顯示**，而不會被執行
所以上面輸入的` <h1>test</h1>` 就不會顯示 h1 大小的文字，而是直接把這一串給顯示出來
同樣的 `<script>alert(1);</script>` 也是一樣不會被執行而是直接顯示出來
**記得，escape 是在你顯示內容的時候，而不是儲存的時候**

---

## 請說明 CSRF 的攻擊原理以及防範方法

### CSRF 的攻擊原理

跟上述的 XSS 反射型有一些類似，當你點到、或是觸發一個連結之後，連結會在你不知情的情況下去做攻擊者想達到的目的，或是把連結藏在 `<img src='evil.com'>` 裡面，一旦進入該網站便會直接執行。
但不同的地方在於 CSRF 的攻擊前提是你要在登入的狀態，在登入狀態的時候瀏覽器 cookie 會儲存 session_id 好辨識現在的使用者是妳，但你在持有這個 session_id 的情況下，點了攻擊者放在旁邊的圖「恭喜你成為第 100000 訪問者，點及領獎！」，點下去之後的連結是直接把你現在購物車內的商品數量 X10 並直接送出結帳、扣款。

像是刪除文章這一類的功能如果是用單純的 GET 方式去達成：
```HTML+PHP
<a href="article.com/delete?id=31">DELETE</a>
```
在實際執行**刪除**動作之前沒有進行其他的驗證、確認就直接刪掉的話，駭客只要把這個連結夾帶在其他圖片、看似無害的連結之中，當使用者點擊後就會直接把文章刪掉。

### CSRF 的防範方法

CSRF 的攻擊目的是在未經使用者同意的情況下進行操作，所以必須確認這件事情是不是使用者想做的。
像是在線上使用信用卡付款的時候，他會寄含有驗證碼的簡訊給你，輸入驗證碼之後才會成功付款，這便是其中一個方式。
我們之前設定的 session id 雖然也是一個驗證的方式，但是他是存在你的瀏覽器之中，你使用同樣的瀏覽器去點擊惡意連結，也連帶把 session id 給送出去來通過驗證了，所以只有這個是不夠的，

除了登入的時候產生 session id 給伺服器端驗證之外，在進行較為重要的操作時也隨機產生一個系統指定的亂數給資料庫判斷，這個新產生的亂數符合系統規定時才會執行使用者做的事情。有些網站在你已經登入的時候，要執行購買行為時，會要求你重新輸入一次帳號密碼，也是因為要重新產生一個亂數傳上去給系統辨別。這種每次使用者從瀏覽器端發出 request 時就夾帶一個亂數上去進行驗證的方式就叫做 Synchronizer Token Pattern。

還有另外一種常見的方式，輸入驗證碼。
有不少的網站在你結帳或是確認購買之前都會有一個欄位，旁邊會有一個比較歪七扭八的文字要你輸入至欄位，相互比對通過之後才會讓你去結帳。


參考文章：
[](https://blog.techbridge.cc/2017/02/25/csrf-introduction/)
[從防禦認識CSRF](https://www.ithome.com.tw/voice/115822)
[Cross-site Request Forgery (Part 2)](https://cyrilwang.pixnet.net/blog/post/31813672)
[程式猿必讀-防範CSRF跨站請求偽造](https://codertw.com/%E7%A8%8B%E5%BC%8F%E8%AA%9E%E8%A8%80/109775/)
