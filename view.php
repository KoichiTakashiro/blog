<?php
    session_start();
    require('dbconnect.php');
    require('my_function.php');

    //投稿データの抽出
    if (isset($_REQUEST["id"])) {
    		$sql = sprintf('SELECT m.name, m.picture, p.* FROM members m, posts p 
                            WHERE m.id=p.member_id AND p.id=%d ',
                          mysqli_real_escape_string($db, $_REQUEST["id"])
                          );
            $posts = mysqli_query($db, $sql) or die(mysqli_error($db));
            $post = mysqli_fetch_assoc($posts);
    }else{
        header('Location: index.php');
        exit(); 
    }
    

    

    //投稿データに対するカテゴリを取得
    $sql_c = sprintf('SELECT c.name FROM categories c, posts p 
                    WHERE c.id=p.category_id AND p.id=%d ',
                  mysqli_real_escape_string($db, $_REQUEST["id"])
                  );
    $posts_c = mysqli_query($db, $sql_c) or die(mysqli_error($db));
    $post_c = mysqli_fetch_assoc($posts_c);

    // コメントをDBへ登録する
    if (isset($_POST["content"])) {
        $sql_com = sprintf('INSERT INTO comments SET content="%s", member_id=%d, reply_post_id=%d, created=NOW()',
                      mysqli_real_escape_string($db, $_POST["content"]),
                      $_SESSION["id"],
                      $post["id"]
        );
        mysqli_query($db, $sql_com);
    }

    //コメント数の取得
    $sql = sprintf('SELECT COUNT(*) AS cnt FROM comments WHERE reply_post_id=%d',
                    $post["id"]
                    );
    $recordset = mysqli_query($db, $sql) or die(mysqli_error($db));
    $table = mysqli_fetch_assoc($recordset);

    $sql_comments = sprintf('SELECT m.name, m.picture, c.* FROM members m, comments c WHERE m.id=c.member_id AND reply_post_id=%d ORDER BY created DESC',
                            $_REQUEST["id"]
    );
    $comments = mysqli_query($db, $sql_comments);

		

    
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
					<!-- <div class="container center">
						<h2><b>The</b> TakaPi Blog</h2>
						<p>You can make your blog easyly.</p>
						<p>Don't worry you can.</p>
					</div> -->
				</section><!-- //BREADCRUMBS -->
				
				
				<!-- BLOG -->
				<section id="blog">
					
					<!-- CONTAINER -->
					<div class="container">
						
						<!-- ROW -->
						<div class="row">
						
							<!-- BLOG BLOCK -->
							<div class="blog_block col-lg-9 col-md-9 padbot50">
								
								<!-- SINGLE BLOG POST -->
								<div class="single_blog_post clearfix" data-animated="fadeInUp">
									<div class="single_blog_post_descr">
										<div class="single_blog_post_category">カテゴリ：<?php echo $post_c["name"] ;?></div>
                    <hr>
										<div class="single_blog_post_date"><?php echo $post["created"] ;?></div>
                    <hr>
										<div class="single_blog_post_title"><?php echo $post["title"]; ?></div>
                    <hr>
										<ul class="single_blog_post_info">
											<!-- <li><a href="javascript:void(0);" >Admin</a></li>
											<li><a href="javascript:void(0);" >Creative</a></li> -->
											<li><a href="javascript:void(0);" ><?php echo $table["cnt"] ;?> Comments</a></li>
										</ul>
									</div>

									<!-- <div class="single_blog_post_img">
										<img src="./member_picture/<?php echo $post["picture"] ;?>" width="100" height="100" />
									</div> -->
									
									<div class="single_blog_post_content">
										<p class="margbot50"><?php echo $post["content"] ;?></p>
										<!-- <p class="margbot30">I understand why Davis’ daughters felt they needed to defend their mom and her parenting. The onslaught on Davis’ parenting (and her politics) from the right, particularly in the wake of that DMN article, has been appalling: They’ve called her everything from “Abortion Barbie” to implying she’s a bad, gold digging mom. Her daughter, Dru, points out that her mom always shared joint custody, even though she was living in her father’s house.</p>
										<p class="margbot40">But she also discusses her mom’s involvement in other ways: Her mom was her Brownie troop leader. Her mom was her team’s field hockey mom when Dru was a senior in high school. “She went with me to every field hockey camp, tryout, program that I ever had,” Dru writes, adding, “my sister and I were always her first priority.”</p>
									 --></div>
									
								</div><!-- //SINGLE BLOG POST -->
					
								
								<hr>

								<!-- LEAVE A COMMENT -->
								<div class="leave_comment" data-animated="fadeInUp">
									<h3><b>Leave a</b> Comment</h3>
									
									<form id="comment_form" class="row" action="" method="post">
										<div class="col-lg-8 col-md-8">
											<textarea name="content" onFocus="if (this.value == 'Your message *') this.value = '';" onBlur="if (this.value == '') this.value = 'Your message *';">Your message *</textarea>
											<input class="contact_btn pull-right" type="submit" value="Send message" />
										</div>
									</form>
								</div><!-- //LEAVE A COMMENT -->

								<hr class="margbot80">
								
								<!-- COMMENTS -->
								<div id="comments" class="margbot30" data-animated="fadeInUp">
									<h3><b>Comments </b><span class="comments_count">(<?php echo $table["cnt"] ;?>)</span></h3>
									<?php while ($comment = mysqli_fetch_assoc($comments)):?>
											
												<li class="clearfix" data-animated="fadeInUp">
													<div class="pull-left avatar">
														<a href="javascript:void(0);" ><img src="./member_picture/<?php echo $comment["picture"]; ?>" alt="" /></a>
													</div>
													<div class="comment_right">
														<div class="comment_info clearfix">
															<div class="pull-left comment_author"><?php echo $comment["name"]; ?></div>
															<div class="pull-left comment_inf_sep">|</div>
															<div class="pull-left comment_date"><?php echo $comment["created"]; ?></div>
														</div>
														<p><?php echo $comment["content"]; ?></p>
													</div>
												</li>
											</ul>
									<?php endwhile; ?>
								</div>
								<!-- //COMMENTS -->
									
							</div><!-- //BLOG BLOCK -->

							<!-- </div> --><!-- //SIDEBAR -->
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
