<?php require('dbconnect.php'); ?>
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
<?php
if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {//指定されるURLパラメーターをチェック
  //isset；urlパラメーターが存在するかの確認
  //is_numeric:数字が指定されているかのチェック
  $id = $_REQUEST['id'];
  $memos = $db->prepare('SELECT * FROM memos WHERE id=?');//DBから取得するメモの内容を変数へ（URLパラメーターを使用するため,queryよりprepareが適切
  $memos->execute(array($id));//プレースホルダー（?の置き換え)
  $memo = $memos->fetch();
}

?>
<form action="update_do.php" method="post">
  <input type="hidden" name="id" value="<?php print($id); ?>">
  <textarea name="memo" cols="50" rows="10"><?php print($memo['memo']); ?></textarea><br>
  <button type="submit">登録する</button>
</form>
<!--
hidden属性を使いid情報を次のページへ送る
 -->
</main>
</body>    
</html>