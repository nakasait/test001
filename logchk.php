<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ログイン</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
$pass=$_POST['pass'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//$sql= 'SELECT * FROM user WHERE userid="'.userid.'"';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<form method="post" action="index.html">';

if($userid=='')
{
    print 'ユーザーIDが入力されていません。<br/><br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';

}
else
{
    print 'ユーザーID：';
    print $userid ;
    print '<br/><br/>' ;


if($pass=='')
{
    print 'パスワードが入力されていません。<br/><br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';

}
else
 {
    print 'パスワード：';
    print '****' ;
    print '<br/><br/>' ;
 }
}

//$result = mysqli_query("SELECT * FROM user WHERE userid = $userid");
//$count = mysql_num_rows($result);

$sql= 'SELECT * FROM user WHERE userid="'.$userid.'"';
$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);
foreach ($dbh->query($sql) as $row)
//{
//print $row['userid'];
//};

//データ
if($row['password'] != $pass)
{
print 'IDまたはパスワードが一致しません。<br/><br/>';
print '<input type="button" onclick="history.back()" value="戻る">';
print ' ';

}
//データ
else
{
 if($row['sakujo'] == "1")
 {
  print '削除されたユーザーです。<br/><br/>';
  print '<input type="button" onclick="history.back()" value="戻る">';

 }
 else
 {
  print 'ユーザー：';
  print $row['name'];
  print '<br/><br/>';
  print 'ログインしました。<br/><br/>';
  print '<input type="submit" value="メインメニュー">';
 }
}

//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>'; 

$dbh = null;

?>

</body>
</html>
