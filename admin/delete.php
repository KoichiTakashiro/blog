<?php
    session_start();
    require('../dbconnect.php');
    require('../my_function.php');

    //ログイン判定
    if(isset($_SESSION["id"]) && $_SESSION["time"] + 10800 >time()){
        
        $sql = sprintf('DELETE FROM posts WHERE id=%s',
                        $_REQUEST["id"]
               );
        mysqli_query($db, $sql) or die(mysqli_error($db));
        header('Location: index.php');
        exit();

        
    }else{
        //ログインしていない場合
        header('Location: ../login.php');
        exit();
    }

?>
