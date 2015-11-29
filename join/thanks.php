<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

?>
<!DOCTYPE html>
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
</html>
