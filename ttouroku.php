<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク登録</title>
</head>
<body>
<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

//$userid=$_POST['userid'];
//$uname=$_POST['uname'];

print '<font color="0000ff" size="6">タスク登録</font>';

//print userid,uname取得

print '　　　　　';
//print '"$userid"'  ;
//print '"$uname"';
print '<br/><br/>';

print '<form method="post" action="ttcheck.php">';

print 'ユーザーID　';
print '<input name="userid" type="text" style="width:50px"><br/><br/>';

print 'タスク名　';
print '<input name="name" type="text" style="width:200px"><br/><br/>';

print '公開範囲　';
$view="全体";
print '<input name="view" type="radio" value="全体">全体</label>';
print '<input name="view" type="radio" value="個人">個人</label>';
//ここにバリデーション入れる
print '　どちらかを選択';
print '<br/><br/>';

print '完了日　　';
print '<input name="enddate" type="text" style="width:100px"><br/><br/>';
print '完了期限　';
print '<input name="limitdate" type="text" style="width:100px">';
print '　　（任意）';
print '<br/><br/>';

//print '<form method="post" action="tkanryo.php">';
//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '<input type="hidden" name="name" value="'.$name.'">';
//print '<input type="hidden" name="view" value="'.$view.'">';
//print '<input type="hidden" name="view2" value="'.$view2.'">';
//print '<input type="hidden" name="enddate" value="'.$enddate.'">';
//print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';
print '　　　　　';
print '<input type="submit" value="登録">';

print '</form>';

?>
</body>
</html>
