### hw4：What is this?

請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

```javascript
const obj = {
  value: 1,
  hello: function() {
    console.log(this.value)
  },
  inner: {
    value: 2,
    hello: function() {
      console.log(this.value)
    }
  }
}

const obj2 = obj.inner
const hello = obj.inner.hello
obj.inner.hello() // ??
obj2.hello() // ??
hello() // ??
```

```javascript
obj.inner.hello() // 2
obj2.hello() // 2
hello() // undefined
```

obj.inner.hello() => 2
  console.log(this.value) 中 this 指的是 obj.inner 裡的東西，
  可以在這裡找到 value 變數，且數值為 2，所以返回的結果是 2

obj2.hello() => 2
  obj2 就是 obj.inner，
  所以 this.value 的 this 指的依然是 obj.inner 內 value 的值：2

hello() => undefined
  hello 的位置是 obj.inner.hello 這個 function，
  裡面只有 console.log(this.value) 這一條程式碼，
  並沒有設定 value 的數值，這裡的 this 所指的是 window，
  而在 window 裡並沒有設定變數 value，所以得到的會是 undefined
