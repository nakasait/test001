<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一覧</title>
</head>
<body style="background-image: url(b1161.jpg);">
<div style="text-align:center">
<font color="000000" size="6">タスク一覧</font><br/><br/>
</div> 
<style>
    div.button{
    text-align: center;
    }
</style>
<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_POST['userid'];
//$uname=$_POST['uname'];

//$g1='view';
//$g2='stat';

$dbh->beginTransaction();

//$sql = 'SELECT status from tusk WHERE 1' ; 
//foreach ($dbh->query($sql) as $row){
//  if($row['status']=="0"){
//    if(($row['enddate'] < date("Y-m-d")){
//      $sql= 'UPDATE tusk SET status="2" WHERE 1 LOCK IN SHARE MODE' 
//      foreach ($dbh->query($sql) as $row1){
//      }
//    }
//  }
//}

if($open=="全体")
{
 if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where 1 LOCK IN SHARE MODE';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where (status="0") or (enddate > date("Y-m-d")) LOCK IN SHARE MODE';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where status="1" LOCK IN SHARE MODE';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where status="2" LOCK IN SHARE MODE';
  }

}
//個別
else
{
  if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="0" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="1" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="2" and userid="'.$userid.'" LOCK IN SHARE MODE';
  }
}


//$sql= 'SELECT * FROM tusk where 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//print '<form method="post" action="ticheck.php">';
print '<form method="post" action="mainmenu.php">';

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

print '<h4>　　　　　　　　　　■公開範囲　：';
print $open;
if($open=="個人"){
  print '：';
  print $userid;}
print '</br>';
print '　　　　　　　　　　■ステータス：';
print $stat;
print '</h4>';
//print '                     ';
//print 'ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
print '</br>';


$row = 1;
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
  print '<tbody>';
  print '<tr>';
  print '<div class="container">';
  print '<th scope="row">"'.$row.'"</th>';
  $row = $row + 1;

  // if ($rec['enddate'] >= date("Y-m-d") )
    {
     //print '   ';
     print '<th>"'.$rec['id'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['name'].'"</th>';
//     print mb_str_pad($rec['name'], 10);
     //print '     ';
     print '<th>"'.$rec['userid'].'"</th>';
     //print ':    ';

//ログインユーザーIDで
    // $sql = 'SELECT * FROM user where userid="'.$rec['userid'].'"';
//  //   $sql = 'SELECT * FROM user where userid=$userid';
    // foreach ($dbh->query($sql) as $row)
    // {
    // //print $row['name'];
    // }
    // print sprintf("%-20s",$row['name']);
    // print ' ';

    // if ($rec['status']=='0')
    // {
    //   if ($rec['enddate'] < date("Y-m-d") )
    //   {    
    //  $rec['status'] = '2';
    //   }
    // }

     //if ($rec['status']=='0')
     //  print '<th>進行中　</th>';
     //if ($rec['status']=='2')
     //  print '<th>期限切れ</th>';
     //if ($rec['status']=='1')
     //  print '<th>完了　　</th>';
     print '<th>"'.$stat.'"　　</th>';
     //print '     ';
     print '<th>"'.$rec['enddate'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['limitdate'].'"</th>';
     //print '     ';
     print '<th>"'.$rec['insdate'].'"</th>';
     //print '     ';
     //print '</br>';
     print '</tr>';
    }

}
print '</table>';
print '</div>';

$dbh->commit();


print '<div class="container">';
  print '<div style="text-align:center">';
//    print '<div class="button">';
print '<input type="submit" value="メインメニュー" class="btn btn-danger btn-lg">';
//    print '</div>';
  print '</div>';
print '</div>';


print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
