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
require('dbconnect.php');

$id = $_REQUEST['id'];
if (!is_numeric($id) || $id<=0) {
  print('1以上の数字で指定してください');
  exit();
}
// URLパラメーターを使用する場合、想定した値以外の値を指定されないように排除しDBに投げないようにする

$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->execute(array($id));
$memo = $memos->fetch();
?>
<article>
    <pre><?php print($memo['memo']); ?></pre>
    <a href="update.php?id=<?php print($memo['id']); ?>">編集する</a> | <a href="delete.php?id=<?php print($memo['id']); ?>"> 削除する</a> |  <a href="index2.php">戻る</a>
</article>
</main>
<!--
URLパラメーターを取得するためには$_REQUEST,$_GETどちらかになる。今後どこかのタイミングでPOSTでIDを渡す可能性を加味し$_REQUESTを使用
その時prepareメソッドを使用し、id=?、executeメソッドを使用し?を置き換えるパラメーターを指定し安全にURLパラメーターを渡す
prepareメソッドで使用する?はPHPの仕様であり、プレースホルダーという仕組み
プレースホルダーとはSQL文の中の変動する箇所に使用し、その部分はあくまで値として処理され万が一不正な値が入力されてもSQL命令に関わるような特殊文字は無効化（エスケープ）される
 -->
</body>    
</html>