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

//$id=$_POST['id'];
$name=$_POST['name'];
$pass=$_POST['pass'];
$name=$_POST['name'];
$view=$_POST['view'];
$enddate=$_POST['enddate'];
$limitdate=$_POST['limitdate'];

$name=htmlspecialchars($name);
$pass=htmlspecialchars($pass);

//$sql= 'SELECT * FROM kensu';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$sql= 'INSERT INTO user (userid,name,password,shinko,sakujo,insdate) VALUES (0000,"'.$name.'","'.$pass.'",0,"0",cast( now() as date))';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$sql= 'UPDATE user SET userid=lpad(No,4,0) where userid=0000';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print 'ユーザー登録完了しました。<br/><br/>';
print 'ID：';

$sql = 'SELECT * FROM user ORDER BY No DESC LIMIT 1';
foreach ($dbh->query($sql) as $row){
print $row['userid'];
}

print '<br/>';
print 'ユーザー名：';
print $name ;
print '<br/>';
print 'パスワード：';
print $pass ;
print '<br/>';

//$sql= 'SELECT * FROM kensu';
//$sql= 'INSERT INTO user (userid,name,password,shinko,sakujo,insdate) VALUES (string(No),"'.$name.'","'.$pass.'",0,"0",cast( now() as date))';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$sql= 'UPDATE kensu SET usersu=usersu+1,todosu WHERE 1';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$sql= 'UPDATE user SET userid = string(5) WHERE 1';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();

$dbh = null;


?>
</body>
</html>
