## hw1：好多星星
---

比較需要注意的地方是在 for 迴圈 i 的起始值，如果是從零開始的話，num 給 1 就不會有 * 產生。


## hw2：大小寫互換
---

本來還想要用字母的編碼去判斷，但想想實在太麻煩了，就直接用內建的大小寫去判斷現在是大寫還是小寫，並轉為另一種形式。


## hw3：判斷質數
---

這題寫的滿開心的 XD，原本寫了三個 if 的判斷：
 - 能被 i 整除 代表 i 是他的因數
 - 因數有 1 和 n 以外數字的話代表他不是質數：回傳 false
 - 因數只有 1 和 n 的話代表他是質數：回傳 true
後來再幫她瘦身，把**能被整除**、**不是 1**、**不是 n**這三個條件加上去，以及是 1 的話回傳 false，才通過 OJ 的測試。


## hw4：判斷迴文
---

把字拆開變成陣列之後用迴圈來從新排序，與原本的進行比對，如果一樣的話代表他是迴文。
另外也用 `+=` 來讓整體看起來更精簡了，在第二週的時候其實很多都可以這樣簡化，在這週成功把它用上去了！


## hw5：大數加法
---

這題真的...好麻煩。
但是看到 OJ 上面有好多人都拿到五百分，我決定
拿四百分就好 = v =
說是這樣說...也是卡了一個下午，越卡越不知道該如何下手，想像中的話是要照著下面的順序跑的

1. 把數字分成兩段
2. 較大的那一段用進位把他右移變成比較小的數字之後再相加
3. 之後再變回去原本的位數，跟另一段相加

但越想越奇怪，分成前後兩段倒還行，但是把兩段加起來的東西要變回去原本的位數再相加...
那不就是跟題目一開始一樣還是超長整數的相加嗎！？ = _ ="
決定先放生她，把第四週進度跟完之後第五週的複習週再來料理他。