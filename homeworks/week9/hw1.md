資料庫名稱：users

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id     |
|  username  |    varchar(16)      | 帳號     |
|  nickname  |    varchar(64)      | 暱稱     |
|  password  |    varchar(16)      | 密碼     |


資料庫名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id     |
|  username  |    varchar(16)      | 帳號     |
|  nickname  |    varchar(64)      | 暱稱     |
|  comments  |    text      | 留言內容     |
|  created_at  |    datetime      | 留言時間 預設：CURRENT_TIMESTAMP    |
