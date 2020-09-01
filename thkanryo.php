<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー登録</title>
</head>
<body>

<?php
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$hid=$_POST['hid'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];
$p3=$_POST['p3'];


//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);

//print "$p1";
//print '<br/>';
//print "$p2";
//print '<br/>';
//print "$p3";
//print '<br/>';

$sql= 'UPDATE tusk SET status="'.$p1.'", enddate="'.$p2.'" ,limitdate="'.$p3.'" WHERE id="'.$hid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print 'タスク情報変更完了しました。<br/><br/>';
print 'ID：';

$sql = 'SELECT * FROM tusk WHERE id="'.$hid.'"';
foreach ($dbh->query($sql) as $row){
print $row['id'];
}

print '<br/>';
print 'タスク名：';
print $row['name'] ;
print '<br/>';
print 'ステータス：';
print $row['status'];
print '　';
  if ($row['status']=='0')
    print '進行中　';
  if ($row['status']=='1')
    print '完了　　';
  if ($row['status']=='2')
    print '期限切れ';
print '<br/>';
print '完了日　　：';
print $row['enddate'];
print '<br/>';
print '完了期限　：';
print $row['limitdate'];
print '<br/><br/>';

$dbh = null;


?>
</body>
</html>
