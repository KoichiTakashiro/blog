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
        <ul><a href="../logout.php">ログアウト</a></ul>
      </li>
    </header>
    <div>
      <h1>投稿が完了しました</h1>
    </div>
    <div>
      <a href="view.php?id=<?php echo $post["id"]; ?>">投稿した内容を確認する</a>
    </div>
    <div>
      <a href="index.php">管理画面に戻る</a>
    </div>

  </body>
</html>
