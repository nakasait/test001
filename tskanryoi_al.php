<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク一括削除</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
$open=$_POST['open'];
//$name=$_POST['name'];
//$view=$_POST['view'];
//$view2=$_POST['view2'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//全体ならばすべてのレコードに削除フラグ１
//print $open;
print '<form method="post">';

print '<beginTransaction()>';


if ($open=="全体")
{
$sql= 'UPDATE tusk SET sakujo="1" WHERE view="'.$open.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
print 'タスク情報一括削除完了しました。<br/><br/>';
print '対象：タスクテーブル全件';
}

if ($open=="個人")
{
$sql= 'UPDATE tusk SET sakujo="1" WHERE view="'.$open.'" and userid="'.$userid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
print 'タスク情報一括削除完了しました。<br/><br/>';
print '対象：個人タスク全件';
}
print '<commit()>';

print '<rollBack()>';
$dbh = null;

?>
</body>
</html>
