<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク登録</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$uname=$_POST['uname'];
$name=$_POST['name'];
$view=$_POST['view'];
//$view2=$_POST['view2'];
$enddate=$_POST['enddate'];
$limitdate=$_POST['limitdate'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//$sql= 'SELECT id,usersu+1 FROM kensu WHERE 1';
//$sql= 'SELECT * FROM kensu WHERE 1';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();

//$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$i=0;
print '<form method="post" action="ttkanryo.php">';

if($userid==null)
{
    print 'ユーザーIDが入力されていません。<br/><br/>';
    $i=1;
}
else
{
    print '<br/>';
    print 'ユーザーID：';
    print $userid ;
    print '<br/><br/>';

$sql = 'SELECT * FROM user where userid="'.$userid.'"';
foreach ($dbh->query($sql) as $row)
{
//print $row['name'];
}
    print 'ユーザー名：';
    print $row['name'];
    $uname=$row['name'];
    print '<br/>';
}
if($name==null)
{
    print 'タスク名が入力されていません。<br/><br/>';
    $i=1;
}

else
{
    print '<br/>';
    print 'タスク名：';
    print $name ;
    print '<br/><br/>';
}

if(isset($_POST['view'])=='全体')
//if($view=='public')
{
  print '公開範囲：';
  print '全体';
  print '<br/><br/>' ;
}
elseif(isset($_POST['view'])=='個人')
//elseif($view=='private')
 {   
    print '公開範囲：';
    print '個人';
    print '<br/><br/>' ;
 }
 else
 {
     print '<br/>' ;
     print '公開範囲が選択されていません。<br/>';
     $i=1;
 }

if($enddate=='')
{
//    print '<br/>' ;
    print '完了日が入力されていません。<br/>' ;
    $i=1;
}
else
{
    print '完了日　：';
    print $enddate;
    print '<br/>' ;
}
if($limitdate=='')
{
    print '<br/>' ;
    print '完了期限：未設定';
    print '<br/>' ;}
else
{
    print '<br/>' ;
    print '完了期限：';
    print $limitdate;
    print '<br/>' ;
}
if($i==1)
{
    print '<br/>' ;
    print '<input type="button" onclick="history.back()" value="戻る">';
}
else
{
    print '<br/>' ;
    print 'このタスクを登録します。<br/>';
    print '<br/>' ;
    print '<input type="hidden" name="userid" value="'.$userid.'">';
    print '<input type="hidden" name="uname" value="'.$uname.'">';
//    print '<input type="hidden" name="id" value="'.$id.'">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="view" value="'.$view.'">';
    print '<input type="hidden" name="enddate" value="'.$enddate.'">';
    print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';

    print '<input type="button" onclick="history.back()" value="戻る">';
    print '  ';
    print '<input type="submit" value="登録">';
//    print '</form>';
}
print '</form>';

$dbh = null;

?>
</body>
</html>
