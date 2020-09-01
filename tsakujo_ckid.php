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

$sid=$_POST['sid'];
//$open=$_POST['open'];
//$stat=$_POST['stat'];
$userid=$_POST['userid'];
//$name=$_POST['name'];
//$status=$_POST['status'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);


print '<form method="post" action="tskanryo_id.php">';

print 'ID　　　タスク　　ユーザー　ステータス　 完了日　　完了期限　　登録日';
print '<br/><br/>';

$sql= 'SELECT * FROM tusk where id="'.$sid.'"';
foreach ($dbh->query($sql) as $row)
{
}
print $sid;
print '　';
print $row['name'];
print '　';
print $row['userid'];
print '　';
  print $row['status'];
  print ' ';
  if ($row['status']=='0')
    print '進行中';
  if ($row['status']=='1')
    print '完了';
  if ($row['status']=='2')
    print '期限切れ';
  print '　';
//  print '完了日：';
  print $row['enddate'];
  print '　';
//  print '完了期限：';
  print $row['limitdate'];
  print '　';
//  print '登録日：';
  print $row['insdate'];
  print '　';
  print '<br/><br/>';
  print 'このタスク情報を削除します。<br/><br/>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="削除">';


  print '<br/><br/>';
//$sql= 'UPDATE tusk SET status=$p1,enddate=$p2,limitdate=$p3 WHERE id=$id.';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '<input type="hidden" name="sid" value="'.$sid.'">';
//print '<input type="hidden" name="name" value="'.$name.'">';
//print '<input type="hidden" name="view" value="'.$view.'">';
//print '<input type="hidden" name="enddate" value="'.$enddate.'">';
//print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';

print '</form>';

$dbh = null;
?>
</body>
</html>
