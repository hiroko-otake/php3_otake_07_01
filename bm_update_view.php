<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

require_once("funcs.php");

//1. POSTデータ取得
$title   = $_POST["title"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
$id    = $_POST["id"]; //追加されています


//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET title = :title, url = :url, comment = :comment, indate=sysdate() WHERE id = :id;");
$stmt->bindValue(':title', h($title), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', h($url), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', h($comment), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}else{
    //*** function化する！*****************
    redirect('bm_list_view.php');
    // header("Location: index.php");
    // exit();
}
?>
