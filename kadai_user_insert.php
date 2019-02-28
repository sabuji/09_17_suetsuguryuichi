<?php
//最初にSESSIONを開始！！
session_start();

//0.外部ファイル読み込み
include('kadai_functions.php');


var_dump($_POST);
var_dump($_GET);


// 入力チェック
if(
    !isset($_POST['id']) || $_POST['id']=='' ||
    !isset($_POST['name']) || $_POST['name']=='' ||
    !isset($_POST['lid']) || $_POST['lid']=='' ||
    !isset($_POST['lpw']) || $_POST['lpw']=='' ||
    !isset($_POST['kanri_flg']) || $_POST['kanri_flg']=='' ||
    !isset($_POST['life_flg']) || $_POST['life_flg']=='' 
) {
    exit('ParamError');
}

//POSTデータ取得
$id = $_POST['id'];
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];



//データ登録SQL作成
$sql ='INSERT INTO user_table(id, name, lid, lpw, kanri_flg, life_flg) VALUES (NULL, :a1, :a2, :a3, :a4, :a5 )';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);   //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //５．kadai_index.phpへリダイレクト
    header('Location:kadai_user_index.php');
}
