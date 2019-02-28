<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn()
{
    //DB接続
$dbn = 'mysql:dbname=gs_f17_db99;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = 'root';

try {
    return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
}

}


//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()){
    // ログイン失敗時の処理（ログイン画面に移動）
    header('Location: kadai_login.php');
   }else{
        // ログイン成功時の処理（一覧画面に移動）
        session_regenerate_id(true);
        $_SESSION['chk_ssid']= session_id();
}
}


// menuを決める
function menu()
{
    $menu = '<li class="nav-item"><a class="nav-link" href="kadai_index.php">todo登録</a></li><li class="nav-item"><a class="nav-link" href="kadai_select.php">todo一覧</a></li>';
    $menu .= '<li class="nav-item"><a class="nav-link" href="kadai_logout.php">ログアウト</a></li>';
    return $menu;
}

function menu1()
{
    $menu = '<li class="nav-item"><a class="nav-link" href="kadai_index.php"></a></li><li class="nav-item"><a class="nav-link" href="kadai_select.php">todo一覧</a></li>';
    $menu .= '<li class="nav-item"><a class="nav-link" href="kadai_logout.php">ログアウト</a></li>';
    return $menu;
}