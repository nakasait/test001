<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク変更</title>
</head>
<body style="background-image: url(b1161.jpg);">
<div style="text-align:center">
<font color="000000" size="6">タスク削除対象</font><br/><br/>
</div>

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$sid=$_POST['sid'];
//$row=$_POST['row'];
//$open=$_POST['open'];
//$stat=$_POST['stat'];
$userid=$_POST['userid'];
//$uname=$_POST['uname'];
//$status=$_POST['status'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);


print '<form method="post" action="tskanryo_id.php">';

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

$sql= 'SELECT * FROM tusk where id="'.$sid.'"';
foreach ($dbh->query($sql) as $row)
{
}
print '<tbody>';
print '<tr class="bg-success">';
//print '<div class="container">';
//print '<th scope="row">1</th>';

print '<th>"'.$sid.'"</th>';
//print '　';
print '<th>"'.$row['name'].'"</th>';
//print '　';
print '<th>"'.$row['userid'].'"</th>';
//print '　';
//print '<td>"'.$row['status'].'"</td>';
  //print ' ';
if ($row['status']=='0')
{
  if ($row['enddate'] < date("Y-m-d") )
    {    
      $row['status'] = '2';
    }
}

  if ($row['status']=='0')
    print '<th>進行中</th>';
  if ($row['status']=='1'.'"</th>')
    print '<th>完了</th>';
  if ($row['status']=='2')
    print '<th>期限切れ</th>';
  //print '　';
//  print '完了日：';
  print '<th>"'.$row['enddate'].'"</th>';
  //print '　';
//  print '完了期限：';
  print '<th>"'.$row['limitdate'].'"</th>';
  //print '　';
//  print '登録日：';
  print '<th>"'.$row['insdate'].'"</th>';
  //print '　';
//  print '</div>';
print '</tbody>';
print '</table>';
print '</div>';

  print '<br/>';
  print '<div class="container">';
  print '<div style="text-align:center">';
  print '<h4>このタスク情報を削除します。</h4><br/>';
  print '</div>';
  print '</div>';

  print '<div class="container">';
    print '<div style="text-align:center">';
  print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
  btn-danger btn-lg">';
  print '　';
  print '<input type="submit" value="削除" class="btn btn-primary btn-lg">';
    print '</div>';
  print '</div>';

  print '<br/><br/>';
//$sql= 'UPDATE tusk SET status=$p1,enddate=$p2,limitdate=$p3 WHERE id=$id.';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<input type="hidden" name="userid" value="'.$userid.'">';
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
