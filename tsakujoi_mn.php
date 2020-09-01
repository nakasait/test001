<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク削除</title>
</head>
<body>
<font color="0000ff" size="6">タスク一括削除　抽出条件</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

//$open=$_POST['open'];
//$stat=$_POST['stat'];


$sql= 'SELECT * FROM user WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="tsakujoi_sl.php">';

//print '<個別削除>';
//print '</br></br>';
print '削除条件を選択してください';
print '</br></br>';
//print '■公開範囲　　　　';
print '<input type="radio" name="open" value="全体">全体</label>';
print '　';
print '<input type="radio" name="open" value="個人">個人</label>';
print '　';
print '<input name="userid" type="text" style="width:50px">';
print '</br>';
print '</br>';
print '<input type="submit" value="確認">';

//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
//print '<input type="hidden" name="sid" value="'.$sid.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
