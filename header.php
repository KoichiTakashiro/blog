<header>
  <!-- MENU BLOCK -->
  <div class="menu_block">
    <!-- CONTAINER -->
    <div class="container clearfix">
      <!-- LOGO -->
      <div class="logo pull-left">
        <a href="index.php" ><span class="b1">TaKaPi</span><!-- <span class="b2"></span><span class="b3"></span><span class="b4"></span> --><span class="b5">Blog</span></a>
      </div><!-- //LOGO -->
      <!-- MENU -->
      <div class="pull-right">
        <nav class="navmenu center">
          <ul>
            <li class="first scroll_btn"><a href="admin/index.php">MyPage</a></li>
            <?php if (isset($_SESSION["id"])) : ?>
              <li class="scroll_btn"><a href="join/regist.php">Regist</a></li>
              <li class="scroll_btn last"><a href="logout.php">Logout</a></li>
            <?php else : ?>
              <li class="scroll_btn"><a href="join/regist.php">Regist</a></li>
              <li class="scroll_btn last"><a href="login.php">Login</a></li>
            <?php endif ;?> 
          </ul>
        </nav>
      </div><!-- //MENU -->
    </div><!-- //MENU BLOCK -->
  </div><!-- //CONTAINER -->
</header><!-- //HEADER -->
