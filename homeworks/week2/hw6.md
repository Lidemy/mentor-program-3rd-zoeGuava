``` js
function isValid(arr) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] <= 0) return 'invalid'
  }
  for(var i=2; i<arr.length; i++) {
    if (arr[i] !== arr[i-1] + arr[i-2]) return 'invalid'
  }
  return 'valid'
}

isValid([3, 5, 8, 13, 22, 35])
```

## 執行流程

1. 最後一行呼叫執行 `isValid([3, 5, 8, 13, 22, 35])`。
2. 第一行，開始執行 `isValid(arr)`。
3. 第二行，設定變數 i = 0，判斷 i 的值有沒有小於陣列 arr 的數目，i 往上加一。
4. 第三行，如果陣列的第 i+1 個數字**小於等於零**，回傳 `invalid`，程式不再往下執行。
5. 第三行，如果陣列的第 i+1 個數字**大於零**，繼續執行第五行。
6. 第五行，設定變數 i = 2，判斷 i 是否小於陣列 arr 的數目，i 往上加一。
7. 第六行，如果陣列的第 i+1 個數字**不等於**陣列的第 i 個數字與陣列第 i-1 項數字的**和**，回傳 `invalid`，程式不再往下執行。
8. 第六行，如果陣列的第 i+1 個數字**等於**陣列的第 i 個數字與陣列第 i-1 項數字的**和**，執行第八行。
9. 第八行，回傳 `valid`，該 function 至此結束。

這是費氏數列吧 XD，前兩個數字的和等於第三個數字。
