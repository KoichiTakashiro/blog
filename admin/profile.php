<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログイン判定
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

    if (isset($_FILES["picture"])) {
        $fileName = $_FILES["picture"]["name"];
        if (isset($fileName)) {
            if ($fileName != "") {
               $ext = substr($fileName, -3);
                if ($ext != "jpg" && $ext != "png" && $ext != "gif") {
                    $error["picture"] = "picture_type";
                }
            }
           
        }
    }
    

    if (empty($error["picture"]) && isset($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext == "jpg" || $ext == "png" || $ext == "gif") {
            date_default_timezone_set('Asia/Tokyo');
            $picture_name = date('YmdHis') . $_FILES["picture"]["name"];
            move_uploaded_file($_FILES["picture"]["tmp_name"], '../member_picture/' . $picture_name);
        }else{
            $picture_name = 'default.png';
        }

        $sql = sprintf('UPDATE members SET picture="%s", modified=NOW() WHERE id=%d',
                      mysqli_real_escape_string($db,$picture_name),
                      mysqli_real_escape_string($db,$member["id"])
                      ) ;
        mysqli_query($db, $sql) or die(mysqli_error($db));

        header('Location: index.php');
        exit();
    }

?>
<!DOCTYPE html>
  <?php
    require('head.php');
    require('header.php');
  ?>
  <body>
    <!-- 管理画面左側のサイドバー -->
    <div class="container">
      <div class="row">
        <?php
            require('side_bar.php');
        ?>
        <!-- ここまでサイドバー -->

        <!-- ここから管理画面メイン部分（入力フォーム） -->
        <div class="col-xs-8">
          <div>
            <h3>現在のプロフィール画像</h3>
            <hr>
            <?php
                if ($member["picture"] != "") {
                    echo sprintf('<img src="../member_picture/%s" width="100" height="100">',
                             $member["picture"]
                    );
                }else{
                    echo '<img src="../assets/image/default.jpg">';
                }
            ?>
          </div>

          <hr>

          <div>
            <h3>新しい画像を選択してください</h3>
            <form action="" method="post" enctype="multipart/form-data">
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
                  <label for="">プロフィール画像</label>
                  <input type="file" name="picture">
              <?php endif; ?>

              <input type="submit" name="picture" value="変更する">
            </form>
          </div>
          
        </div>
      </div><!-- row -->
    </div><!-- container -->
  </body>
</html> 
