<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

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

    
?>
<!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>Blog for Golfers</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../assets/main.css">
  </head>
  <body>
    <header>
      <li>
        <ul class="logo"><img src="#" alt="logo"></ul>
        <a href="../index.php">サイトTopへ</a>
        <ul><a href="../login.php">ログアウト</a></ul>
      </li>
    </header>
    <!-- 管理画面左側のサイドバー -->
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
    </div>
  </body>
</html>
