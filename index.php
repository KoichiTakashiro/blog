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

    $sql = sprintf('SELECT m.name, m.picture, p.* FROM members m, posts p 
        WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT %d, 5',
        $start
        );
    $posts = mysqli_query($db, $sql) or die(mysqli_error($db));

   	
    

?>

<!DOCTYPE html>
<?php
  require('head.php');
?>
	<body>
		<!-- PRELOADER -->
		<img id="preloader" src="images/preloader.gif" alt="" />
		<!-- //PRELOADER -->
		<div class="preloader_hide">

			<!-- PAGE -->
			<div id="page" class="single_page">
				<!-- HEADER -->
				<?php
						require('header.php')
				?>
				
				<!-- BREADCRUMBS -->
				<section class="breadcrumbs_block clearfix parallax">
					<div class="container center">
						<h2><b>The</b> TakaPi Blog</h2>
						<p>You can make your blog easily.</p>
						<p>Don't worry, you can.</p>
					</div>
				</section><!-- //BREADCRUMBS -->
				
				
				<!-- BLOG -->
				<section id="blog">
					<!-- CONTAINER -->
					<div class="container">
						<!-- ROW -->
						<div class="row">
							<h2>NEW ARRIVAL</h2>
		      		<?php while($post = mysqli_fetch_assoc($posts)): ?>
								<!-- BLOG BLOCK -->
								<div class="blog_block col-lg-12 col-md-12 padbot50">
									<!-- BLOG POST -->
									<div class="row">
										<div class="blog_post margbot50 clearfix" data-animated="fadeInUp">
											<div class="blog_post_img">
												<?php 
						              echo sprintf('<img class="img-responsive user-photo" src="./member_picture/%s" width="100" height="100">',
						                             $post["picture"]
			                 		);
			          				?>
												<a class="zoom" href="view.php?id=<?php echo $post["id"]; ?>" ></a>
											</div>
											<div class="blog_post_descr">
												<div class="blog_post_date"><?php echo $post["created"] ;?></div>
												<a class="blog_post_title" href="view.php?id=<?php echo $post["id"]; ?>" ><?php echo $post["title"]; ?></a>
												<ul class="blog_post_info">
													<!-- <li><a href="javascript:void(0);" >Admin</a></li> -->
													<!-- <li><a href="javascript:void(0);" >Creative</a></li> -->
													<?php
															//コメント数の取得
															if (isset($post["id"])) {
																$sql = sprintf('SELECT COUNT(*) AS cnt FROM comments WHERE reply_post_id=%d',
																								$post["id"]
																								);
																$recordset = mysqli_query($db, $sql) or die(mysqli_error($db));
																$table = mysqli_fetch_assoc($recordset);
															}
													?>
													<li><a href="javascript:void(0);" >comments( <?php echo $table["cnt"] ;?> )</a></li>
												</ul>
												<hr>
												<div class="blog_post_content"><?php echo $post["content"]; ?></div>
												<a class="read_more_btn" href="view.php?id=<?php echo $post["id"]; ?>" >Read More</a>
											</div>
										</div>
									</div>
								</div><!-- //BLOG POST -->
							<?php endwhile; ?>
						</div><!-- //ROW -->
					</div><!-- //CONTAINER -->
				</section><!-- //BLOG -->
			</div><!-- //PAGE -->

			<!-- CONTACTS -->
      <section id="contacts">
      </section><!-- //CONTACTS -->
      
      <!-- FOOTER -->
      <?php
        require('footer.php');
      ?>
		</div>
	</body>
</html>
