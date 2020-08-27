<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー変更</title>
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
//$name2=$_POST['name2'];
//$pass=$_POST['password'];
//$pass2=$_POST['pass2'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//print $userid;
//$sql= 'SELECT * FROM user WHERE userid = "$userid"';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();

print '<form method="post" action="skanryo.php">';

if($userid=='')
{
  print 'ユーザーIDを入力してください。<br/><br/>'; 
  print '<input type="button" onclick="history.back()" value="戻る">';

}

else
{
    print '</br>';
    print 'このユーザーを削除します。<br/>';
    print 'ユーザーID：';
    print $userid ;
    print '</br>';
    print 'ユーザー名：';
//    print $sql = 'SELECT * FROM user WHERE userid="'.$userid.'"';
//    print 'foreach ($dbh->query($sql) as $row)';
    print '</br>';
//    print $row['name'];
//print $sql= 'SELECT name FROM user WHERE userid="'.userid.'"';
//print $stmt = $dbh->prepare($sql);
//print $stmt->execute();

//print while(1)
//print {
//print   $rec = $stmt->fetch(PDO::FETCH_ASSOC);
//データなし
//print   if($rec==false)
//print   {
//print    break;
//print   }
//print   $rec['name'];
//print }
    print '</br>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print ' ';
    print '<input type="hidden" name="userid" value="'.$userid.'">';
//    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="submit" value="変更">';
}
print '</form>';

$dbh = null;

?>
</body>
</html>
