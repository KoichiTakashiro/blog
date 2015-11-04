<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログインして3時間以内ならTrue
    if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()){
        //ログインしている場合
        $sql = sprintf('SELECT * FROM members WHERE id=%d',
                      mysqli_real_escape_string($db, $_SESSION["id"])
                      );
        $members = mysqli_query($db, $sql) or die(mysqli_error($db));
        $member = mysqli_fetch_assoc($members);
        
    }else{
        //ログインしていない場合
        header('Location: ../login.php');
        exit();
    }
    //会員情報の取得
    
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Blog for Golfers</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="../assets/main.css">
</head>
  <header>
    <li>
      <ul class="logo"><img src="#" alt="logo"></ul>
      <a href="../index.php">サイトTopへ</a>
      <ul><a href="../logout.php">ログアウト</a></ul>
    </li>
  </header>
  <!-- 管理画面左側のサイドバー -->
  <div class="container">
    <div class="row">
      <div class="col-xs-2">
        <div class="row">
          <ul>
            <li class="admin-list active">Top</li>
            <li class="admin-list ">ブログを書く</li>
            <li class="admin-list">記事の編集、削除</li>
            <li class="admin-list">アクセス数</li>
          </ul>
        </div>
      </div>
      <!-- ここまでサイドバー -->
      <!-- ここから管理画面メイン部分（入力フォーム） -->
      <div class="col-xs-10">
        <div>
          <h3>管理トップ</h3>
        </div>
        <div>
          <?php
              //プルフィール写真の表示
              if ($member["picture"] != "") {
              echo sprintf('<img src="../member_picture/%s" width="100" height="100">',
                           $member["picture"]
              );
              }else{
                  echo '<img src="../assets/image/default.jpg">';
              }
              //○○のブログ、と表示
              echo sprintf('%sのブログ',
                          mysqli_real_escape_string($db, $member["name"])
                          );
             
          ?>
          <input type="button" onclick="location.href='write.php'" value="ブログを書く">
                      


        </div>
          
      </div>
    </div>
  </div>




<body>
</html>
