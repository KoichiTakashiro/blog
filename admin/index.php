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

        //ブログ情報の取得
        $sql = sprintf('SELECT m.name, p.* FROM members m, posts p 
                    WHERE m.id=p.member_id AND p.member_id=%d ORDER BY created DESC',
                  mysqli_real_escape_string($db, $_SESSION["id"])
                  );
        $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
<<<<<<< HEAD
=======
        // $post = mysqli_fetch_assoc($posts);
>>>>>>> 40d0357ca4f63d4a4608157feb8b9443be9de922
        
    }else{
        //ログインしていない場合
        header('Location: ../login.php');
        exit();
    }
<<<<<<< HEAD
=======
    //会員情報の取得
>>>>>>> 40d0357ca4f63d4a4608157feb8b9443be9de922
    
?>
<!DOCTYPE html>
<!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
  <?php
<<<<<<< HEAD
    require('head.php');
    require('header.php');
  ?>

  <!-- 管理画面左側のサイドバー -->
  <div class="container">
    <div class="row">
      <?php
          require('side_bar.php');
      ?>
      <!-- ここまでサイドバー -->
      <!-- ここから管理画面メイン部分（入力フォーム） -->
      <div class="col-xs-8">
        <div class="row">
          <div>
            <h2>管理トップ</h2>
          </div>
          

          <div>
            <?php
                //プルフィール写真の表示
                echo '<div class="col-md-6">';

                  if ($member["picture"] != "") {
                      echo sprintf('<img src="../member_picture/%s" width="100" height="100">',
                               $member["picture"]
                      );
                  }else{
                      echo '<img src="../assets/image/default.jpg">';
                  }
                echo '</div>';

                echo '<div class="col-md-6">';
                //管理者名の表示
                  echo sprintf('<p>%sのブログ</p>',
                              mysqli_real_escape_string($db, $member["name"])
                              );

            ?>

                  <input type="button" onclick="location.href='write.php'" value="ブログを書く">
                </div>
          </div>
        </div><!-- row -->

        <hr>

        <div class="row">
          <h3>最近投稿した記事</h3>
        </div>

        <?php 
            while ($post = mysqli_fetch_assoc($posts)){
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<a href="../view.php?id='.$post['id'].'">'.$post['title'] . '<br>' . $post["created"] . '<br></a>';
                echo '</div>';

                echo '<div class="col-md-6">';
                echo sprintf('<input type="button" onclick="location.href='."'".'edit.php?id=%d'."'".'"'.'value="編集">',
                            $post["id"]
                            );
                echo sprintf('<input type="button" onclick="location.href='."'".'delete.php?id=%d'."'".'"'.'value="削除">',
                            $post["id"]
                            );
                echo '</div>';
                echo '</div>';
                echo '<hr>';
            }
        ?>
      </div><!-- <div class="col-xs-8"> -->
    </div>
  </div>

=======
    require('../header.php');
  ?>
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
              if ($member["picture"] == "default.png") {
                  echo '<img src="../member_picture/default.png" width="100" height="100">';
              
              }elseif ($member["picture"] != "") {
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
        <div>
          <h2>最近投稿した記事</h2>
          <?php if ($post = mysqli_fetch_assoc($posts)): ?> 
              <?php while($post = mysqli_fetch_assoc($posts)):?>
                  <a href="view.php?id=<?php echo $post['id'] ;?>">
                    <?php echo $post['title'] . '<br>' . $post["created"] . '<br>' ;?></a>
              <?php endwhile; ?>
          <?php else: ?>
              <?php echo "投稿済みのブログはありません。";?>
          <?php endif ;?>
        </div>
      </div>
    </div>
  </div>




>>>>>>> 40d0357ca4f63d4a4608157feb8b9443be9de922
<body>
</html>
