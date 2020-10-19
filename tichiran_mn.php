<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一覧</title>
</head>
<body style="background-image: url(b1161.jpg);">
<div style="text-align:center">
<font color="000000" size="6">タスク一覧　抽出条件</font><br/><br/>
</div> 
<style>
    div.button{
    text-align: center;
    }
</style>

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$uname=$_POST['uname'];

$sql= 'SELECT * FROM user WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="tichiran_up.php">';

//print '                     ';
print '<h4>　　　　　　　抽出条件を選択してください';
print '</br></br>';
print '　　　　　　　■公開範囲　　　　';
print '<input type="radio" name="open" value="全体">全体</label>';
print '　　';
print '<input type="radio" name="open" value="個人">個人</label>';
print '　';
print $userid;
print '　';
//print $uname;
print '　';
//pint '<input name="userid" type="text" style="width:50px">';
print '</br>';
//$open="value";
print '</br>';
print '　　　　　　　■ステータス　　　';
print '<input type="radio" name="stat" value="すべて">すべて</label>';
print '　';
print '<input type="radio" name="stat" value="進行中">進行中</label>';
print '　';
print '<input type="radio" name="stat" value="完了">完了</label>';
print '　';
print '<input type="radio" name="stat" value="期限切れ">期限切れ</label>';
print '</h4></br>';
//$stat="value";
print '</br>';
print '<div class="container">';
  print '<div style="text-align:center">';
  print '<input type="submit" value="確認" class="btn btn-primary btn-lg">';
  print '　';
//  print '<input type="button" onclick="history.back()" value="戻る" class="btn print   btn-danger btn-lg">';
  print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
print '</div>';
print '</div>';

//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
