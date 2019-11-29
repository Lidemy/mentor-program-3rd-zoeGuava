### hw2：Event Loop + Scope

請說明以下程式碼會輸出什麼，以及盡可能詳細地解釋原因。

```javascript
for(var i=0; i<5; i++) {
  console.log('i: ' + i)
  setTimeout(() => {
    console.log(i)
  }, i * 1000)
}
```

---

```
i: 0
i: 1
i: 2
i: 3
i: 4
5
5
5
5
```

1. global Execution Context => 編譯
	偵測到 for 迴圈，不動作

2. global Execution Context => 執行
	進入迴圈

3. for Execution Context =>編譯
	for EC: {
		VO: {
			i: undefined
			setTimeout: 0x11
		}
		scopeChain: [for EC.VO, global EC.VO]
		this: ...
	}

4. for Execution Context =>執行
	console.log('i: ' + 0)
	// i: 0
	將 setTimeout 移至 WebAPI，倒數 0 * 1s
	時間到，將 setTimeout 內的 console.log(i) 移至 Queue

	console.log('i: ' + 1)
	// i: 1
	將 setTimeout 移至 WebAPI，倒數 1 * 1s
	時間到，將 setTimeout 內的 console.log(i) 移至 Queue

	console.log('i: ' + 2)
	// i: 2
	將 setTimeout 移至 WebAPI，倒數 2 * 1s
	時間到，將 setTimeout 內的 console.log(i) 移至 Queue

	console.log('i: ' + 3)
	// i: 3
	將 setTimeout 移至 WebAPI，倒數 3 * 1s
	時間到，將 setTimeout 內的 console.log(i) 移至 Queue

	console.log('i: ' + 4)
	// i: 4
	將 setTimeout 移至 WebAPI，倒數 4 * 1s
	時間到，將 setTimeout 內的 console.log(i) 移至 Queue

	i = 4，
	回去迴圈再跑一次 i++ 變成 5，
	5 不符合 i < 5 這個條件，
	不會往下執行裡面的 console.log(i)，
	現在的 i = 5

5. for Execution Context 執行完畢，清空 Stack
6. Event Loop 偵測到 Stack 清空，將 Queue 裡的 function 依序移至 Stack 執行
7. console.log(i) 移至 Stack 執行
8. i = 5 帶入 console.log(i)，輸出 5
9. 清空 Stack，event loop 再將 console.log(i) 帶上來 Stack 執行，重複五次
10. Stack 清空，結束