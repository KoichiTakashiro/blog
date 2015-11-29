<footer>
  <?php 
    if (isset($_POST["name"]) || isset($_POST["message"])) {
        $sql_message = sprintf('INSERT INTO messages SET name="%s", message="%s", created=NOW()',
                                $_POST["name"],
                                $_POST["message"]
                                );
        mysqli_query($db, $sql_message);
    }

  ?>
    
  <!-- CONTAINER -->
  <div class="container">
    
    <!-- ROW -->
    <div class="row" data-appear-top-offset="-200" data-animated="fadeInUp">
      
      <!-- <div class="col-lg-4 col-md-4 col-sm-6 padbot30">
        <h4><b>Featured</b> posts</h4>
        <div class="recent_posts_small clearfix">
          <div class="post_item_img_small">
            <img src="images/blog/1.jpg" alt="" />
          </div>
          <div class="post_item_content_small">
            <a class="title" href="index.php" >As we have developed a unique layout template</a>
            <ul class="post_item_inf_small">
              <li>10 January 2014</li>
            </ul>
          </div>
        </div>
        <div class="recent_posts_small clearfix">
          <div class="post_item_img_small">
            <img src="images/blog/2.jpg" alt="" />
          </div>
          <div class="post_item_content_small">
            <a class="title" href="index.php" >How much is to develop a design for the game?</a>
            <ul class="post_item_inf_small">
              <li>14 January 2014</li>
            </ul>
          </div>
        </div>
        <div class="recent_posts_small clearfix">
          <div class="post_item_img_small">
            <img src="images/blog/3.jpg" alt="" />
          </div>
          <div class="post_item_content_small">
            <a class="title" href="index.php" >How to pump designer</a>
            <ul class="post_item_inf_small">
              <li>21 December 2013</li>
            </ul>
          </div>
        </div>
      </div> -->
      
      <div class="col-lg-6 col-md-6 padbot30 foot_about_block">
        <h4><b>About</b> us</h4>
        <p>プログラミング歴2ヶ月、駆け出しエンジニアのブログシステム。</p>
        <p>これからがんがん開発する！！</p>
        <!-- <ul class="social">
          <li><a href="javascript:void(0);" ><i class="fa fa-twitter"></i></a></li>
          <li><a href="javascript:void(0);" ><i class="fa fa-facebook"></i></a></li>
          <li><a href="javascript:void(0);" ><i class="fa fa-google-plus"></i></a></li>
          <li><a href="javascript:void(0);" ><i class="fa fa-pinterest-square"></i></a></li>
          <li><a href="javascript:void(0);" ><i class="map_show fa fa-map-marker"></i></a></li>
        </ul> -->
      </div>
      
      <div class="respond_clear"></div>
      
      <div class="col-lg-6 col-md-6 padbot30">
        <h4><b>Contacts</b> Us</h4>
        
        <!-- CONTACT FORM -->
        <div class="span9 contact_form">
          <div id="note"></div>
          <div id="fields">
            <form id="contact-form-face" class="clearfix" action="" method="post">
              <input type="text" name="name" value="Name" onFocus="if (this.value == 'Name') this.value = '';" onBlur="if (this.value == '') this.value = 'Name';" />
              <textarea name="message" onFocus="if (this.value == 'Message') this.value = '';" onBlur="if (this.value == '') this.value = 'Message';">Message</textarea>
              <input class="contact_btn" type="submit" value="Send message" />
            </form>
          </div>
        </div><!-- //CONTACT FORM -->
      </div>
    </div><!-- //ROW -->
  </div><!-- //CONTAINER -->
</footer><!-- //FOOTER -->


<!-- MAP -->
<!-- <div id="map">
  <a class="map_hide" href="javascript:void(0);"><i class="fa fa-angle-right"></i><i class="fa fa-angle-left"></i></a>
  <iframe src="http://maps.google.com/maps?f=q&amp;give%20a%20hand=s_q&amp;hl=en&amp;geocode=&amp;q=london&amp;sll=37.0625,-95.677068&amp;sspn=42.631141,90.263672&amp;ie=UTF8&amp;hq=&amp;hnear=London,+United+Kingdom&amp;ll=51.500141,-0.126257&amp;spn=0.026448,0.039396&amp;z=14&amp;output=embed" ></iframe>
</div> --><!-- //MAP -->
