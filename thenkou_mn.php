<!DOCTYPE HTML >
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク変更</title>
</head>
<body style="background-image: url(b1161.jpg);">
<style>
    div.button{
    text-align: center;
    }
</style>
 
<?php
session_start();
print '<div class="container">';
print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';

  print '<font color="000000" size="6">タスク変更　抽出条件</font><br/><br/>';
//print '</div>';
//print '</div>';

  $dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$uname=$_POST['uname'];

//トランザクション開始
$dbh->beginTransaction();

$sql= 'SELECT * FROM tusk WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="thenkou_up.php">';

print '                     ';
print '<h4>抽出条件を選択してください';
print '</br></br>';
print '■公開範囲　</br></br>';
print '<label>全体</br><input type="radio" name="open" value="全体" class="form-control"></label>';
print '</br>';
print '個人："'.$userid.'"</br><input type="radio" name="open" value="個人" class="form-control"></label>';
//print '</div>';
//print '</div>';

print '</br>';
//print $userid;
//print '　';
//print $uname;
//print '<input name="userid" type="text" style="width:50px">';
print '</br>';
$open='value';
//print '</br></br>';
print '■ステータス</br></br>';
print '<label>すべて<input type="radio" name="stat" value="すべて" class="form-control"></label>';
print '</br>';
print '<label>進行中<input type="radio" name="stat" value="進行中" class="form-control"></label>';
print '</br>';
print '<label>完了<input type="radio" name="stat" value="完了" class="form-control"></label>';
print '</br>';
print '<label>期限切れ<input type="radio" name="stat" value="期限切れ" class="form-control"></h4></label>';
print '</br>';
print '</div>';
print '</div>';

$stat='value';
//print '</br></br>';
print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';
  print '<input type="submit" value="確認" class="btn btn-primary btn-lg">';
  print '</div>';
print '</form>';

print '</br>';
print '<form method="post" action="mainmenu.php">';
print '<div class="button">';
  print '<input type="submit" value="メインメニュー"  class="btn btn-danger btn-lg">';
print '</div>';
print '</div>';
print '</form>';

//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
