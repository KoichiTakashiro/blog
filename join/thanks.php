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
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="assets/main.css">

</head>
<body>
  <div>
    <h1>会員登録完了</h1>
    <p>おめでとうございます。<br>あなたはもう立派なブロガーです。</p>
  </div>
  <div>
    <img src="../assets/image/" alt="おめでとうございます">
  </div>
  <div>
    <button class="btn" href="../login.php">さっそくブログを始める</button>
  </div>
  
</body>
</html>
