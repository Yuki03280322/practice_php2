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
try {
  $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8',
  'root', 'root');
} catch(PDOException $e) {
  echo 'DB接続エラー: ' . $e->getMessage();
}

$memos = $db->query('SELECT * FROM memos ORDER BY id DESC ');
// memosテーブルからid情報を取得し降順に並び替え変数に格納
?>
<article>
  <?php
  while ($memo = $memos->fetch()): ?>
    <p><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 50)); ?></a></p>
    <time><?php print($memo['created_at']); ?></time>
    <hr>
  <?php endwhile; ?>
</article>
</main>
<!--
articleタグ・・様々記事を表示するためのタグ
$memos->fetch();・・memosレコードセットに入っているデータを１件ずつ取り出しmemoへ格納
timeタグで「時」を表すコンテンツを囲むことで検索エンジンが「時」を表しているコンテンツであることを認識できるようになる
mb_substr・・文字数を制限、3つのパラメーター→元となる文字列＋開始位置＋文字数0,50で最初から50文字まで出力
URLにつく?はウェブの仕様であり（HTTPプロトコルの仕様）、URLの後ろに？をつけてそのページに渡したいパラメーターを続けると、
ウェブページに内容を渡すことができるという仕組み
 -->
</body>
</html>
