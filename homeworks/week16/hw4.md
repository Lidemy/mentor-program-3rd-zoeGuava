## CSS 預處理器是什麼？我們可以不用它嗎？
CSS 預處理器可以再寫 CSS 的時候用上變數，以 color 來說的話，可以設定 color: $main_bgc; 就可以，之後要改顏色時只要在 $main_bgc = OOOOOO 這邊更改顏色就可以了。
同時在預處理上的 CSS 結構也變得較為直觀，
```css
.wrapper .section {...}
.wrapper .section .main {...}
```
會變成：
```css
.wrapper .section {
	...
	.main {...}
}
```
可以比較清楚的看出 class 之間的關係。

當然可以不用他，這只是一個寫 CSS 的方法之一而已，上面提到的顏色問題其實也可以設定一個 
```css
.main_bgc {
	background-color: OOOOOO;
}
```
之後把 main_bgc 這個 class 加在你需要的地方就可以，跟用愈處理器的時候一樣，更改時只需要改一個 .main_bgc class 裡面的顏色就可以了


## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
expires：設定一個期限，當 client 端的時間超過 expires 指定的時間（過期）時，瀏覽器會重新發送一個 request 去更新快取裡面的內容。


## Stack 跟 Queue 的差別是什麼？
Stack 像是一個沒有出口的巷子，先進去的車子必須要等後來的車子都出去後才能出去。
stackArray = [a, b, c]
stack.pop() 會從最後面開始把東西丟出去，依序是 c -> b -> a

Queue 則是一條有出口的巷子，先進去的自然會先從另一端的出口出來。
queueArray = [a, b, c]
queue.pop() 則是從最前面開始把東西丟出去，依序是 a -> b-> c


## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）
權重可以想成是有四個位數：0-0-0-0
而這四個位數分別對應的是：inline - ID - class - element
而權重的優先順序為：inline style > ID > Class > Element > *
其中 element 是 tag 這一類的，div, p, section, ul, table...
計算的時候由最前面的開始比較，如果最前面的就比出大小的話就不用再繼續往下了
舉個例子：
```html
<section>
  <div>
		<p id="title" class="font main_color" style="color: purple;">Text</p>
  </div>
</section>
```

```css
section div { 
	color: black;
}
section div p { 
	color: white;
}
section .font { 
	color: green;
}
.font.main_color { 
	color: blue;
}
#title { 
	color: red;
}
```

分別列出以上幾個的權重計算以及順序
- 1-0-0-0 purple -> inline style
- 0-1-0-0 red    -> #title
- 0-0-2-0 blue   -> .font.main_color
- 0-0-1-1 green  -> section .font
- 0-0-0-3 white  -> section div p
- 0-0-0-2 black  -> section div

越能清楚描述目標的權重越大，像地址一樣，如果分類變成：區-都市-國家-洲，這樣的話應該就會比較好瞭解了。
美洲的 color: red; 不會比 紐約中央公園的 color: blue; 還來得清楚，所以就會優先採用 紐約中央公園 這個選項，color: blue;
但是有一個例外，就是 !important，只有 !important 能蓋過 !important，蓋過的意思是越後面呼叫的會比前面的還要優先，除了這個方法之外不管前面加了幾個 ID 都無法蓋過 !important，也因為 Bootstrap 裡面有不少 class 都用上 !important，導致有些時候會難以覆蓋屬性。
