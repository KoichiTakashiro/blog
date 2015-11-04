<?php
    session_start();
    require('dbconnect.php');
    require('my_function.php');
    //クッキーが残っていれば$_POSTに代入する
    if (isset($_COOKIE['email'])) {
        if ($_COOKIE['email'] != '') {
            $_POST['email'] = $_COOKIE['email'];
            $_POST['password'] = $_COOKIE['password'];
            $_POST['save'] = 'on';
        }
    }
    if (!empty($_POST)) {
        // ログインの処理
        if ($_POST['email'] != '' && $_POST['password'] != '') {
            
            $sql = sprintf('SELECT * FROM members WHERE email="%s" AND password="%s"',
                mysqli_real_escape_string($db, $_POST['email']),
                mysqli_real_escape_string($db, sha1($_POST['password']))
            );
            
            $record = mysqli_query($db, $sql) or die(mysqli_error($db));
            if ($table = mysqli_fetch_assoc($record)) {
                // ログイン成功
                
                // ユーザーのidをセッションに保存
                $_SESSION['id'] = $table['id'];
                // ログインした時間をセッションに保存
                $_SESSION['time'] = time();
                // ログイン情報を記録する
                if ($_POST['save'] == 'on') {
                    //14日間クッキーを保存する
                    setcookie('email', $_POST['email'], time()+60*60*24*14);
                    setcookie('password', $_POST['password'], time()+60*60*24*14);
                }
                header('Location: admin/index.php');
                exit(); 
            } else {
                $error['login'] = 'failed';
            }
        } 
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
  <h1>ログイン</h1>
  <p>&raquo;<a href="join/regist.php">入会手続きがまだの方はこちら</a></p>
  <form action="" method="post">
    <div>
      <label for="">メールアドレス：</label>
      
      <?php if (isset($_POST['email'])): ?>
          <input type="email" name="email"  required value="<?php echo htmlspecialchars($_POST['email']); ?>">
      <?php else: ?>
          <input type="email" required name="email">
      <?php endif; ?>
      

      <?php if (isset($error)): ?>
          <?php if ($error['login'] == 'failed'): ?>
              <p class="error">ログインに失敗しました。正しく情報をご記入ください。</p>
          <?php endif; ?>
      <?php endif; ?>
    </div>

    <div>
      <label for="">パスワード：</label>
      <input type="password" required name="password">
    </div>

    <p>ログイン情報の記録</p>
    <div>
      <input type="checkbox" id="save" name="save" value="on">
      <label for="">次回から自動でログインする</label>
    </div>

    <div>
      <input type="submit" value="ログインする">
    </div>
  </form>
  <div>
    <a href="index.php">Top画面に戻る</a>
  </div>
</body>
</html>
