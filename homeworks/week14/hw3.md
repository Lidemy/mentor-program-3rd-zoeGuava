## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？

Domain Name System（網路域名系統），這個系統能夠把域名跟 IP 位址連接起來，這樣要造訪網站的時候就可以輸入該網站的域名（例：test.com）就可以連上，而不是輸入 IP 位址（例：189.165.220.331）來連接該網站。

對 Google 的好處是可以讓他有更多的數據來源，來建立一個更完整的使用者行為的資料庫。可以使搜尋引擎的結果更加精準，精準的統計數據也能讓 Google 本身資料的價值上升，可以提供一個能夠精確瞄準客群的廣告平台。

Google Public DNS 會幫用戶檢查輸入的網址是否有安全疑慮，對使用者可以享用一個較為快速安全的 DNS。


## 什麼是資料庫的 lock？為什麼我們需要 lock？

**race condition 競爭危害**，當兩個東西同時在存取一個東西時發生的衝突
像是搶票那種，有多個 request 同時抵達你的 server，而且物品或是票只剩下一個
把資料鎖起來，讓你在更新之前其他人不能存取到這個資料，用以保證你的資料是正確的
```MySQL
$conn->autocommit(FALSE);
$conn->begin_transaction();
$conn->query("SELECT amount FROM products for update");
-- [for update] 就是 Lock，這個 Lock 要在 transaction 裡面才有用。
-- 他會確定你先到的 query 先執行，等前面的執行完成之後才會執行後面的 query
-- 但這樣會有效能上的損耗，畢竟你要一個一個執行
$conn->commit();
```

```MySQL
-- 這個是一次 Lock 所有 Table
$conn->query("SELECT amount FROM products for update");
-- 可以改成這樣，只鎖一個 row
$conn->query("SELECT amount FROM products where id = 1 for update");
```


## NoSQL 跟 SQL 的差別在哪裡？

SQL 的資料庫是叫做關聯式資料庫（SQL，他是用很多個結構串起來的），要在 SQL 類型的資料庫裡新增資料勢必要建立一個 schema 以及資料格式好存取資料，然而當資料變得龐大、雜亂的時候會使得維護變得極為麻煩。
NoSQL 則不是，他沒有資料表的結構，可以想像成把資料當作 JSON 存進去資料庫裡面
大多用來儲存龐大的、**結構不固定**的資料，像是一些 log，有什麼就存什麼，一切都沒有限制。


## 資料庫的 ACID 是什麼？

以交易為例子的話，為了保證其正確性需要符 **ACID** 這四個特性

1. 原子性 atomaicity：要嘛全部失敗，要嘛全部成功
2. 一致性 consistency：維持資料的一致性（錢的總數相同）
3. 隔離性 isolation：多筆交易不會互相影響（不能同時改同一個值）
4. 持久性 durability：交易成功之後，寫入的資料不會不見
