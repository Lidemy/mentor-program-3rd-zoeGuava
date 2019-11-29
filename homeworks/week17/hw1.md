### hw1：Event Loop

在 JavaScript 裡面，一個很重要的概念就是 Event Loop，是 JavaScript 底層在執行程式碼時的運作方式。請你說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

```javascript
console.log(1)
setTimeout(() => {
  console.log(2)
}, 0)
console.log(3)
setTimeout(() => {
  console.log(4)
}, 0)
console.log(5)
```

---

```
1
3
5
2
4
```


javascript 會先執行最外層的 console.log();
javascript 在執行的時候是一行一行執行的，而程式碼會在 Stack 裡面排定執行順序，上面程式碼的順序為：

1. Stack 進入全域，開始執行
2. console.log(1) -> 把 console.log 放到 Stack 中準備執行，Stack 中最上面的就是這個 console.log，所以執行 console.log(1) 返回 1
3. setTimeout() -> 把 setTimeout() 放到 Web API 的欄位裡執行，等設定的時間到了之後將要執行的 call back function 放到 Queue 內
4. setTimeout() -> 設定時間到，把 console.log(2) 放到 Queue 裡面，等到 Stack 待執行的程式碼空了之後才會依序執行 Queue 裡的程式碼
5. console.log(3) -> 把 console.log 放到 Stack 中準備執行，Stack 中最上面的就是這個 console.log，所以執行 console.log(3) 返回 3
6. setTimeout() -> 把 setTimeout() 放到 Web API 的欄位裡執行，等設定的時間到了之後將要執行的 call back function 放到 Queue 內
7. setTimeout() -> 設定時間到，把 console.log(4) 放到 Queue 裡面，等到 Stack 待執行的程式碼空了之後才會依序執行 Queue 裡的程式碼
8. console.log(5) -> 把 console.log 放到 Stack 中準備執行，Stack 中最上面的就是這個 console.log，所以執行 console.log(5) 返回 5
9. Stack 退出全域，清空 Stack
10. Event loop 偵測到 Stack 清空，將 Queue 內的程式碼依序放到 Stack 上執行
11. console.log(2) 被放到 Stack 中執行
12. 返回 2，console.log(2) 執行完畢，移除，Stack 清空
13. Event loop 偵測到 Stack 清空，將 Queue 內的程式碼依序放到 Stack 上執行
14. console.log(4) 被放到 Stack 中執行
15. 返回 4，console.log(4) 執行完畢，移除，Stack 清空
