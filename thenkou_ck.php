<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク変更</title>
</head>
<body style="background-image: url(b1161.jpg);">
<div style="text-align:center">
<font color="000000" size="6">タスク変更対象</font><br/><br/>
</div>

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$dbh->beginTransaction();

$userid=$_POST['userid'];
//$uname=$_POST['uname'];
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
$sql= 'SELECT * FROM tusk where id="'.$hid.'"';
foreach ($dbh->query($sql) as $row){}

print '<h4>　　　　　　　　　　ユーザー　：';
print $row['userid'];
print '<br/><br/>';
print '<h4>　　　　　　　　　　タスクID　：';
print $hid;
print '</h4>';
print '<h4>　　　　　　　　　　タスク名　：';
print $row['name'];
print '</h4>';

$p1='';
$p2='';
$p3='';

$set="0";
if(($stat == "0") or ($stat == "1") or ($stat =="2")){
  $set="1";
}
//print $set;
//print $stat;
//ステータス未入力
if($set=="0")
//if($stat>'4')
{
//（ステータスは元の値）
  $p1=$row['status'];
  //print '</br>';
  print '<h4>　　　　　　　　　　ステータス：';
  //print $row['status'];
  // print $stat;
  //print '　';
  if ($row['status']=="0"){
    print '進行中　';}
  if ($row['status']=="1"){
    print '完了　　';}
  if ($row['status']=="2"){
    print '期限切れ';}

  print '</h4>';

//  print '</br>';
//  print '完了日　　：';
//  print $row['enddate'];
//  print '</br>';
//  print '完了期限　：';
//  print $row['limitdate'];
// print '</br>';
//}
//
//完了日未入力
//  完了日は本日
if(!$enddate)
  {
    $p2=date("Y-m-d");
    //print '<br/>';
    print '<h4>　　　　　　　　　　完了日　：';
    print $p2;
    print '</h4>';
  }
//完了日入力あり
//  完了日は入力値
else
  {
    $p2=$enddate;
    print '<h4>　　　　　　　　　　完了日　　：';
    print $enddate;
    print '</h4>';
  }
//完了期限未入力
if(!$limitdate)
//（完了期限は元の値）
  {
    $p3=$row['limitdate'];
    print '<h4>　　　　　　　　　　完了期限　：';
    print $row['limitdate'];
    print '<br/><br/>';
    print '　　　　　　　　　　このタスク情報を変更します。</h4><br/><br/>';
//    print '<br/><br/>';
    print '<div class="container">';
      print '<div style="text-align:center">';
        print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
        print '  ';
        print '<input type="submit" value="変更" class="btn print btn-primary btn-lg">';
      print '</div>'; 
    print '</div>'; 
  }
//完了期限入力あり
//完了期限入力値
else
  {
  $p3=$limitdate;
  print '<h4>　　　　　　　　　　完了期限　：';
  print $limitdate;
  print '<br/><br/>';
  print '　　　　　　　　　　このタスク情報を変更します。</h4><br/><br/>';
//  print '<br/><br/>';
  print '<div class="container">';
    print '<div style="text-align:center">';
      print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
      print '  ';
      print '<input type="submit" value="変更" class="btn btn-primary btn-lg>';
    print '</div>'; 
  print '</div>'; 
  }
}

//ステータス入力あり
else
//ステータスは入力値
  {
  $p1=$stat;
//  print '</br>';
  print '<h4>　　　　　　　　　　ステータス：';
  //print $stat;
//  print '　';
  if ($stat=="0"){
    print '進行中　';}
  if ($stat=="1"){
    print '完了　　';}
  if ($stat=="2"){
    print '期限切れ';}
  print '</h4>';
//  }
//}
//完了日未入力
  if(!$enddate)
//完了日は元の値 完了ならば今日
  {
    print '<h4>　　　　　　　　　　完了日　　：';
    if ($stat=="1")
    {
      $row['enddate']=date("Y-m-d");
    }
    $p2=$row['enddate'];
    print $row['enddate'];
    print '</h4>';
  }
  
//完了日入力あり
//完了日は入力値
  else
  {
    $p2=$enddate;
    //print '</br>';
    print '<h4>　　　　　　　　　　完了日　　：';
    print $enddate;
    print '</h4>';
  }
//完了期限未入力
  if(!$limitdate)
//完了期限は元の値
  {
  $p3=$row['limitdate'];
  //print '</br>';
  print '<h4>　　　　　　　　　　完了期限　：';
  print $row['limitdate'];
  print '<br/><br/>';
  print '　　　　　　　　　　このタスク情報を変更します。</h4><br/><br/>';
//  print '<br/><br/>';
  print '<div class="container">';
  print '<div style="text-align:center">';
  print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
  print '  ';
  print '<input type="submit" value="変更" class="btn print btn-primary btn-lg">';
  print '</div>';
  print '</div>';
  }
//完了期限入力あり
//完了期限は入力値
  else
  {
  $p3=$limitdate;
  print '<h4>　　　　　　　　　　完了期限　：';
  print $limitdate;
  print '<br/><br/>';
  print '　　　　　　　　　　このタスク情報を変更します。<h4><br/><br/>';
//  print '<br/><br/>';
print '<div class="container">';
  print '<div style="text-align:center">';
  print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
  print '  ';
  print '<input type="submit" value="変更" class="btn print btn-primary btn-lg">';
  print '<div>';
print '<div>';
}
}

$dbh->commit();

  print '<br/><br/>';
//$sql= 'UPDATE tusk SET status=$p1,enddate=$p2,limitdate=$p3 WHERE id=$id.';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<input type="hidden" name="userid" value="'.$userid.'">';
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
