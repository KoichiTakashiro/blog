<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');


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
      <ul><a href="../login.php">ログアウト</a></ul>
    </li>
  </header>
  <!-- 管理画面左側のサイドバー -->
  <div class="container">
    <div class="row">
      <div class="col-xs-2">
        <div class="row">
          <ul>
            <li class="admin-list active">Top</li>
            <li class="admin-list">ブログを書く</li>
            <li class="admin-list">記事の編集、削除</li>
            <li class="admin-list">アクセス数</li>
          </ul>
        </div>
      </div>
      <!-- ここまでサイドバー -->
      <!-- ここから管理画面メイン部分（入力フォーム） -->
      <div class="col-xs-10">
        <form action="" method="post"></form>
          <p>ブログを書く</p>
          <div>
            <p>タイトル：</p>
            <input type="text" name="title">
          </div>
          <div>
            <p>カテゴリ：</p>
            <select name="category_id" id=""></select>
          </div>


      </div>
    </div>
  </div>




<body>
</html>
