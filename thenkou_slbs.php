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

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_POST['userid'];

print '<form method="post" action="thenkou_sl2.php">';

$dbh->beginTransaction();

if($open=="全体")
{
 if($stat=="すべて")
  {
    $sql= 'SELECT * FROM tusk where 1 LOCK IN SHARE MODE';
  }
  elseif($stat=="進行中")
  {
    $sql= 'SELECT * FROM tusk where status="0" LOCK IN SHARE MODE';
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

$stmt = $dbh->prepare($sql);
$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<div class="container">';

print '<h4>　　　　　　　　公開種別　：';
print $open;
print '　';
if( $open=='個人') {
  print $userid;
}
print '</br>';
print '　　　　　　　　ステータス：';
print $stat;
print '</h4>';
//  print '</div>';
print '</div>';
//print '</br>';
//print '                     ';

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

  $i=0;
  $row = 1;
    while($i=1)
    {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      //データなし
        if($rec==false)
        {
        $i=1; 
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
           print '<td>"'.$rec['id'].'"</td>';
           print '<td>"'.$rec['name'].'"</td>';
           print '<td>"'.$rec['userid'].'"</td>';
      
           if ($rec['status']=='0')
           {
             if ($rec['enddate'] < date("Y-m-d") )
             {    
                 $rec['status'] = '2';
             }
             else
             {
               print '<td>進行中　</td>';
             }
            }
            if ($rec['status']=='2')
            {
             print '<td>期限切れ</td>';
            }
            if ($rec['status']=='1')
            {
             print '<td>完了　　</td>';
            }

           print '<td>"'.$rec['enddate'].'"</td>';
           print '<td>"'.$rec['limitdate'].'"</td>';
           print '<td>"'.$rec['insdate'].'"</td>';
           print '</div>';
           print '</tr>';
           }
         //print '</tbody>';        
        }
        //print '</tr>';
      print '</tbody>';
    print '</table>';
print '</div>';

print '</br>';

$dbh->commit();

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
