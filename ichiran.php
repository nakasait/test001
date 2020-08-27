<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー一覧</title>
</head>
<body>
<font color="0000ff" size="6">ユーザー一覧</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');



$sql= 'SELECT * FROM user WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="hcheck2.php">';

print '                     ';
print 'ID　　ユーザー　登録日';
print '</br>';

while(1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
//データなし
  if($rec==false)
  {
   break;
  }
//削除なし
  if($rec['sakujo']=='0')
     {
     print '   ';
     print $rec['userid'];
     print '     ';
     print $rec['name'];
     $name = 'name';
     print '    ';
     print $rec['insdate'];
     print '     ';
     print '</br>';
     }

}

print '</br>';

print '</form>';


$dbh = null;

?>
</body>
</html>
