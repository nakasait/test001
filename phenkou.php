<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>パスワード変更</title>
</head>
<body>
<font color="0000ff" size="6">パスワード変更</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

//$userid=$_POST['userid'];
//$name=$_POST['name'];

print '<form method="post" action="pcheck.php">';
print 'ユーザーID ：';
print '<input name="userid" type="text" style="width:50px"></br>';

print '</br>';
print '<input type="button" onclick="history.back()" value="戻る">';
print ' ';
print '<input type="submit" value="変更画面">';

print '</form>';

$dbh = null;

?>
</body>
</html>
