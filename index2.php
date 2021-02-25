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
require('dbconnect.php');
if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) { //pageが指定されていた場合かつ指定された文字が数字の場合
  $page = $_REQUEST['page'];
} else {
  $page = 1; //URLパラメーターが指定されなかった場合、または数字以外の文字で指定された場合、１番目のページを出力する
}
$start = 5 * ($page - 1);
$memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');// memosテーブルからid情報を取得し降順に並び替え変数に格納
$memos->bindParam(1, $start, PDO::PARAM_INT);
$memos->execute(); //execute(array($_REQUEST))にはできない。executeメソッドのパラメーターには型を指定できないためLIMIT句の?に数字を渡す必要があるがそれがうまく出来ない
//そのためbindParamメソッドを使用し１番目の?に$startの値が入るようにする、最後に型を指定PDO::PARAM_INTOは数字でパラメーターを渡す

?>
<article>
  <?php
  while ($memo = $memos->fetch()): ?>
    <p><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 50)); ?></a></p>
    <time><?php print($memo['created_at']); ?></time>
    <hr>
  <?php endwhile; ?>
  
  <?php
  if ($page >= 2):
  ?>
    <a href="index2.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
  <?php endif; ?>
   |
  <?php
  $counts = $db->query('SELECT COUNT(*) as cnt FROM memos'); //memosテーブルから全ての件数を取得し,cntという別名のキーとして扱う（今後取得した件数をcntというキーで取り出すことができるようにした）
  $count = $counts->fetch(); //このSQLは1件のみ返すのでwhile構文は不要
  $max_page = ceil($count['cnt'] / 5); //ceil切り上げて次の値にする(計算結果が1.1なら2とする)
  if ($page < $max_page):
  ?>
  <a href="index2.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
  <?php endif; ?>
</article>
<a href="input.html">投稿画面へ</a>
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
