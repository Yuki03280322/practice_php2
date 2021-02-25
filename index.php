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

// try {
//   $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8',
//   'root', 'root');
// } catch(PDOException $e) {
//   echo 'DB接続エラー: ' . $e->getMessage();
// }

// $count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="もも", price=210, keyword="缶詰,ピンク,甘い"');
// echo $count . '件のデータを挿入しました';
// $db・・DPOの新しいインスタンスとして準備したもの→mydbに入っているテーブルは自由に操作できるようにしている
// execによりSQLを発行（execは影響を与えた行の数を受け取るが検索結果を受け取ることは出来ないため、SELECT構文を使用できない）
// INSERT構文により1件のデータを挿入し、$countに数字が1加算される

$records = $db->query('SELECT * FROM my_items');
while ($record = $records->fetch()) {
  print($record['item_name'] . "\n");
}
// queryメソッドは後述のSELECT構文で得られた値を受け取る
// $recordsはオブジェクトのインスタンスとなり、Recordsetというオブジェクトのインスタンスとなる
// このインスタンスが持つメソッドの中の一つとしてfetchを利用
// これはDBから受け取ったレコードの行の集まりから1行を取り出していき、無くなるとfalseを返す
// 全てのレコードを受け取るためwhile構文で繰り返し処理を行い、一つ一つを$recordに格納している
// $recordは連想配列の為、$recordのブラケットとDBのカラム名を指定し、item_nameを取り出している
?>
</pre>
<!--
new PDO・・PHP Data Object（データベースを扱うためのオブジェクト）のコンストラクターというオブジェクトを作るときに指定するパラメーターを指定していく
接続文字列（データベースに接続するための文字列）としてmysqlの場合、DBの名前、サーバーのアドレス、文字コードを指定しそれぞれをセミコロンで区切る
mysql:dbname=mydb・・mydbは自分が作ったDBの名前
try{}catch{}・・エラーが発生したとき、そのままエラーとして落とすのではなく例外を発生させそれを受け取り処理を行う
この場合はうまく処理が行われなかったとき、PDOExceptionという種類のメッセージを渡しこの例外処理を発生させる
try{new PDO}・・接続を試してみてうまく行かなかったときは例外を投げてくださいという処理
catch(){}・・例外を投げたときPDOExceptionを$eとして受け取り、その$eの中のメッセージを出力する処理
これによりDBに接続できなかったときエラー画面に飛ばしたり、DBを使わなくてもできる処理だけを行うといった制御が可能
 -->
</main>
</body>    
</html>