<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../php/css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
<?php
try {
  $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
  $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
  $statement->execute(array($_POST['memo']));
  echo 'メッセージが登録されました';
  // $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');
} catch(PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
}
?>
</pre>
<!--
このSQLはmemosテーブルに入力された情報と現在時刻を保存するためのもの
$_POST['memo']はformに指定したmethod属性とリンク
NOWはSQLで使用できる関数で現在時刻を入れることが可能
POSTの値がそのまま使用されると危険（SQLに投げる値はきちんと処理をしてから渡さないと危険な文字列などによりSQLが意図的に壊されてDBの中のデータが盗まれる危険性がある
prepare・・事前準備。後述のSQL内に?とし、ユーザーが入力された値が入ってくると予め準備している
statementオブジェクト・・executeメソッドが準備されパラメーターには’実際に何が入ってくるか’値を指定する（prepareで指定したパラメーターが入り",'などの記号も適切な処理がされる）
POSTの値などのフォームに入力された情報をDBに保存するときはprepare等の安全性を高めた処理が必要
bindParamメソッド・・パラメーターに順番と、情報を指定するやり方があり、長いSQLで複数の?を指定するとき等に使用
  $statement->bindParam(1, $_POST['memo']);
  $statement->execute();
 -->
</main>
</body>    
</html>