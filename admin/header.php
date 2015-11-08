<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Blog for Golfers</title>
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="../assets/main.css">
</head>

<body>

<div class="container-fluid">
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">たかぶろ</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-collapse-2">
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()): ?>
              <li><a href="../logout.php">ログアウト</a></li>
          <?php else: ?>
              <li><a href="regist.php">無料会員登録</a></li>
              <li><a href="../login.php">ログイン</a></li>
          <?php endif; ?>
          <!-- <li>
            <a class="btn btn-default btn-outline btn-circle"  data-toggle="collapse" href="#nav-collapse2" aria-expanded="false" aria-controls="nav-collapse2">Sign in</a>
          </li> -->
        </ul>
        <!-- <div class="collapse nav navbar-nav nav-collapse" id="nav-collapse2">
          <form class="navbar-form navbar-right form-inline" role="form">
            <div class="form-group">
              <label class="sr-only" for="Email">Email</label>
              <input type="email" class="form-control" id="Email" placeholder="Email" autofocus required />
            </div>
            <div class="form-group">
              <label class="sr-only" for="Password">Password</label>
              <input type="password" class="form-control" id="Password" placeholder="Password" required />
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div> -->
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
</div><!-- /.container-fluid -->

