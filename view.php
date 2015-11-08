<?php
    session_start();
    require('dbconnect.php');
    require('my_function.php');

    //ログイン判定
    if(!isset($_SESSION["id"])){
        header('Location: ../login.php');
        exit();
    }

    //投稿データの抽出
    $sql = sprintf('SELECT m.name, p.* FROM members m, posts p 
                    WHERE m.id=p.member_id AND p.id=%d ',
                  mysqli_real_escape_string($db, $_REQUEST["id"])
                  );
    $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
    $post = mysqli_fetch_assoc($posts);
    //var_dump($post);

    //投稿データに対するカテゴリを取得
    $sql_c = sprintf('SELECT c.name FROM categories c, posts p 
                    WHERE c.id=p.category_id AND p.id=%d ',
                  mysqli_real_escape_string($db, $_REQUEST["id"])
                  );
    $posts_c = mysqli_query($db, $sql_c) or die(mysqli_error($db));
    $post_c = mysqli_fetch_assoc($posts_c);
    //var_dump($post_c);

    // コメントをDBへ登録する
    if (isset($_POST["content"])) {
        $sql_com = sprintf('INSERT INTO comments SET content="%s", member_id=%d, reply_post_id=%d, created=NOW()',
                      mysqli_real_escape_string($db, $_POST["content"]),
                      $_SESSION["id"],
                      $post["id"]
        );
        mysqli_query($db, $sql_com);
    }

    $sql_comments = sprintf('SELECT m.name, c.* FROM members m, comments c WHERE m.id=c.member_id AND reply_post_id=%d ORDER BY created DESC',
                            $_REQUEST["id"]
    );

    $comments = mysqli_query($db, $sql_comments);

    
?>
<!DOCTYPE html>
  <!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
  <?php
    require('header.php');
  ?>
    <!-- ブログ表示欄 -->
    <div class="container">
      <div class="row">
        <div>
          <h1><?php echo $post["title"]; ?></h1>
        </div>
        <div>
          <span><?php echo $post["created"] ;?></span>
        </div>
        <div>
          <label>テーマ：</label>
          <span><?php echo $post_c["name"] ;?></span>
        </div>
        <div>
          <span><?php echo $post["content"] ;?></span>
        </div>
      </div>

      <!-- コメント記入欄 -->
      <div class="row">
        <form action="" method="post">
          <textarea name="content" cols="30" rows="3" placeholder="コメントを記入してください"></textarea>
          <input type="submit" value="コメントを送る">
        </form>
      </div>


      <!-- コメント表示欄 -->
      <div class="row">
          <?php while ($comment = mysqli_fetch_assoc($comments)):?>
              <div class="comment-box">
                <?php 
                    echo "<br>";
                    echo $comment["name"];
                    echo "</br>";

                    echo "<br>";
                    echo $comment["created"];
                    echo "</br>";

                    echo "<br>";
                    echo $comment["content"];
                    echo "</br>";
                ;?>
              </div>
          <?php endwhile; ?>
      </div>
    </div>
  </body>
</html>
