<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログイン判定
    if(!isset($_SESSION["id"])){
        header('Location: ../login.php');
        exit();
    }
    //最新の投稿データの抽出
    $sql = sprintf('SELECT * FROM posts WHERE member_id=%d ORDER BY created DESC',
                  $_SESSION["id"]
                  );
    $posts = mysqli_query($db, $sql);
    $post = mysqli_fetch_assoc($posts);

?>
<!DOCTYPE html>
<!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
  <?php
    require('head.php');
    require('header.php');
  ?>
    <div class="container">
      <div class="row">
        <?php
            require('side_bar.php');
        ?>
        <!-- ここまでサイドバー -->

        <!-- ここから管理画面メイン部分（入力フォーム） -->
        <div class="col-xs-8">
          <div>
            <h1>投稿が完了しました</h1>
          </div>
          <div>
            <a href="../view.php?id=<?php echo $post["id"]; ?>" target="_blank">投稿内容を確認する</a>
          </div>
          <div>
            <a href="index.php">管理画面に戻る</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
