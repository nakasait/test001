<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク削除</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$sid=$_POST['sid'];
//$uname=$_POST['uname'];
//$name=$_POST['name'];
//$view=$_POST['view'];
//$view2=$_POST['view2'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

$sql= 'UPDATE tusk SET sakujo="1" WHERE id="'.$sid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
print '<form method="post">';

print '<beginTransaction()>';


print 'タスク情報削除完了しました。<br/><br/>';
print 'ID　　　タスク　ユーザー　ステータス　 完了日　　完了期限　　登録日';
print '<br/><br/>';
//print 'ID：';

$sql = 'SELECT * FROM tusk WHERE id="'.$sid.'"';
foreach ($dbh->query($sql) as $row){
print $row['id'];
}

print '　';
print $row['name'] ;
print '　';
print $row['userid'];
print ' ';
  if ($row['status']=='0')
    print '進行中';
  if ($row['status']=='1')
    print '完了';
  if ($row['status']=='2')
    print '期限切れ';
print '　';
print $row['enddate'];
print '　';
print $row['limitdate'];
print '　';
print $row['insdate'];
print '<br/><br/>';

print '<commit()>';

print '<rollBack()>';
$dbh = null;

?>
</body>
</html>
