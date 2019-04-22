## 教你朋友 CLI

### Command Line 是什麼？
---
####1. 操控電腦的方式有兩種：
- 圖性化介面（**G**raphical **U**ser **I**nterface）
> 就是我們現在最常見的，使用游標就能操控電腦的方式。

- 命令行介面（**C**ommand **L**ine **I**nterface）
> 這是另一種用文字來操控電腦的方式。

####2. 該如何安裝？
其實一般的電腦裡已經有了，就是那個叫做終端機的東西。
要打開它很簡單，按下螢幕右上角的放大鏡，輸入 terminal 之後就會找到 mac 內建的終端機了。
如果嫌那個介面不好看的話可以再去找替代的安裝，mac 的話可以去找一個叫 [iTerm2](https://www.iterm2.com/) 的軟體來安裝，裝好之後想修改顏色外觀的話可以到這個路徑：`Preferences > Profiles > Colors > Color Presets...`去設定喜歡的顏色。詳細可以參考：[超簡單！十分鐘打造漂亮又好用的 zsh command line 環境](https://medium.com/statementdog-engineering/prettify-your-zsh-command-line-prompt-3ca2acc967f)、[為 MAC 的 Terminal 上色 - 透過 iTerm 2 和 Oh My Zsh 高亮你的終端機](https://pjchender.blogspot.com/2017/02/mac-terminal-iterm-2-oh-my-zsh.html)。



###如何創建一個 wifi 資料夾，並在裡面新增一個 afu.js 檔案
---
輸入 `pwd` 確認自己的位置，
> Print Working Directory

輸入 `ls` 確認這位置上的檔案，
> LiSt

輸入 `mkdir wifi` 建立一個叫做 wifi 的資料夾，
> MaKe DIrectory

輸入 `touch auf.js` 新增檔案。



###一些常用的指令一覽
---


| 指令 | 用途 |
| :--: | ---- |
| `pwd` | Print Working Directory - 知道現在的所在位置 |
| `ls` | LiSt - 列出現在這資料夾底下的檔案清單 |
| `cd` | Change Directory - 切換到其他資料夾 |
| `cd ..` |  `..` 表示回到上一層|
| `clear` | 清除 command line 的畫面 |
| `touch` | 可以更改檔案的最後修改時間，若該檔案原本並不存在，則會建立新的檔案 |
| `mkdir` | MaKe DIRectory - 建立資料夾 |
| `man` | MANual - 查詢指令的使用方式 |
|  | 輸入方式：man + 空格 + 想知道的指令（ls, rm, cd....） |
| `rm` | ReMove - 刪除檔案 |
|     | 刪除資料夾 01：`rmdir` (dir directory-資料夾) |
|     | 刪除資料夾 02：`rm -r` or `-R` 會把該資料夾下面的所有東西刪除 |
| `mv` | MoVe - 移動檔案 |
|     | mv moveField targetField - 移動檔案到指定增料夾裡面 |
|     | mv moveField .. - 將檔案移動到上層 |
|     | mv moveField ReNewName - 將該檔案重新命名（把原檔案移動到新名稱之下） |
| `cp` | CoPy - 複製檔案 cp targetField copyField(複製後的檔名) |
|     | cp `-r` targetFold newFoldName - 複製資料夾 |
| `cat` | 連接檔案、查看檔案內容 cat wantLookField   |
| `less`   |若檔案內容過多可改成這個，會新開一個分頁，離開只要按Ｑ就好    |
| `grep`  | 抓取關鍵字，寫法： grep keyword targetField (grep k targetField)|
| `wget` | 下載檔案，這並非內建的指令，寫法 wget: url |
|   | 若後面接的是網頁網址，會下載該網頁的 html  |
| `curl`  | 送出 request，寫法：curl API網址   |
|   | 擷取 header 的資訊：curl -I 欲擷取的url  |
| `redirection`  | 重新導向 input & output  |
| `>`  | 想將 cmd 上的結果輸出至某個檔案，寫法：`ls -al > listResult`   |
| `>>`  | 不想覆蓋目標檔案的內容，而是新增上去：`ls -al >> listResult`  |
| `echo`  | 輸出至 cmd 之中：echo "ooxx"  |
| pipe `|` |指令組合 - 把左邊的輸入變成右邊的輸出 |
|   | `cat targetFile | grep keyword`  |
|   | 把 targetFile 的內容列出來後，用 grep 去查找字元 |
|   | `cat targetFile | grep keyword > list_result.txt`  |
| vim | 文字編輯器 |
|     | 要看檔案時，輸入 vim targetField |
|     | 按下 i 會進入 insert 模式，按下 esc 會回到普通模式 |
|     | 要離開時，在普通模式下輸入 :q 就可以離開 |
|     | 要存擋時，在普通模式下輸入 :wq 即可 |