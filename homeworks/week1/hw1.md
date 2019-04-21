## 交作業流程

### 大致上的交作業流程
> part 1
> > 新增一個 branch 寫作業
> > 更新完之後 push

> part2
>
> > 發一個 pull requset 

> part3
> > 到 homeworks-3rd 貼上剛剛 push 的連結
> > 等老師 merge 之後把 issue close 之後

> part4
> > 回到本機
> > 同步 merge 之後的 master
> > 把作業的 branch 刪掉

> 完成

------

### [part 1] 在自己的電腦上
#### 1.  新開 branch
> git **branch** hw_branch

#### 2.  切換至該 branch
> git **checkout** hw_branch
> 要確定你是在作業的 branch 上面更改檔案，而不是在 master 上面。

#### 3. 開始寫作業
> 更改檔案

#### 4. 寫完後
> git **commit -am** "add hw"
> 會透過 eslint 檢查語法正確與否，若不符合要求則需重寫以符合規範。

#### 5. 上傳至 GitHub
> git **push** orgin week0
> 到此為止都還是在 **branch hw** 上進行！

--------

### [part 2] 在 GitHub 上
> 成功 push 到 GitHub 上後

#### 1.在 mentor-proogram-3rd-studentName 的頁面
> Your recently pushed branches:
> > week0
> > 按下 **Compare & pull request**

#### 2. 進入 Open a pull request 頁面
> 確定一下的確是寫 base:**master** <==  compare:**week0**
> > Title: Week0 作業
> > comment: 一些問題（關於第幾行......）

> 按下 **Creat pull request**

------

### [part 3] 到 homeworks-3rd 第三期 - 交作業專用 repo
#### 1. 移動到 issue 頁面
> **New issue**
> > 輸入標題（須符合標題規範）
> > [Week0]
> > 貼上剛剛在 mentor-proogram-3rd-studentName repo 的網址

> 按下 **Submit new issue**
> 機器人加上標籤

#### 2. 待老師看過之後
> 老師會
> > 把 branch merge 後將 branch 刪除
> > 將**交作業用 repo** 上的 issue 關掉
>
> or 要求你修改作業
>
> > 一樣把 branch merge 後，再重新開一個 branch 來進行修正
>
> 以上都merge 結束後
------
### [part 4] 回到電腦上的 terminal
#### 1. 從作業的 branch 切回去 master
> git **checkout** master

#### 2. 更新 master
> git **pull** origin master
>
> > 把作業 merge 後的 master 同步到自己的電腦

#### 3. 把作業的 branch 刪除
> git branch **-d** week0
> 只剩下 master