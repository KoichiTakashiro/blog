<?php 
    require('dbconnect.php');
    require('my_function.php');

    //投稿されたブログを最新のものから抽出
    // $sql = 'SELECT m.name, p.* FROM members m, posts p ORDER BY p.created DESC';
    $sql = 'SELECT * FROM posts ORDER BY created DESC';
    $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
    // $post = mysqli_fetch_assoc($posts);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Blog for Golfers</title>
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="assets/main.css">
</head>

<body>
  <!-- ヘッダー -->
  <header>
    <li>
      <ul class="logo"><img src="#" alt="logo"></ul>
      <!-- ログイン判定 -->
      <?php if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()): ?>
          <ul><a href="logout.php">ログアウト</a></ul>
      <?php else: ?>
          <ul><a href="join/regist.php">無料会員登録</a></ul>
          <ul><a href="login.php">ログイン</a></ul>
      <?php endif; ?>
    </li>
  </header>

  <!-- コンテンツTop -->
  <div class="contents_top">
    <div class="container">
      <div class="row">
        <h1>TakaBlog</h1>
        <p>簡単に無料でブログを運営できます。面倒な初期設定はありません。</p>
        <div>
          <?php if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()): ?>
              <input type="button" value="無料会員登録" onClick="location.href='join/regist.php'">
              <input type="button" value="ログイン" onClick="location.href='login.php'">
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  </div>
<!-- 新着ブログ -->
  <div class="contents_new">
    <div class="container">
      <div class="row">
        <h1>新着ブログ</h1>
        <p>新着ブログをピックアップします</p>
      </div>
      <div class="row">

        <?php while($post = mysqli_fetch_assoc($posts)): ?> 
          <p><a href="view.php?id=<?php echo $post["id"]; ?>"><?php echo '<br>';?><?php echo $post["title"]; echo $post["created"] ;?></a>
          </p>
        <?php endwhile; ?>

      </div>
    </div>
  </div>
<!-- おすすめブログ掲載 -->
  <div class="contents_reccomend">
    <div class="container">
      <div class="row">
        <h1>おすすめブログ</h1>
        <p>運営からの一押しブログが表示されます</p>
      </div>
    </div>
  </div>

  <footer>
   <li>
     <ul>管理人自己紹介</ul>
     <ul>お問い合わせ</ul>
     <ul>利用規約</ul>
   </li>
  </footer>

  <script src="js/bootstrap.min.js"></script>
</body>
</html>
