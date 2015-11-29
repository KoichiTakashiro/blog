<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログイン判定
    if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()){
        
        $sql = sprintf('SELECT * FROM posts WHERE id=%s',
                        $_REQUEST["id"]
               );
        $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
        $post = mysqli_fetch_assoc($posts);

        
    }else{
        //ログインしていない場合
        header('Location: ../login.php');
        exit();
    }

    //投稿記事のアップデート
    if (isset($_POST["content"])) {
        $sql = sprintf('UPDATE posts SET title="%s", content="%s", modified=NOW() WHERE id=%d',
                        mysqli_real_escape_string($db, $_POST["title"]),
                        mysqli_real_escape_string($db, $_POST["content"]),
                        mysqli_real_escape_string($db, $_REQUEST["id"])
                );
        mysqli_query($db, $sql) or die(mysqli_error($db));
        header('Location: index.php');
        exit();
    }
?>
<!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
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
        <div>
          <p>投稿済みブログの編集</p>
          <p><?php echo $post["created"] ;?>に投稿した記事</p>
        </div>

        <hr>

        <form action="" method="post">
          <div>
            <label for="">タイトル：</label>
            <input type="text" name="title" value="<?php echo $post["title"] ;?>">
          </div>

          <hr>

          <div>
            <labal>本文：</labal>
            <!-- <input type="text" name="content" value="<?php echo $post["content"] ;?>"> -->
            <textarea name="content" cols="30" rows="10" wrap="hard"><?php echo $post["content"] ;?></textarea>
          </div>

          <hr>

          <div>
            <input type="submit" value="更新する">
          </div>
        </form>
      </div>
    </div>
  </div>  
   

















