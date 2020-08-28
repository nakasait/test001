<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク一覧</title>
</head>
<body>
<font color="0000ff" size="6">タスク一覧</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');



$sql= 'SELECT * FROM tusk WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="ticheck.php">';
//print '<form method="post" action="ticheck.php">';


print '                     ';
print 'ID　　タスク　　　担当　　　ステータス　　登録日';
print '</br>';

while(1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
//データなし
  if($rec==false)
  {
   break;
  }
//削除
  if($rec['sakujo']=='1')
  {
  }
  else
  {
//削除なし
  if($rec['sakujo']=='0')
     {
     print '   ';
     print $rec['id'];
     print '     ';
     print $rec['name'];
     print '     ';
     print $rec['userid'];
//     $name = 'name';
     print '    ';
     }
  if($rec['sakujo'] == "2")
    {
     print '   ';
     print $rec['id'];
     print '     ';
     print $rec['name'];
     print '     ';
     print $rec['userid'];
//     $name = 'name';

      print '完了　　';
    }

  elseif($rec['enddate'] < date("y/m/d"))
  {
    print '期限切れ　';
  }
  else
  {
    print '進行中　　';
  }
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
