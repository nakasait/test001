<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク削除</title>
</head>
<body style="background-image: url(b1161.jpg);">

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$dbh->beginTransaction();

$sid=$_POST['sid'];
$userid=$_POST['userid'];

$sql= 'SELECT * from tusk WHERE id="'.$sid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$ver1 = $rec['insdate'];
//$uname=$_POST['uname'];
//$name=$_POST['name'];
//$view=$_POST['view'];
//$view2=$_POST['view2'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//排他制御
$sql= 'SELECT * from tusk WHERE id="'.$sid.'" for UPDATE';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$ver2 = $rec['insdate'];

$sql= 'UPDATE tusk SET sakujo="1" WHERE id="'.$sid.'"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
print '<form method="post" action="mainmenu.php">';

//beginTransaction();

print '<br/>';
print '<div style="text-align:center">';
print '<h4>タスク情報削除完了しました。</h4><br/>';
print '</div>';
//print $userid;
//print '　';
//print $uname;
//print '<br/><br/>';
//print 'ID　　　タスク　ユーザー　ステータス　 完了日　　完了期限　　登録日';
//print '<br/><br/>';
//print 'ID：';

print '<div class="table-responsive-sm">';
  print '<table class="table table-striped table-sm">';
    print '<thead>';
      print '<tr>';
//        print '<th scope="col">#</th>';
        print '<th scope="col">ID</th>';
        print '<th scope="col">タスク</th>';
        print '<th scope="col">ユーザー</th>';
        print '<th scope="col">ステータス</th>';
        print '<th scope="col">完了日</th>';
        print '<th scope="col">完了期限</th>';
        print '<th scope="col">登録日時</th>';
      print '</tr>';
    print '</thead>';

$sql = 'SELECT * FROM tusk WHERE id="'.$sid.'"';
foreach ($dbh->query($sql) as $row){
}
print '<tbody>';
  print '<tr class="bg-success">';
//print '　';
print '<th>"'.$row['id'].'"</th>';

print '<th>"'.$row['name'].'"</th>' ;
//print '　';
print '<th>"'.$row['userid'].'"</th>';
//print ' ';
if ($row['status']=='0')
{
  if ($row['enddate'] < date("Y-m-d") )
    {    
      $row['status'] = '2';
    }
}

if($ver1==$ver2){
  $dbh->commit();
}else{
  $dbh->rollback();
}
  if ($row['status']=='0')
    print '<th>進行中</th>';
  if ($row['status']=='1')
    print '<th>完了</th>';
  if ($row['status']=='2')
    print '<th>期限切れ</th>';
//print '　';
print '<th>"'.$row['enddate'].'"</th>';
//print '　';
print '<th>"'.$row['limitdate'].'"</th>';
//print '　';
print '<th>"'.$row['insdate'].'"</th>';
print '<br/><br/>';
      print '</tr>';
    print '</tbody>';
  print '</table>';
print '</div>';
print '<br/>';
//print '<br/><br/>';
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
//commit();

print '<rollBack()>';
$dbh = null;

?>
</body>
</html>
