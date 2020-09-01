<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>パスワード変更</title>
</head>
<body>

<?php
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$name=$_POST['name'];
$pass=$_POST['pass'];
//$name2=$_POST['name2'];
//$pass2=$_POST['pass2'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);


//$sql= 'INSERT INTO user (userid,name,password,shinko,sakujo,insdate) VALUES (0000,"'.$name.'","'.$pass.'",0,"0",cast( now() as date))';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

if($pass!=' ')
$sql= 'UPDATE user SET password="'.$pass.'" where userid="'.$userid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//if($name!='')
//$sql= 'UPDATE user SET name="'.$name.'" where userid="'.$userid.'"';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//$sql = 'SELECT * FROM user where userid="$userid"';
//foreach ($dbh->query($sql) as $row);

//print '<br/>' ;
print 'パスワード変更完了しました。<br/><br/>';
print 'ID：';
print $userid;
print '<br/>';
//print 'ユーザー名：';
//print $name;
//print '<br/>';
print '新パスワード：';
print $pass ;
print '<br/>';


$dbh = null;


?>
</body>
</html>
