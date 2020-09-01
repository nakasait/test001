<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク変更</title>
</head>
<body>
<font color="0000ff" size="6">タスク変更対象</font><br/><br/>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

//$open=$_POST['open'];
//$status=$_POST['status'];
$userid=$_POST['userid'];
$hid=$_POST['hid'];
//$name=$_POST['name'];

///////////////////////////////////////////////////////
//$hid=$_POST['hid'];

print '<form method="post" action="thenkou_ck.php">';

if($hid=="")
{ 
  print '変更するタスクIDを入力してください';
  print '</br></br>';
  print '<input type="button" onclick="history.back()" value="戻る">';
}
else
{
$sql= 'SELECT * FROM tusk where id="'.$hid.'"';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);
foreach ($dbh->query($sql) as $row){
//print $row['name'];
}

print 'タスクID　：';
print $row['id'];
//print $hid;
print ' ';
print $row['name'];
print '</br>';
print 'ステータス：';
//print $row['status'];

if ($row['status']=='0')
{print '進行中　　';}
if ($row['status']=='1')
{print '完了　　　';}
if ($row['status']=='2')
{print '期限切れ　';}
print '　';
print '<input type="radio" name="stat" value="0">進行中</label>';
print '<input type="radio" name="stat" value="1">完了</label>';
print '<input type="radio" name="stat" value="2">期限切れ</label>';
print '</br>';

print '完了日　　：';
print $row['enddate'];
print '　';
print '<input name="enddate" type="text" style="width:100px"></br>';

print '完了期限　：';
print $row['limitdate'];
print '　';
print '<input name="limitdate" type="text" style="width:100px"></br>';

print '</br></br>';
print '<input type="button" onclick="history.back()" value="戻る">';
print '  ';
print '<input type="submit" value="変更">';
print '</br>';
}

print '<input type="hidden" name="hid" value="'.$hid.'">';
//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="name" value="'.$name.'">';
//print '<input type="hidden" name="sql" value="'.$sql.'">';
//print '<input type="hidden" name="status" value="'.$status.'">';
//print '<input type="hidden" name="enddate" value="'.$enddate.'">';
//print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
