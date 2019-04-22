## 跟你朋友介紹 Git

就是啊，我最近有一個煩惱。因為我的笑話太多了，所以我目前都用文字檔記錄在電腦裡，可是變得越來越多之後很難紀錄，而且我的笑話是會演進的。會有版本一、版本二甚至到版本十，這樣我就要建立好多個不同的檔案，弄得我頭很痛，聽說你們工程師都會用一種程式叫做 Git 來做版本控制，可以教我一下嗎？
因此，你必須教他 Git 的基本概念以及基礎的使用，例如說 add 跟 commit，若是還有時間的話可以連 push 或是 pull 都講，菜哥能不能順利成為電視笑話冠軍，就靠你了！




### Git 是什麼？
---
Git 是一種用來版本控制的工具，他就像時光機一樣能夠讓你回到檔案以前的狀態，其實有點像國中高中生物課所教的生物演化史。從一開始的單細胞生物（藍綠藻）變成多細胞生物（蟲），之後長出了脊椎變成能在海中游動魚類，慢慢的往陸地前進，長出了腳（蜥蜴、恐龍），隨後從用爬的變成站起來用跑的靈長類。每一個階段都殘留著前一個階段的痕跡，Git 能夠讓你把不同階段的樣子擺在一起觀察他們的不同之處，並選擇要回到哪個階段、擷取各個階段中喜歡的地方把他們合在一起變成一個最終的完全版。



### 怎麼開始？
---
1. 先到 [GitHub](https://github.com/)申請一個帳號，你可以把這個網站當成是一個雲端的備份，就像 google drive 或是 mega 那樣，只是它備份的是你檔案的各個版本、歷史。

2. 打開你的終端機，並在裡面輸入 `git --version`按下 enter 便可，或是參考[官方網站說明](https://git-scm.com/book/zh-tw/v2/%E9%96%8B%E5%A7%8B-Git-%E5%AE%89%E8%A3%9D%E6%95%99%E5%AD%B8)安裝。

3. 完成後先打開終端機設定你的使用者帳號以及信箱（就是剛剛申請的 GitHub 帳號 ）。

4. 再來是把 GitHub 的帳號在終端機進行設定，打開終端機後輸入： 
`git config --global user.name "Your Name"`
`git config --global user.email "youremail@mail.com"`
最後輸入 `git config --list` 確認你剛剛輸入的資料沒有錯誤。

5. 設定完成後，在終端機的介面裡，進到你要放笑話的資料夾，輸入 `pwd` 確認你現在的位置。

6. 首先要做的是輸入 `git init`，建立一個 `.git` 的檔案，來告訴電腦你要在這個資料夾進行 git 的版本控制。可以輸入 `ls -al` 來確認有沒有建立成功。都設定完成的話就可以來開始啦！

   

### 該如何使用？
---
當你在資料夾新增、修改一個檔案後可以透過 `git status` 查看現在的資料夾情況，他會顯示：`modified: edited_file`。這時候你要做的事情有兩件，第一件：把他加入暫存區裡面（`git add edited_file_name`）；第二件：把這一次的改動加入 git 裡面存起來（`git commit -m "輸入這次更動了哪些，或是對此次更動的註解"`）。上述兩件事情都完成之後可以輸入 `git log` 來確認剛剛 commit 上去的部分是不是有被加入 git 裡面了。
恭喜你！到這邊完成了第一次 Git 的應用。



### 上傳到 GitHub
---
還記得你有辦了一個 GitHub 的帳號嗎？現在要把你剛剛在電腦上做的事情同步到 GitHub 上面去備份了。
1. 開啟你的 GitHub 頁面，右上角你的個人頭貼左邊會有一個 `+` 的符號，按下去點選 `New repository` 便會進入開啟新專案的頁面。
2. 專案的名字建議跟你在電腦裡使用 Git 的資料夾同名稱，下面選擇 Public 或是 Private（需付費），`README.md` 的部分可以先不勾選，之後再補上也行。
3. 點選 `Create repository` 新增新的 repository，之後跳轉到一個頁面，在右上的 `HTTPS` 跟 `SSH` 部分選擇喜歡的（可以先選 `HTTPS`），下面有兩個部分，第一個是教你怎麼在電腦創建一個有 Git 功能的資料夾，這部分我們剛剛已經做過了，所以可以看下面的 push an existing repository from the command line。這邊有兩個指令：
```
git remote add origin git@github.com.......
git push -u origin master
```
4. 在你的終端機裡面輸入之後便會開始上傳的動作。如果是第一次進行的話會要求你輸入帳號跟密碼進行確認。待進度跑完 100 % 之後在 GitHub 的頁面上進行重整就會出現剛剛新增的 repository 內容了。

   

### 從 GitHub 下載下來與電腦同步
---
有時候在外面手癢想更新笑話，但卻沒帶電腦的時候可以用手機登入 GitHub 更新。可是要記得回家之後把 GitHub 上更新過的笑話下載下來跟電腦同步。
打開終端機後輸入 `git pull origin master` 就會把在 GitHub 上的更動給同步到電腦裡面了。




| 指令            | 內容                                          | 區域 |
| --------------- | ------------------------------------------- | ---- |
| `git init`      | initial 也就是初始化，會建立一個 git 的資料夾   | 終端機 |
| `git status`  | 確認現在 git 的狀態（有沒有更動檔案）  | 終端機  |
| `git add`       | 把你更改的檔案加入到暫存裡                     | 暫存 |
| `git commit -m` | 將剛剛加入暫存的變化交給 git                   | 終端機 |
| `git log` | 查看是否有 commit 成功 |終端機|
| `git push origin master` | 將電腦裡的 Git 上傳到 GitHub 上 |GitHub|
| `git pull origin master` | 將 GitHub 上的更動同步到電腦 |GitHub|



參考文章
https://gitbook.tw/chapters/config/user-config.html
https://gitbook.tw/chapters/github/push-to-github.html
