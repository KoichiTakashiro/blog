<?php 
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //直接check.phpにアクセスがあった場合の処理
    if (!isset($_SESSION["join"])) {
      header("Location: index.php");
      exit();
    }
    if (!empty($_POST)) {
      //DBへ登録処理をする
      $sql = sprintf('INSERT INTO members SET name="%s", email="%s", password="%s", picture="%s", created=NOW()',
                    mysqli_real_escape_string($db, $_SESSION['join']['name']),
                    mysqli_real_escape_string($db,$_SESSION['join']['email']),
                    mysqli_real_escape_string($db,sha1($_SESSION['join']['password'])),
                    mysqli_real_escape_string($db,$_SESSION['join']['picture'])
                    ) ;
      mysqli_query($db, $sql) or die(mysqli_error($db));
      unset($_SESSION["join"]);

      header("Location: thanks.php");
      exit();
    }

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
  <h1>登録情報の確認</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="submit">
    <div>
      <!-- ニックネームの確認 -->
      <div>
        <label for="">ニックネーム：</label>
        <?php if (isset($_SESSION["join"]['name'])): ?>
            <?php echo h($_SESSION['join']['name']);?>
        <?php endif; ?>
      </div>
      <!-- メールアドレスの確認 -->
      <div>
        <label for="">メールアドレス：</label>
        <?php if (isset($_SESSION["join"]['email'])): ?>
            <?php echo h($_SESSION["join"]["email"]); ?>
        <?php endif; ?>
      </div>
      <!-- パスワードの確認 -->
      <div>
        <label for="">パスワード：</label>
        <?php echo "セキュリティを考慮し表示しません" ?>
      </div>
      <div>
          <label for="">プロフィール画像</label>
          <?php
              if ($_SESSION["join"]["picture"] != "") {
                echo sprintf('<img src="../member_picture/%s" width="100" height="100">',
                          $_SESSION["join"]["picture"]
                );
              }else{
                echo "画像が登録されていません。会員登録後にも追加できます。";
              }
               
          ?>
      </div>
      <div>
        <a href="regist.php?action=rewrite">&laquo;&nbsp;修正する</a> | 
        <input type="submit" value="登録する">
      </div>
  </form>
  
</body>
</html>
