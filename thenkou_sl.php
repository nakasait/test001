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

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_POST['userid'];

print '<form method="post" action="thenkou_sl2.php">';

if($open=="全体")
{
 if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where 1';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where status="0"';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where status="1"';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where status="2"';
  }

}
//個別
else
{
  if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and userid="'.$userid.'"';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="0" and userid="'.$userid.'"';
  }
  elseif($stat=="完了")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="1" and userid="'.$userid.'"';
  }
  elseif($stat=="期限切れ")
  {
    $sql= 'SELECT * FROM tusk where view="'.$open.'" and status="2" and userid="'.$userid.'"';
  }
}

//ユーザーIDが抜けてる


//$sql= 'SELECT * FROM tusk where 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
//  print '<div style="text-align:center">';

print '<h4>　　　公開種別　：';
print $open;
print '　';
if( $open=='個人') {
  print $userid;
}
print '</br>';
print '　　　ステータス：';
print $stat;
print '</h4>';
//  print '</div>';
print '</div>';
print '</br>';
//print '                     ';
//print '　　　　ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
print '　　　　　　ID　　タスク　　ユーザー　　　ステータス　 終了日　　完了期限　　登録日';
print '</br>';
$i=0;
while($i=1)
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
//     print '<input type="radio" name="henkou" value="変更">変更</label>';
//     print "henkou";
//     if('henkou'=="変更")
//     {
//     ++$i;
//     print $i;
//     }
print '<div class="container">';
     print '　　　　';
     print $rec['id'];
     print '     ';
     print $rec['name'];
     print '     ';
     print $rec['userid'];
     print '    ';

//ログインユーザーIDで
     //$sql = 'SELECT * FROM user where userid="'.$rec['userid'].'"';
//     $sql = 'SELECT * FROM user where userid=$userid';
     //foreach ($dbh->query($sql) as $row){
     //print $row['name'];
     //}
     //print $row['name'];
     //print ' ';
     //$uname=$row['name'];

     //ステータス書き換え***********************
     //"進行中"0で、完了日＞今日なら"期限切れ"2
     if ($rec['status']=='0')
       if ($rec['enddate'] < date("Y/m/d") )
          $rec['status'] = '2';

     if ($rec['status']=='0')
       print '進行中　';
     if ($rec['status']=='2')
       print '期限切れ';
     if ($rec['status']=='1')
       print '完了　　';
     print '     ';
     print $rec['enddate'];
     print '     ';
     print $rec['limitdate'];
     print '     ';
     print $rec['insdate'];
     print '     ';
     print '</br>';
     print '</div>';
     }

}
print '<input type="hidden" name="open" value="'.$open.'">';
//print '</form>';

print '</br>';

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';

print '<h4>変更タスクID：';
print '<input name="hid" type="text" style="width:100px"></h4>';
print '</br>';
print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg">';
print '　';

print '<input type="submit" value="変更" class="btn btn-primary btn-lg">';

print '</div>';
print '</div>';
print '</br>';
//print '<input type="hidden" name="status" value="'.$status.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';


$dbh = null;

?>
</body>
</html>
