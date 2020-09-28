<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一括削除</title>
</head>
<body style="background-image: url(b1161.jpg);">
<br/>
<div style="text-align:center">
<font color="000000" size="6">タスク一括削除　抽出条件</font><br/><br/>
</div>

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

print '<form method="post" action="tsakujoi_sl.php">';

//print '<個別削除>';
//print '</br></br>';
print '<div class="container">';
  print '<div style="text-align:center">';
print '<h4>削除条件を選択してください</h4>';

print '</br>';
//print '■公開範囲　　　　';
print '<h4><input type="radio" name="open" value="全体">全体</label>';
print '　';
print '<input type="radio" name="open" value="個人">個人</label>';
print '　';
print $userid;
print '　</h4>';
  print '</div>';
print '</div>';

//print $uname;
//print '<input name="userid" type="text" style="width:50px">';
print '</br>';
print '</br>';
print '<div class="container">';
  print '<div style="text-align:center">';
    print '<input type="submit" value="確認" class="btn btn-primary btn-lg">';
  print '<div>';
  print '　';
  print '<div class="button">';
    print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
  btn-danger btn-lg">';
  print '</div>';
print '<div>';

//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
//print '<input type="hidden" name="sid" value="'.$sid.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
