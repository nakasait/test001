<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<title>タスク変更</title>
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

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_SESSION['userid'];

print '<div class="container">';
  print '<div style="text-align:center">';
$i=0;
print '<form method="post" action="thenkou_sl.php">';
print '</br>';
if( $open ==''){
  print '<h4>公開範囲が選択されていません。</h4>';
  $i=1;
  print '</br>';
}

if( $stat ==''){
  print '<h4>ステータスが選択されていません。</h4>';
  $i=1;
  print '</br>';
}
print '</form>';

if($i==1){
  print '<form method="post" action="thenkou_mn.php">';
  print '<div class="button">';
    print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg">';
  print '</div>';
  print '</div>';
  print '</form>';
}

if($i==0){
$sql= 'SELECT * FROM tusk where 1';
//$sql= 'UPDATE tusk SET status=$status tusk WHERE 1' ;
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="thenkou_slbs.php">';

//全レコードのステータス更新→while文,select+update
while(1)
{
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  //データなし
  if($rec==false)
  {
  break;
  }
//  else
//  {
//  }
//削除済と完了読み飛ばし
  if($rec['sakujo']=='1')  
  {
  }
  else
  {
//******************************************************
//ステータス更新
// 今日が終了期限後ならば「期限切れ」
  if($rec['limitdate'] < date("Y-m-d")) 
  {
  $status = '2';
  }
  else
  {
  $status = '0';
  }
  if ($rec['limitdate']<1)
  {
  $status = '0';  
  }

//削除フラグ'2'ならば「完了」
  if($rec['sakujo']=='2')
  {
  $status = '1';
  }
//******************************************************
//print $rec['limitdate'];
//print '</br>';
//print date("Y-m-d");
//print '</br>';
//print $rec['id'];
//print '</br>';
//print $status;
//print '</br>';
  }

//$sql= 'UPDATE tusk SET status=$status tusk WHERE id="'.$rec['id'].'"' ;
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//foreach ($dbh->query($sql) as $row)
{
//print $row['name'];
}

}
print '</br>';
print '<h4>この条件で変更対象を出力します。</h4>';
print '</br>';
//print '公開種別　：'; 
//print $open; 
print '<div class="d-inline-flex p-1 bg-success text-white"><h4>公開種別　："'.$open.'"</h4></div>';
print '</br></br>';
//rint 'ユーザー　：'; 
//print $userid;
if($open!='全体') {
  print '<div class="d-inline-flex p-1 bg-success text-white"><h4>ユーザー　："'.$userid.'"</h4></div></br>';
}
  print '</br>';
//print 'ステータス：'; 
//print $stat; 
print '<div class="d-inline-flex p-1 bg-success text-white"><h4>ステータス："'.$stat.'"</h4></div>';
//print '</h4>';
print '<div>';
print '<div>';

print '</br></br></br>';
print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';
  print '<input type="submit" value="出力" class="btn btn-primary btn-lg">';
//  print '</div>';
  print '　';
//print '</br></br>';
//print '<form method="post" action="thenkou_mn.php">';
//print '<div class="button">';
  print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg">';
print '</div>';
print '</div>';
print '</form>';

}

print '<input type="hidden" name="open" value="'.$open.'">';
print '<input type="hidden" name="stat" value="'.$stat.'">';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//    print '<input type="hidden" name="id" value="'.$id.'">';

$dbh = null;

?>
</body>
</html>
