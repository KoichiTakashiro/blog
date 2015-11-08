<?php 
    require('dbconnect.php');
    require('my_function.php');

    //投稿されたブログを最新のものから抽出
    // $sql = 'SELECT * FROM posts ORDER BY created DESC';
    // $posts = mysqli_query($db, $sql) or die(mysqli_error($db));

// ページング
    //投稿を取得する
    // URLに?page=2などのページ番号があれば取得して$pageに代入する
    if (isset($_REQUEST['page'])) {
      $page = $_REQUEST['page'];
    }else{
    //なければ1ページ目とみなす
      $page = 1;
    }
    
    //max関数=> ()内の複数データから一番大きい物を取得する
    //もしユーザーがURLに0.1とか入れても1に変換する
    $page = max($page, 1);
    //最終ページを取得する
    //postsテーブルのデータ件数を取得
    $sql = 'SELECT COUNT(*) AS cnt FROM posts';
    $recordset = mysqli_query($db, $sql) or die(mysqli_error($db));
    $table = mysqli_fetch_assoc($recordset);

    //ceil関数
    ////小数点以下切り上げて数字を作る
    $maxPage = ceil($table["cnt"]/5);

    //もしユーザーが?page=100などの大きすぎる数字を入れてリクエストした際にデータから最大ページを表示し、
    //それ以上の値がセットされれいるときはmini関数を使用して最大ページ数で表示する
    $page = min($page, $maxPage);

    //1ページ目ならoが代入され、DBからSELECT ~ LIMIT 0,5とすることで
    //1個目のデータから5件取得するための$startを用意
    $start = ($page - 1) * 5;
    $start = max(0, $start);

    $sql = sprintf('SELECT m.name, p.* FROM members m, posts p 
        WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT %d, 5',
        $start
        );
    $posts = mysqli_query($db, $sql) or die(mysqli_error($db));

?>


<!DOCTYPE html>
  <!-- HTMLヘッダ&ヘッダー&bodyの開始タグ -->
  <?php
    require('header.php');
  ?>

  <!-- コンテンツTop -->
  <div class="contents_top">
    <div class="container">
      <div class="row">
        <h1>TakaBlog</h1>
        <p>簡単に無料でブログを運営できます。面倒な初期設定はありません。</p>
        <div>
          <?php if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()): ?>
              <input type="button" value="無料会員登録" onClick="location.href='join/regist.php'">
              <input type="button" value="ログイン" onClick="location.href='login.php'">
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  </div>
<!-- 新着ブログ -->
  <div class="contents_new">
    <div class="container">
      <div class="row">
        <h1>新着ブログ</h1>
        <p>新着ブログをピックアップします</p>
      </div>

      <!-- 新着ブログを5件ずつ表示 -->
      <div class="row">
        <?php while($post = mysqli_fetch_assoc($posts)): ?> 
          <p><a href="view.php?id=<?php echo $post["id"]; ?>"><?php echo '<br>';?><?php echo $post["title"]; echo $post["created"] ;?></a>
          </p>
        <?php endwhile; ?>
      </div>
    
      <!-- ページング用のボタン設置 -->
      <div class="row">
          <?php if ($page > 1){ ?>
              <span><a href="index.php?page=<?php print($page -1); ?>">前の5件</a></span>  
          <?php }else{ ?>
              <span>前の5件</span>
          <?php } ?>

          <?php if ($page < $maxPage){ ?>
              <span><a href="index.php?page=<?php print($page +1); ?>">次の5件</a></span>  
          <?php }else{ ?>
              <span>次の5件</span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<!-- おすすめブログ掲載 -->
  <div class="contents_reccomend">
    <div class="container">
      <div class="row">
        <h1>おすすめブログ</h1>
        <p>運営からの一押しブログが表示されます</p>
      </div>
    </div>
  </div>

  <footer>
   <li>
     <ul>管理人自己紹介</ul>
     <ul>お問い合わせ</ul>
     <ul>利用規約</ul>
   </li>
  </footer>

  <script src="js/bootstrap.min.js"></script>
</body>
</html>
