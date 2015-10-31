<?php
    session_start();

    //セッション情報を削除
    $_SESION = array();

    //パソコンから自然と送られてしまう情報を削除する
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(),'', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
        );
    }
    //セッションを削除 startの逆
    session_destroy();

    //Cookie情報の削除
    setcookie('email','', time() -3600);
    setcookie('password','', time() -3600);
    
    header('Location: index.php');
    exit();

?>
