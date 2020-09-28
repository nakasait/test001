<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>ユーザー登録</title>
</head>
<body style="background-image: url(b1161.jpg);">
<style>
    div.button{
    text-align: center;
    }
</style>

<?php
session_start();


$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$hid=$_POST['hid'];
//$stat=$_POST['stat'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

$dbh->beginTransaction();

$sql= 'SELECT * from tusk WHERE id="'.$hid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$ver1 = $rec['insdate'];


$p1=$_POST['p1'];
$p2=$_POST['p2'];
$p3=$_POST['p3'];
$userid=$_POST['userid'];
//$uname=$_POST['uname'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);

//print "$p1";
//print '<br/>';
//print "$p2";
//print '<br/>';
//print "$p3";
//print '<br/>';

$sql= 'SELECT * from tusk WHERE id="'.$hid.'" for UPDATE';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$ver2 = $rec['insdate'];

$sql= 'UPDATE tusk SET status="'.$p1.'", enddate="'.$p2.'" ,limitdate="'.$p3.'" WHERE id="'.$hid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<form method="post" action="mainmenu.php">';
print '<br/>';

print '<h4>　　　　　　　　タスク情報変更完了しました。<br/><br/>';

$sql = 'SELECT * FROM tusk WHERE id="'.$hid.'"';
foreach ($dbh->query($sql) as $row){
}
print '<div class="container p-2 mb-2 bg-success text-white">';
print '<div style="text-align:left">';
print '　　　　　　　　ユーザー　：';
print $row['userid'] ;
print '<br/><br/>';
print '　　　　　　　　タスクID　：';
print $row['id'];
print '<br/>';
print '　　　　　　　　タスク名　：';
print $row['name'] ;
print '<br/>';
print '　　　　　　　　ステータス：';
//print $p1;
//print '　';
//  if ($row['status']=='0')
  if ($p1=='0')
    print '進行中　';
  if ($p1=='1')
    print '完了　　';
  if ($p1=='2')
    print '期限切れ';
print '<br/>';
print '　　　　　　　　完了日　　：';
print $p2;
print '<br/>';
print '　　　　　　　　完了期限　：';
print $p3;
print '</h4>';
print '</div>';
print '</div>';
print '<br/><br/>';
//print '<br/><br/>';

if($ver1==$ver2){
  $dbh->commit();
}else{
  $dbh->rollback();
}
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '<div class="container">';
  print '<div style="text-align:center">';
    print '<div class="button">';
print '<input type="submit" value="メインメニュー" class="btn btn-danger btn-lg">';
    print '</div>';
  print '</div>';
print '</div>';

print '</form>';

$dbh = null;

?>
</body>
</html>
