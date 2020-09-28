<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一括削除</title>
</head>
<body style="background-image: url(b1161.jpg);">
<div style="text-align:center">
<font color="000000" size="6">タスク一括削除確認</font><br/><br/>
</div>
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

$dbh->beginTransaction();

$open=$_POST['open'];
$userid=$_POST['userid'];
//$uname=$_POST['uname'];
//$status=$_POST['status'];
//$enddate=$_POST['enddate'];
//$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);


print '<form method="post" action="tskanryoi_al.php">';

print '<div class="table-responsive-sm">';
  print '<table class="table table-striped table-sm">';
    print '<thead>';
      print '<tr>';
        print '<th scope="col">#</th>';
        print '<th scope="col">ID</th>';
        print '<th scope="col">タスク</th>';
        print '<th scope="col">ユーザー</th>';
        print '<th scope="col">ステータス</th>';
        print '<th scope="col">完了日</th>';
        print '<th scope="col">完了期限</th>';
        print '<th scope="col">登録日時</th>';
      print '</tr>';
    print '</thead>';


if($open=="全体")
{
    $sql= 'SELECT * FROM tusk where 1 LOCK IN SHARE MODE';
}

//個別
else
{
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and userid="'.$userid.'" LOCK IN SHARE MODE';
}


$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<br/>';
print '<div style="text-align:center">';
print '<h4>下記のタスク情報を一括削除します。</h4><br/>';
print '</div>';
//print $open;
//print '：';
//print $userid;
//print '　';
//print $uname;
//print '</br>';
print '</br>';

//$i=0;
$row=1;
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
    {
      print '<tbody>';
      print '<tr>';
      print '<div class="container">';
      print '<th scope="row">"'.$row.'"</th>';
      $row = $row + 1;
     //print '   ';
     print '<th>"'.$rec['id'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['name'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['userid'].'"</th>';
     //print ':    ';
//     }

//ログインユーザーIDで
    // $sql = 'SELECT * FROM user where userid="'.$rec['userid'].'"';
//     $sql = 'SELECT * FROM user where userid=$userid';
    // foreach ($dbh->query($sql) as $row){
    // //print $row['name'];
    // }
    // print $row['name'];
    // print ' ';
    if ($rec['status']=='0')
    {
      if ($rec['enddate'] < date("Y-m-d") )
        {    
          $rec['status'] = '2';
        }
    }

     if ($rec['status']=='0')
       print '<th>進行中　</th>';
     if ($rec['status']=='2')
       print '<th>期限切れ</th>';
     if ($rec['status']=='1')
       print '<th>完了　　</th>';
     //print '     ';
     print '<th>"'.$rec['enddate'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['limitdate'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['insdate'].'"</th>';
     //print '     ';
     //print '<br/>';
     print '</tr>';}
}
  print '</table>';
print '</div>';

  print '<br/>';
  print '<div class="container">';
  print '<div style="text-align:center">';
  print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
  btn-danger btn-lg">';
  print '　';
  print '<input type="submit" value="一括削除" class="btn btn-primary btn-lg">';
  print '</div>';
print '</div>';

print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '<input type="hidden" name="open" value="'.$open.'">';

print '</form>';

$dbh = null;
?>
</body>
</html>
