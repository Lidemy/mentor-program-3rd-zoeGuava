### hw3：Hoisting

請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。


```javascript
var a = 1
function fn(){
  console.log(a)
  var a = 5
  console.log(a)
  a++
  var a
  fn2()
  console.log(a)
  function fn2(){
    console.log(a)
    a = 20
    b = 100
  }
}
fn()
console.log(a)
a = 10
console.log(a)
console.log(b)
```

undefined
5
6
20
1
10
100

1. globalEC => 編譯
globalEC: {
  VO: {
    a: undefined, // 因為還沒執行所以還不會賦值
    fn: 0x11 // 存 fn() 的記憶體位置
  }
  scopeChain: [globalEC.VO]
  this: ...
}

2. globalEC => 執行
globalEC: {
  VO: {
    a: 1, // 進行賦值
    fn: 0x11 // 執行 fn() 建立 fn() EC
  }
  scopeChain: [globalEC.VO]
  this: ...
}

  3. fn()EC => 編譯
  fn()EC: {
    VO: {
      a: undefined, // 位於 fn() 內的 a 並未被設置，在這邊先建立記憶體位置
      fn2(): 0x22 // 存 fn2() 的記憶體位置
    }
    scopeChain: [fn()EC.VO ,globalEC.VO]
  }

  4. fn()EC => 執行
  **console.log(a) // undefined，尚未賦值**
  將 a 賦值為 5
  **console.log(a) // 5**
  a++ // 將 fn()EC.VO 內的 a 值由五更新為六
  var a // 沒有進行賦值，不會把現在的六覆蓋為 undefined，a 的值還是 6
  呼叫 fn2()，建立 fn2()EC

  fn()EC: {
    VO: {
      a: 6,
      fn2(): 0x22 // 存 fn2() 的記憶體位置
    }
    scopeChain: [fn()EC.VO ,globalEC.VO]
  }

    5. fn2() => 編譯
    fn2()EC: {
      VO: { 沒有宣告新的變數 }
      scopeChain: [fn2()EC.VO ,fn()EC.VO ,globalEC.VO]
    }

    6. fn2() => 執行
    fn2() {
      **console.log(a) // 6**
      // fn2()EC.VO 內並沒有變數 a，所以會往上到 fn()EC.VO 去尋找有無變數 a
      // 成功找到 a，並將值印出來以及更改、賦值
      a = 20 // 將 a 賦值為 20
      b = 100
      // fn2() 內沒有 b，所以沿著 scopeChain 往上一層找到 fn()EC.VO
      // fn()EC.VO 內也沒有 b，再往上到 globalEC.VO 尋找，仍然沒有
      // 便在 globalEC.VO 這邊建立變數 b: 100
    }

  7. fn()EC => 執行
  // 離開 fn2()EC 回到 fn()EC，a 的值已經在 fn2()EC 中被改變為 20
  **console.log(a) // 20**

8. globalEC => 執行
**console.log(a) // 1**
// 因上述對 a 進行的更動都是在 fn()EC 內發生的，不會影響到 globalEC 的 a
  globalEC: {
    VO: {
      a: 10, // 對 a 進行賦值
      fn: 0x11,
      b: 100
    }
    scopeChain: [globalEC.VO]
    this: ...
  }
**console.log(a) // 10**
// 上一行的 a = 10，對 a 重新賦值
**console.log(b) // 100**
// 在 fn2()EC 裡面要對 b 進行賦值，
// 但 fn2()EC 跟 fn()EC 內都沒有 b，
// 所以到最外層的 globalEC 這邊來建立變數 b 並賦值
