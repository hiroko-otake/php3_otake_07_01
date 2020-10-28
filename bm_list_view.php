<?php
//1.  DB接続します
require_once("funcs.php");
$pdo = db_conn();


//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();


//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>'. $result['title'] .'</td>';
    $view .= '<td>'. '<a href=' . $result['url'] . ' target="_blank"> Amazonリンク</a>' .'</td>';
    $view .= '<td>'. $result['comment'] .'</td>';
    $view .= '<td>'. $result['indate'] .'</td>';
    $view .= '<td>'. '<a href="detail.php?id='. $result["id"]. '">更新</a>'. '</td>';
    $view .= '<td>'. '<a id="delete" href="delete.php?id='. $result["id"]. '">削除</a>'. '</td>';
    $view .= '</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/jquery-2.1.3.min.js"></script>
<title>カズオ・イシグロBOOKS</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
  <div class="page_title">カズオ・イシグロ作品一覧</div>
  <div class="title_image"><img src="img/img.jpg" alt="カズオ・イシグロとのツーショット" width="220px"></div>
</header>

<div class="body">
  <div style="height:460px; overflow:auto; border:none solid;">
    <table border="1">
        <tr style="background-color:gainsboro">
            <th width="15%">書籍名</th>
            <th width="7%">URL</th>
            <th>感想</th>
            <th width="10%">登録日時</th>
            <th width="4%">更新</th>
            <th width="4%">削除</th>
        </tr>

      <div>
          <div class="container jumbotron"><?= $view ?></div>
      </div>
      </table>
   </div>   
</div>

<footer class="footer">
  <a href="index.php" class="back_text">新刊本の登録画面に戻る</a>
</footer>

<script>
$('#delete').click(function(){
    if(!confirm('本当に削除しますか？')){
        /* キャンセルの時の処理 */
        return false;
    }else{

    }
});
</script>
</body>
</html>

