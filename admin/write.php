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
    $recordSet_c = mysqli_query($db, $sql_c) or die(mysqli_error($db));
    $recordSet_s = mysqli_query($db, $sql_s) or die(mysqli_error($db));

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
        mysqli_query($db, $sql) or die(mysqli_error($db));
        $_SESSION["post_id"];
        header('Location: complete.php');
        exit();
    }
    
?>
<!DOCTYPE html>
  <?php
    require('head.php');
    require('header.php');
  ?>
    <!-- 管理画面左側のサイドバー -->
    <div class="container">
      <div class="row">
        <?php
            require('side_bar.php');
        ?>
        <!-- ここまでサイドバー -->

        <!-- ここから管理画面メイン部分（入力フォーム） -->
        <div class="col-xs-8">

          <form action="" method="post">
            <div>
              <h2>ブログを書く</h2>
            </div>

            <hr>

            <div>
              <p>タイトル：</p>
              <input type="text" name="title">
            </div>

            <hr>

            <div>
              <p>カテゴリ選択：</p>
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

            <hr>

            <!-- 文章作成欄 -->
            <p>本文</p>
            <p>
              <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="20"></textarea>
            </p>

            <hr>

            <div>
              <input type="submit" value="公開する">
            </div>
          </form>
        </div><!-- <div class="col-xs-8"> -->
      </div><!-- row -->
    </div><!-- container -->
  </body>
</html>
