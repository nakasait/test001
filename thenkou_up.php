<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク変更</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$open=$_POST['open'];
$stat=$_POST['stat'];
$userid=$_POST['userid'];

$sql= 'SELECT * FROM tusk where 1';
//$sql= 'UPDATE tusk SET status=$status tusk WHERE 1' ;
$stmt = $dbh->prepare($sql);
$stmt->execute();

print '<form method="post" action="thenkou_sl.php">';

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
print 'この条件で変更対象を出力します。';
print '</br></br>';
print '公開種別　：'; 
print $open; 
print '</br></br>';
print 'ユーザー　：'; 
print $userid; 
print '</br></br>';
print 'ステータス：'; 
print $stat; 

    print '<input type="hidden" name="open" value="'.$open.'">';
    print '<input type="hidden" name="stat" value="'.$stat.'">';
    print '<input type="hidden" name="userid" value="'.$userid.'">';
//    print '<input type="hidden" name="id" value="'.$id.'">';

print '</br></br>';
print '<input type="button" onclick="history.back()" value="戻る">';
print ' ';
//print '</br></br>';
print '<input type="submit" value="出力">';
print '</form>';


//抽出条件が選択されていません..... がない

$dbh = null;

?>
</body>
</html>
