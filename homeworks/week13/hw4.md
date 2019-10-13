## Bootstrap 是什麼？
Bootstrap 是一個 library，它提供了規劃好的 css class 命名、RWD、還有把一些常用的 JavaScript function 用 jQuery 包裝起來，透過 Bootstrap 可以很方便地建立一個 RWD 的網頁。


## 請簡介網格系統以及與 RWD 的關係
網格系統是指把一個網頁的頁面分成十二或是十六等份（寬），以十二等分為例子的話，col-12 的意思就是**這一個欄位佔 12 等份寬**，也就是寬度 100%；而 col-4 的話則是佔 4 等份（三分之一）寬。透過這個方式可以應用在 RWD 上面，在寬度 1024px 以上的螢幕寬度這個並排三個的欄位，每個欄位皆為 col-4；而到了 725px 以下或是手機螢幕的寬度時，便各佔一排螢幕的寬度 col-12。


## 請找出任何一個與 Bootstrap 類似的 library
Pure css，滿喜歡這個的 XD，乾乾淨淨的，不過沒有 jQuery 就是了...
materializecss，搜尋找到的，感覺把 class 的設定切得更細了，自由度比 Bootstrap 要高，常常用 Bootstrap 很麻煩的地方就是有一大堆的 **!important**...


## jQuery 是什麼？
這是一個 JavaScript 的 library，他把常用的 function 簡化成較為直觀的使用方式，而要使用 jQuery 之前要記得宣告 `$(document).ready(function(){})`，以及使用 jQuery 提供的 function 時前面要加上 `$` 進行呼叫。


## jQuery 與 vanilla JS 的關係是什麼？
vanilla JS 是一個有點諷刺意味的 JavaScript library，諷刺大家都在學框架，連很簡單的功能都要找框架來套才會用，而忽略了最基本的原生 JacaSript。
vanilla JS 其實就是原生 JavaScript。
jQuery 就是把 vanilla JS 包裝起來後，使 JavaScript 更容易使用的 library。
