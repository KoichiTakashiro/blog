<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    if (!empty($_POST)) {

        //エラー判定
        if (isset($_POST["password"])) {
            if (strlen($_POST["password"]) < 4) {
                $error["password"] = "length";
            }
            if ($_POST["password"] != $_POST["confirm_password"]) {
                $error["password"] = "different";
            }
            $fileName = $_FILES["picture"]["name"];
            if (isset($fileName)) {
                if ($fileName != "") {
                   $ext = substr($fileName, -3);
                    if ($ext != "jpg" && $ext != "png" && $ext != "gif") {
                        $error["picture"] = "picture_type";
                    }
                }
               
            }
            if ($_POST["email"] != "") {
              $sql = sprintf('SELECT count(*) AS cnt FROM members WHERE email="%s"',
                            mysqli_real_escape_string($db, $_POST["email"])
                            );
              $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
              $post = mysqli_fetch_assoc($posts);
              if ($post["cnt"] > 0) {
                  $error["email"] = "dupricate";
              }
            }
            
        }
        
        //エラーがなくなれば次の処理へ進む
        if (empty($error)) {
            $ext = substr($fileName, -3);
            if ($ext == "jpg" || $ext == "png" || $ext == "gif") {
                date_default_timezone_set('Asia/Tokyo');
                $picture_name = date('YmdHis') . $_FILES["picture"]["name"];
                move_uploaded_file($_FILES["picture"]["tmp_name"], '../member_picture/' . $picture_name);
            }else{
                $picture_name = 'default.png';
            }
            $_SESSION["join"] = $_POST;
            $_SESSION["join"]["picture"] = $picture_name;
            header('Location: check.php');
            exit();
        }
    }
    if (isset($_REQUEST["action"])) {
        if ($_REQUEST["action"] == "rewrite") {
            $_POST = $_SESSION["join"];
            $error["rewrite"] = true;
        }
    }
?>

<!DOCTYPE html>
<?php
  require('../admin/head.php');
  require('../admin/header.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-6">
        <h1>無料会員登録</h1>
      </div>
    </div>

    <div class="row">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6 col-md-offset-3">
          <!-- ニックネームの登録 -->
          <div>
            <?php if (isset($error)): ?> 
                <label for="">ニックネーム</label>
                <input type="text" name="name" required value="<?php echo $_POST['name'];?>">
            <?php else: ?>
                <label for="">ニックネーム</label>
                <input type="text" name="name" required placeholder="takapi">
            <?php endif; ?>
          </div>
          <!-- メールアドレスの登録 -->
          <div>
            <?php if (isset($error["email"])): ?>
                <p class="error">このメールアドレスはすでに会員登録済みです</p>
                <label for="">メールアドレス</label>
                <input type="email" name="email" required value="<?php echo $_POST["email"]; ?>">
            <?php elseif (isset($error)): ?>
                <label for="">メールアドレス</label>
                <input type="email" name="email" required value="<?php echo $_POST["email"]; ?>">
            <?php else :?>
                <label for="">メールアドレス</label>
                <input type="email" name="email" required placeholder="takapi@hoge.com">
            <?php endif; ?>
          </div>
          <!-- パスワードの登録 -->
          <div>
            <!-- 文字数制限とパスワード一致の確認 -->
            <?php if (isset($error["password"])): ?>
                <?php if ($error["password"] == "length") :?>
                  <label for="">パスワード</label>
                  <input type="password" name="password" required placeholder="4文字以上の半角英数">
                  <p class="error">パスワードは4文字以上で入力してください</p>
                <?php elseif($error["password"] == "different"): ?>
                  <label for="">パスワード</label>
                  <input type="password" name="password" required placeholder="4文字以上の半角英数">
                  <p class="error">確認用パスワードが一致しません。再度入力してください</p>
                <?php else: ?>
                  <label for="">パスワード</label>
                  <input type="password" name="password" required placeholder="4文字以上の半角英数">
                <?php endif; ?>
            <?php else: ?>
                <label for="">パスワード</label>
                <input type="password" name="password" required placeholder="4文字以上の半角英数">
            <?php endif; ?>
          </div>
          <div>
            <label for="">パスワード（確認）</label>
            <input type="password" name="confirm_password" required placeholder="4文字以上の半角英数">
          </div>
          <div>
            <?php if (isset($error["picture"])):?>
                <?php if ($error["picture"] == "picture_type"): ?>
                    <label for="">プロフィール画像</label>
                    <input type="file" name="picture">
                    <p class="error">画像はjpg, png, gifのいずれかを選択してください</p>
                <?php endif; ?>
            <?php elseif (isset($error)): ?>
                <label for="">プロフィール画像</label>
                <input type="file" name="picture">
                <p class="error">お手数ですが再度画像の登録をお願いします</p>
            <?php else: ?>
                <label for="">プロフィール画像</label><br>
                <label for="">※登録のない場合はデフォルト画像が適用されます。</label>
                <input type="file" name="picture">
            <?php endif; ?>
          </div>
          <div>
            <input type="submit" value="確認へ進む">
          </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <a href="../index.php">Top画面へ戻る</a>
      </div>
    </div>
  </div>
</body>
</html>
