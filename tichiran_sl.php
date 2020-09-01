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

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_POST['userid'];

//$g1='view';
//$g2='stat';

if($open=="全体")
{
 if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where 1 LOCK IN SHARE MODE';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where status="0" LOCK IN SHARE MODE';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where status="1" LOCK IN SHARE MODE';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where status="2" LOCK IN SHARE MODE';
  }

}
//個別
else
{
  if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="0" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="1" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="2" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
}

//ユーザーIDが抜けてる


//$sql= 'SELECT * FROM tusk where 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//print '<form method="post" action="ticheck.php">';
print '<form method="post">';

print $open;
print '：';
print $userid;
print '</br>';
print $stat;
print '</br></br>';
//print '                     ';
print 'ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
print '</br>';

print '<beginTransaction()>';


while(1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
//データなし
  if($rec==false)
  {
   break;
  }
//削除済
  if($rec['sakujo']=='1')
  {
  }
//削除なし
  else
//  {
//  if($rec['sakujo']=='0')
     {
     print '   ';
     print $rec['id'];
     print '     ';
     print $rec['name'];
     print '     ';
     print $rec['userid'];
     print ':    ';

//ログインユーザーIDで
     $sql = 'SELECT * FROM user where userid="'.$rec['userid'].'"';
//     $sql = 'SELECT * FROM user where userid=$userid';
     foreach ($dbh->query($sql) as $row)
     {
     //print $row['name'];
     }
     print $row['name'];
     print ' ';

     if ($rec['status']=='0')
       print '進行中';
     if ($rec['status']=='2')
       print '期限切れ';
     if ($rec['status']=='1')
       print '完了';
     print '     ';
     print $rec['enddate'];
     print '     ';
     print $rec['limitdate'];
     print '     ';
     print $rec['insdate'];
     print '     ';
     print '</br>';
     }

}

print '<commit()>';

print '</form>';


$dbh = null;

?>
</body>
</html>
