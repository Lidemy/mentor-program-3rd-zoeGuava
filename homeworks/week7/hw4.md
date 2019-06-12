## 什麼是 DOM？

Document Object Model，文件物件模型。我們所寫出來的 HTML 格式就是一個 DOM，是一種樹狀的結構，當中每一個元素、標籤都是一個節點（node），透過 JavaScript 來操控這些結構（改變顏色、判斷有無填寫資料、加入點擊效果⋯⋯）能讓使用者與網頁產生互動。

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

會由外往內（捕獲）到達觸發的元素之後，再由內往外（冒泡）傳上去。
以下面的程式碼為例的話：

   ```
   <div class="wrapper">
   	<div class="container">
   		<div class="box"></div>
   	</div>
   </div>
   
   <script>
     document.querySelector('.wrapper').addEventListener('click', function(e) {
       console.log('.wrapper')
     },false)
     document.querySelector('.container').addEventListener('click', function(e) {
       console.log('.container')
     },false)
     document.querySelector('.box').addEventListener('click', function(e) {
       console.log('.box')
     },false)
   </script>
   ```

js 的事件傳遞機制有兩種，**捕獲**與**冒泡**。
`addEventListener('click', function, false)` 在預設的情況下會是 false，點擊最內層的 .box，在 console 的地方會依序顯示：`.box`, `.container`, `.wrapper`，也就是冒泡（**由內往外**）；依照字面上的意思就是從偵測到點擊的部分會往上、往外冒泡到上層元素，點擊了`.box` 外層的 `.container` 以及 `.wrapper` 也會觸發點擊的事件。
若改為 `addEventListener('click', function, true)`，的話便是捕獲（**由外往內**）階段，點擊最內層的 `.box` 會由外往內依序顯示：`.wrapper`, `.container`, `.box`。

## 什麼是 event delegation，為什麼我們需要它？

又稱做事件代理，與之相對應的是 event binding，event binding 是最為直覺的操作 DOM 方式，舉個例子來說，現在有一個 `ul>li*3` 你要在裡面的每一個 li都加上一個 click 的 eventListener，可以把三個 li 都設一個 class 名稱，再用 querySelectorAll 去綁定 click 的事件，但是當要處理的數量變很大的時候，十個、五十個、甚至一百個的時候，在每一個 li 上面加上 eventListener 是一件非常沒有效益也很耗資源的行為。
還記得上面提到的捕獲與冒泡嗎？
事件代理是利用 JavaScript 的事件傳遞特性，可以達到在上層的元素加上 eventListener 來與下層元素進行連接。剛剛的例子就可以把 eventListener 加在上層的 li 上面，並且加入判斷：只有點擊到 li 的部分才會觸發該事件，便可以達到在每一個 li 上面都有加入 eventListener 的目的。因為冒泡的特性，雖然點擊的是 ul 的部分，但其實也會點擊到外層的 li 進而觸發設置在外層的 eventListener。


## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

event.preventDefault 是用來阻止預設行為的，像是阻止點擊 <a src="#"></a> 之後的頁面跳轉。
event.stopPropagation 則是阻止冒泡行為，以上面那題的事件代理為例子的話，加上 event.Propagation 之後就不能利用冒泡的特性來觸發加在上層元素的 eventListener。
