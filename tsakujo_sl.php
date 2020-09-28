<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク削除</title>
</head>
<body style="background-image: url(b1161.jpg);">
<br/>
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

$dbh->beginTransaction();

$open=$_POST['open'];
//$stat=$_POST['stat'];
$userid=$_POST['userid'];
//$sid=$_POST['sid'];
//$uname=$_POST['uname'];

print '<form method="post" action="tsakujo_ckid.php">';

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
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and userid="'.$userid.'" LOCK IN SHARE MODE' ;
}


$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);


//print $open;
//print '：';
//print $userid;
//print '　';
//print $uname;
//print '</br>';
//print '</br>';

//print '　　　 　';
//print '　　　　ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
//print 'ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
//print '</br>';

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
     print '<td>"'.$rec['id'].'"</td>';
     //print '     ';
     print '<td>"'.$rec['name'].'"</td>';
     //print '     ';
     print '<td>"'.$rec['userid'].'"</td>';
     //print ':    ';
//     }

//ログインユーザーIDで
     //$sql = 'SELECT * FROM user where userid="'.$rec['userid'].'"';
//     $sql = 'SELECT * FROM user where userid=$userid';
     //foreach ($dbh->query($sql) as $row){
     //print $row['name'];
     //}
     //print $row['name'];
     //print ' ';
     
     if ($rec['status']=='0')
     {
       if ($rec['enddate'] < date("Y-m-d") )
         {    
           $rec['status'] = '2';
         }
     }
     if ($rec['status']=='0'){
       print '<td>進行中　</td>';}
     if ($rec['status']=='2'){
       print '<td>期限切れ</td>';}
     if ($rec['status']=='1'){
       print '<td>完了　　</td>';}
     //print '     ';
     print '<td>"'.$rec['enddate'].'"</td>';
     //print '     ';
     print '<td>"'.$rec['limitdate'].'"</td>';
     //print '     ';
     print '<td>"'.$rec['insdate'].'"</td>';
     //print '     ';
     //print '</br>';
     print '</div>';
     print '</tr>';
     print '</tbody>';
     }

}
  print '</table>';
print '</div>';
//print '<input type="hidden" name="open" value="'.$open.'">';
//print '</form>';

print '</br>';
print '</br>';
print '<div class="container">';
  print '<div style="text-align:center">';
print '<h4>削除タスクID：';
print '<input name="sid" type="text" style="width:100px">';
print '　';
print '<input type="submit" value="削除" class="btn btn-primary btn-lg">';
print '</h4></br>';
//print '</br>';
//print '</br>';
//  print '<div style="text-align:center">';
print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
btn-danger btn-lg">';
  print '</div>';
print '</div>';

print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '<input type="hidden" name="row" value="'.$row.'">';

print '</form>';

$dbh->commit();

$dbh = null;

?>
</body>
</html>
