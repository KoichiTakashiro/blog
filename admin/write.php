<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログイン判定
    if(!isset($_SESSION["id"])){
        header('Location: ../login.php');
        exit();
    }

    //選択可能なカテゴリの抽出
    $sql_c = 'SELECT * FROM categories';
    $sql_s = 'SELECT * FROM statuses';
    $recordSet_c = mysqli_query($db, $sql_c);
    $recordSet_s = mysqli_query($db, $sql_s);

    //投稿データをDBに登録する
    // var_dump($_POST);
    // var_dump($_SESSION);
    if (isset($_POST["title"])) {
        var_dump($_POST);
        var_dump($_SESSION);
        $sql = sprintf('INSERT INTO posts SET title="%s", content="%s", category_id=%d, status_id=%d, member_id=%d, created=NOW()',
                      mysqli_real_escape_string($db, $_POST["title"]),
                      mysqli_real_escape_string($db, $_POST["content"]),
                      mysqli_real_escape_string($db, $_POST["category_id"]),
                      mysqli_real_escape_string($db, $_POST["status_id"]),
                      mysqli_real_escape_string($db, $_SESSION["id"])
        );
        mysqli_query($db, $sql);
        $_SESSION["post_id"];
        header('Location: complete.php');
        exit();
    }
    
?>
<!DOCTYPE html>
  <!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
  <?php
    require('../header.php');
  ?>
    <!-- 管理画面左側のサイドバー -->
    <div class="container">
      <div class="row">
        <div class="col-xs-2">
          <div class="row">
            <ul>
              <li class="admin-list ">Top</li>
              <li class="admin-list active">ブログを書く</li>
              <li class="admin-list">記事の編集、削除</li>
              <li class="admin-list">アクセス数</li>
            </ul>
          </div>
        </div>
        <!-- ここまでサイドバー -->
        <!-- ここから管理画面メイン部分（入力フォーム） -->
        <div class="col-xs-10">
          <form action="" method="post">
            <p>ブログを書く</p>
            <div>
              <p>タイトル：</p>
              <input type="text" name="title">
            </div>
            <div>
              <p>カテゴリ：</p>
              <select name="category_id" id="">
                <?php 
                    while($data_c = mysqli_fetch_assoc($recordSet_c)){
                    echo sprintf('<option value="%s">%s</option>',
                            $data_c["id"],
                            $data_c["name"]
                            );
                    }
                ?>
              </select>
            </div>
            <!-- 文章作成欄 -->
            <div>
              <p>本文</p>
              <input type="text" name="content" col="60" row="22">
            </div>
            <div>
              <p>公開状況</p>
              <select name="status_id">
                <?php 
                    while($data_s = mysqli_fetch_assoc($recordSet_s)){
                    echo sprintf('<option value="%s">%s</option>',
                            $data_s["id"],
                            $data_s["name"]
                            );
                    }
                ?>
            </div>
            <div>
              <input type="submit" value="送信する">
            </div>
         </form>
        </div>
      </div>
    </div>
  </body>
</html>
