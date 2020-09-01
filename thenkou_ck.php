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

$hid=$_POST['hid'];
//$name=$_POST['name'];
$stat=$_POST['stat'];
$enddate=$_POST['enddate'];
$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);

//$sql= 'SELECT * FROM kensu';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<form method="post" action="thkanryo.php">';
//print 'ユーザー：';
//print $userid;
//print '<br/>';
print 'タスクID：';
print $hid;
print '　';
$sql= 'SELECT * FROM tusk where id="'.$hid.'"';
foreach ($dbh->query($sql) as $row){}

print $row['name'];
print '<br/>';

$p1='';
$p2='';
$p3='';

//ステータス未入力
if($stat=='')
{
//（ステータスは元の値）
  $p1=$row['status'];
  print '</br>';
  print 'ステータス：';
  print $row['status'];
  print '　';
  if ($row['status']=='0')
    print '進行中　';
  if ($row['status']=='1')
    print '完了　　';
  if ($row['status']=='2')
    print '期限切れ';

//  print '</br>';
//  print '完了日　　：';
//  print $row['enddate'];
//  print '</br>';
//  print '完了期限　：';
//  print $row['limitdate'];
// print '</br>';
//}
//
//完了日未入力→エラー
  if($enddate=='')
  {
    print '<br/>';
    print '変更内容が入力されていません。<br/><br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';
  }
//完了日入力あり
//完了日は入力値
  else
  {
  $p2=$enddate;
//  print 'ステータス：';
//  print $row['status'];
  print '</br>';
  print '完了日　　：';
  print $enddate;
  print '</br>';
//  print '完了期限　：';
//  print $row['limitdate'];
//  print '</br>';
//  }
//完了期限未入力
  if($limitdate=='')
//（完了期限は元の値）
  {
    $p3=$row['limitdate'];
    print '完了期限　：';
    print $row['limitdate'];
    print '<br/><br/>';
    print 'このタスク情報を変更します。<br/><br/>';
    print '<br/><br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '  ';
    print '<input type="submit" value="変更">';
  }
//完了期限入力あり
//完了期限入力値
  else
  {
  $p3=$limitdate;
  print '完了期限　：';
  print $limitdate;
  print '</br>';
  print '<br/><br/>';
  print 'このタスク情報を変更します。<br/><br/>';
  print '<br/><br/>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="変更">';
  }
  }

//ステータス入力あり

}
else
//ステータスは入力値
  {
  $p1=$stat;
  print '</br>';
  print 'ステータス：';
  print $stat;
//  print $stat;
  print '　';
  if ($stat=='0')
    print '進行中　';
  if ($stat=='1')
    print '完了　　';
  if ($stat=='2')
    print '期限切れ';

//  }
//}
//完了日未入力
  if($enddate=='')
//完了日は元の値
  {
  $p2=$row['enddate'];
  print '</br>';
  print '完了日　　：';
  print $row['enddate'];
  }
//完了日入力あり
//完了日は入力値
  else
  {
  $p2=$enddate;
  print '</br>';
  print '完了日　　：';
  print $enddate;
  print '</br>';
  }
//完了期限未入力
  if($enddate=='')
//完了期限は元の値
  {
  $p3=$row['limitdate'];
  print '</br>';
  print '完了期限　：';
  print $row['limitdate'];
  print '<br/><br/>';
  print 'このタスク情報を変更します。<br/><br/>';
  print '<br/><br/>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="変更">';
  }
//完了期限入力あり
//完了期限は入力値
  else
  {
  $p3=$limitdate;
  print '完了期限　：';
  print $limitdate;
  print '<br/><br/>';
  print 'このタスク情報を変更します。<br/><br/>';
  print '<br/><br/>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '  ';
  print '<input type="submit" value="変更">';
  }
}

  print '<br/><br/>';
//$sql= 'UPDATE tusk SET status=$p1,enddate=$p2,limitdate=$p3 WHERE id=$id.';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '<input type="hidden" name="hid" value="'.$hid.'">';
//print '<input type="hidden" name="name" value="'.$name.'">';
//print '<input type="hidden" name="view" value="'.$view.'">';
//print '<input type="hidden" name="enddate" value="'.$enddate.'">';
//print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';
print '<input type="hidden" name="p1" value="'.$p1.'">';
print '<input type="hidden" name="p2" value="'.$p2.'">';
print '<input type="hidden" name="p3" value="'.$p3.'">';


print '</form>';

$dbh = null;
?>
</body>
</html>
