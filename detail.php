<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET['id'];
// var_dump($id);

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
require_once("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=" . $id);
$status = $stmt->execute();


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
   $result = $stmt->fetch();
  }
  ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>カズオ・イシグロBOOKS</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>


<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_list_view.php" style="text-decoration: none">【カズオ・イシグロ作品一覧】を開く</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form action="bm_update_view.php" method="POST">
  <div class="jumbotron">
   <fieldset>
    <legend>新刊本の登録</legend>
     <label>書籍名：<input type="text" name="title"  value=<?= $result['title'] ?> required></label><br>
     <label>Amazon URL：<input type="text" name="url" value=<?= $result['url'] ?> required></label><br>
     <label for="kanso">感想：</label><br>
     <label><textArea name="comment" rows="4" cols="40" required><?= $result['comment'] ?></textArea></label><br>
     <input type="hidden" name="id" value=<?= $result['id'] ?>>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
