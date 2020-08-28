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

$userid=$_POST['userid'];
$uname=$_POST['uname'];
//$name=$_POST['id'];
$name=$_POST['name'];
$view=$_POST['view'];
$enddate=$_POST['enddate'];
$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);

//$sql= 'SELECT * FROM kensu';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$sql= 'INSERT INTO tusk (id,name,userid,view,status,sakujo,enddate,limitdate,insdate) VALUES (00000,"'.$name.'","'.$userid.'","'.$view.'","0","0","'.$enddate.'","'.$limitdate.'",cast( now() as date))';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$sql= 'UPDATE tusk SET id=lpad(No,5,0) where id=00000';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print 'タスク登録完了しました。<br/><br/>';
print 'ユーザーID：';
print $userid;
print '<br/>';
print 'ユーザー名：';
print $uname;
print '<br/><br/>';

print 'タスクID：';

$sql = 'SELECT * FROM tusk ORDER BY No DESC LIMIT 1';
foreach ($dbh->query($sql) as $row){
print $row['id'];
}

print '<br/>';
print 'タスク名：';
print $name;
print '<br/>';
print '公開範囲：';
print $view;
print '<br/>';
print '完了日　：';
print $enddate;
print '<br/>';
print '完了期限：';
print $limitdate;
print '<br/>';

$dbh = null;


?>
</body>
</html>
