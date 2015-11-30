<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

?>
<!DOCTYPE html>
<<<<<<< HEAD
<?php
  require('../admin/head.php');
  require('../admin/header.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div>
          <h1>会員登録完了</h1>
          <p>おめでとうございます。<br>あなたはもう立派なブロガーです。</p>
        </div>
        <div>
          <img src="http://azukichi.net/img/word/word052.png" alt="おめでとうございます">
        </div>
        <div>
          <input type="button" onclick="location.href='../login.php'" value="さっそくブログを始める">
        </div>
      </div>
    </div>
  </div>
    
  </body>
=======
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
    <!-- <button class="btn" href="../login.php">さっそくブログを始める</button> -->
    <input type="button" onclick="location.href='../login.php'" value="さっそくブログを始める">
  </div>
  
</body>
>>>>>>> 40d0357ca4f63d4a4608157feb8b9443be9de922
</html>
