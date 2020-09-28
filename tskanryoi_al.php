<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一括削除</title>
</head>
<body style="background-image: url(b1161.jpg);">

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
$open=$_POST['open'];
//$uname=$_POST['uname'];
//$view=$_POST['view'];
//$view2=$_POST['view2'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

$dbh->beginTransaction();

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//全体ならばすべてのレコードに削除フラグ１
//print $open;
print '<form method="post" action="mainmenu.php">';

print '<beginTransaction()>';


if ($open=="全体")
{
$sql= 'UPDATE tusk SET sakujo="1" WHERE view="'.$open.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '</br></br>';
print '<h4>　　　　　　　　タスク情報一括削除完了しました。<br/><br/>';
print '<br/><br/>';
print '　　　　　　　　削除対象：全体公開タスク</h4>';
}

if ($open=="個人")
{
$sql= 'UPDATE tusk SET sakujo="1" WHERE view="'.$open.'" and userid="'.$userid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '</br>';
print '<h4>　　　　　　　　タスク情報一括削除完了しました。<br/><br/>';
print '　　　　　　　　削除対象：個人公開タスク<br/><br/>　　　　　　　　';
print $userid;
print '　</h4>';
//print $uname;
}

print '</br>';
print '<div class="container">';
  print '<div style="text-align:center">';
    print '<div class="button">';
print '<input type="submit" value="メインメニュー" class="btn btn-danger btn-lg">';
    print '</div>';
  print '</div>';
print '</div>';

print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';

print '<commit()>';

$dbh = null;

?>
</body>
</html>
