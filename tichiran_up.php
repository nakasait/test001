<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク一覧</title>
</head>
<div style="text-align:center">
<body style="background-image: url(b1161.jpg);">
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
//$uname=$_POST['uname'];

$sql= 'SELECT * FROM tusk where 1';
//$sql= 'UPDATE tusk SET status=$status tusk WHERE 1' ;
$stmt = $dbh->prepare($sql);
$stmt->execute();


print '<form method="post" action="tichiran_sl.php">';
$i=0;
//抽出条件が選択されていません
if( $open == ''){
  print '<br/>';
  print '　　　　　　　　<h4>公開範囲が選択されていません</h4>';
  $i=1;
}

if( $stat == ''){
  print '<br/>';
  print '　　　　　　　　<h4>ステータスが選択されていません</h4>';
  $i=1;
}
if($i==1){
print '</br>';
print '<div class="container">';
  //print '<div style="text-align:center">';
print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
btn-danger btn-lg">';
  //print '</div>';
print '</div>';
exit;
}
//全レコードのステータス更新→while文,select+update
//$row = 1;
//while(1)
//{
//  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
//  //データなし
//  if($rec==false)
//  {
//  break;
//  }
//  else
//  {
//  }
////削除済と完了読み飛ばし
//  if($rec['sakujo']=='1')  
//  {
//  }
//  else
//  {
//******************************************************　不要
//ステータス更新
// 今日が完了日後ならば「期限切れ」
//  if($rec['enddate'] < date("Y-m-d")) 
//  {
//  $status = '2';
//  }
//  else
//  {
//  $status = '0';
//  }
//  //if ($rec['limitdate']<1)
//  //{
//  //$status = '0';  
 // //}
//削除フラグ'2'ならば「完了」
//  if($rec['sakujo']=='2')
//  {
//  $status = '1';
//  }
//******************************************************
//print $rec['limitdate'];
//print '</br>';
//print date("Y-m-d");
//print '</br>';
//print $rec['id'];
//print '</br>';
//print $status;
//print '</br>';
//if ($rec['status']=='0')
//{
//  if ($rec['enddate'] < date("Y-m-d") )
//    {    
//      $rec['status'] = '2';
//    }
//}

//}

//$sql= 'UPDATE tusk SET status=$status tusk WHERE id="'.$rec['id'].'"' ;
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//foreach ($dbh->query($sql) as $row)
{
//print $row['name'];
}

//}
print '</br>';
print '<h4>　　　　　　　　　■この条件でタスクの一覧を出力します。';
print '</br></br>';
print '　　　　　　　　　　公開範囲　：'; 
print $open; 
print '</br></br>';
IF($open!="全体")
{
  print '　　　　　　　　　　ユーザー　：'; 
  print $userid; 
  print '　'; 
  //print $uname; 
  print '</br></br>';
}
print '　　　　　　　　　　ステータス：'; 
print $stat;


print '</br></br>';
print '<div class="container">';
  print '<div style="text-align:center">';
print '<input type="button" onclick="history.back()" value="戻る" class="btn print 
btn-danger btn-lg">';
print '　';
print '<input type="submit" value="出力" class="btn btn-primary btn-lg">';
  print '</div>';
print '</div>';

print '<input type="hidden" name="open" value="'.$open.'">';
print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';



$dbh = null;

?>
</body>
</html>
