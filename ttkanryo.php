<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク登録</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body style="background-image: url(b1161.jpg);">

<?php
session_start();
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$uname=$_POST['uname'];
//$name=$_POST['id'];
$name=$_POST['name'];
$view=$_POST['view'];
$enddate=$_POST['enddate'];
$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//トランザクション開始
$dbh->beginTransaction();
//ロック設定
//SELECT GET_LOCK('Lock1',100);
//$stmt = $dbh->prepare($sql);
//flock('tusk',LOCK_SH);

$link=mysqli_connect("localhost",$user,$password);

//$sql= 'INSERT INTO tusk (id,name,userid,view,status,sakujo,enddate,limitdate,insdate) VALUES (00000,"'.$name.'","'.$userid.'","'.$view.'","0","0","'.$enddate.'","'.$limitdate.'",cast( now() as date))';
$sql= 'INSERT INTO tusk (id,name,userid,view,status,sakujo,enddate,limitdate) VALUES (00000,"'.$name.'","'.$userid.'","'.$view.'","0","0","'.$enddate.'","'.$limitdate.'")';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
//トランザクションロールバック
if(mysqli_error($link)!=''){
    print 'sql error';
    $dbh->rollback();
    exit;
}

$sql= 'UPDATE tusk SET id=lpad(No,5,0) where id=00000';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
//トランザクションロールバック
if(mysqli_error($link)!=''){
    print 'sql error';
    $dbh->rollback();
    exit;
}
//ロック解除
//echo '<SELECT RELEASE_LOCK('Lock1')>';
//$stmt = $dbh->prepare($sql);
//flock('tusk',LOCK_UN);  
  //トランザクション コミット 
$dbh->commit();

print '<div class="container">';
  print '<div style="text-align:center" >';
    print '<form method="post" action="mainmenu.php">';
    print '<br/>';
    print '<h3>タスク登録完了しました。<br/><br/>';
    print '<div class="text-primary">';
      print 'ユーザーID：';
      print $userid;
      print '</h3><br/>';
    print '</div>';    
//print '</div>';    
//print '<h3>ユーザー名：';
//print $uname;
//print '<br/><br/>';
print '<div class="text-primary">';
//print '<div style="text-align:center" >';
print '<h3>　　　　　　　　　　タスクID：';


$sql = 'SELECT * FROM tusk ORDER BY No DESC LIMIT 1';
foreach ($dbh->query($sql) as $row){
print $row['id'];
}
//print '<div class="text-primary">';
print '<br/>';
print '　　　　　　　　　　タスク名：';
print $name;
print '<br/>';
print '　　　　　　　　　　公開範囲：';
print $view;
print '<br/>';
print '　　　　　　　　　　完了日　：';
print $enddate;
print '<br/>';
print '　　　　　　　　　　完了期限：';
if($limitdate!=""){
  print $limitdate;
}
else{
  print "0000-00-00";
}

print '</h3><br/><br/>';
//  print '</div>';
//  print '</div>';    
print '</div>';    

print '<div class="container">';
  print '<div style="text-align:center">';
    print '<div class="button">';
      print '<input type="submit" value="メインメニュー" class="btn btn-danger btn-lg">';
    print '</div>';
  print '</div>';
print '</div>';
//print '</form>';

//print '<br/>' ;
//print '<input type="button" onclick="history.back()" value="戻る">';

print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';

print '</form>';

$dbh = null;

?>
</body>
</html>
