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

$link=mysqli_connect("localhost",$user,$password);

$open=$_POST['open'];
//$status=$_POST['status'];
$userid=$_POST['userid'];
//$uname=$_POST['uname'];
$hid=$_POST['hid'];
//$name=$_POST['name'];
$stat=" ";
$row="";

//$hid=$_POST['hid'];

print '<form method="post" action="thenkou_ck.php">';

if($hid=="")
{ 
  print '<div class="container">';
  //print '<div class="mx-auto" style="...">';
    print '<div style="text-align:center">';
  
  print '<h4>変更するタスクIDを入力してください';
  print '<br/><br/>';
  //print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg"></h4>';
  print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
  print '</div>';
  print '</div>';
  exit;
}
//ステータスも必要（すべて以外）
//$sql= 'SELECT * FROM tusk where id="'.$hid.'" ';

//if($stat=='すべて')
//{
  $sql= 'SELECT * FROM tusk where id="'.$hid.'" and view="'.$open.'" and sakujo="0"';
//}
//else{
//  $sql= 'SELECT * FROM tusk where id="'.$hid.'" and view="'.$open.'" and status="'.$status.'" and sakujo="0"';
//}

foreach ($dbh->query($sql) as $row){
}

//トランザクションロールバック
if(mysqli_error($link)!=''){
  print 'sql error';
  $dbh->rollback();
  exit;
}

if($row==false){
    print '<h4>　　変更するタスクがありません</h4><br/>';
    print '<div class="container">';
    //print '<div class="mx-auto" style="...">';
      print '<div style="text-align:center">';
    
    print '</br></br>';
    print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
      print '</div>';
    print '</div>';
    
    $dbh->rollback();
  exit;
}

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
//  print '<div style="text-align:center">';

print '<h4>　　　　　タスクID　：';
print $row['id'];
//print $hid;
print '<br/><br/>';
print '　　　　　タスク名　：';
print $row['name'];
print '<br/><br/>';
print '　　　　　ステータス：';

//if ($row['status']=='0')
//{
//  if ($row['enddate'] < date("Y-m-d") )
//  {    
//      $row['status'] = '2';
//  }
//}
//$stat=$row['status'];

if ($row['status']=='0')
{print '進行中　　';}
if ($row['status']=='1')
{print '完了　　　';}
if ($row['status']=='2')
{print '期限切れ　';}
print '<br/><br/>';
//変更後選択
print '　　　　　変更後選択：';
print '<input type="radio" name="stat" value="0"><label>進行中 </label>';
print '　';
print '<input type="radio" name="stat" value="1"><label>完了 </label>';
print '　';
print '<input type="radio" name="stat" value="2"><label>期限切れ </label>';
//print $stat;
//print '<input type="submit">';
print '<br/><br/>';
//if($stat=="進行中"){$row['status']="0";}
//if($stat=="完了"){$status="1";}
//if($stat=="期限切れ"){$status="2";}

print '　　　　　完了日　　：';
print $row['enddate'];
print '　';
print '<input name="enddate" type="date" style="width:200px"></br></br>';

print '　　　　　完了期限　：';
print $row['limitdate'];
print '　';
print '<input name="limitdate" type="date" style="width:200px"></br>';
print '</h4>';
print '</div>';

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';

  print '</br></br>';
  print '<a button type="button" href="mainmenu.php" class="btn print btn-danger btn-lg">戻る</button></a>';
  print '  ';
  print '<input type="submit" value="変更" class="btn print btn-primary btn-lg">';
  print '</br>';
  print '</div>';
print '</div>';
//}

print '<input type="hidden" name="hid" value="'.$hid.'">';
//print '<input type="hidden" name="open" value="'.$open.'">';
//print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '<input type="hidden" name="sql" value="'.$sql.'">';
//print '<input type="hidden" name="status" value="'.$status.'">';
//print '<input type="hidden" name="enddate" value="'.$enddate.'">';
//print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';

print '</form>';

$dbh->commit();

$dbh = null;

?>
</body>
</html>
