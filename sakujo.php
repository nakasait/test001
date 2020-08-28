<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー削除</title>
</head>
<body>
<font color="0000ff" size="6">ユーザー削除</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

//$upd=$_POST['upd'];
//$userid=$_POST['userid'];
//$name=$_POST['name'];
//$name2=$_POST['name2'];
//$pass=$_POST['pass'];
//$pass2=$_POST['pass2'];

print '<form method="post" action="scheck.php">';
print '削除ユーザーID ：';
print '<input name="userid" type="text" style="width:50px"></br>';
//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print 'ユーザー：';
//print '</br>';
//print 'ユーザー：';

print '</br>';
print '<input type="submit" value="確認">';
print '</form>';

?>
</body>
</html>
