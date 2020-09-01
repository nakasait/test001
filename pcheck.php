<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>パスワード変更</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$userid=$_POST['userid'];
//$name=$_POST['name'];
//$name2=$_POST['name2'];
//$pass=$_POST['password'];
//$pass2=$_POST['pass2'];

//$name=htmlspecialchars($name);
//$pass=htmlspecialchars($pass);
//$pass2=htmlspecialchars($pass2);

//print $userid;
//$sql= 'SELECT * FROM user WHERE userid = "$userid"';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<form method="post" action="phcheck_2.php">';

if($userid=='')
{
  print 'ユーザーIDを入力してください。<br/><br/>'; 
//  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
//  print '</form>';
}


//  elseif($pass=='')
//  {
//    print '新パスワードを入力してください。<br/><br/>';
//  }
//else
//{
//    print '新パスワード：';
//    print $pass ;
//    print '<br/>' ;
//}
//if($pass==$pass2)
//{
//    print '<br/>' ;
//}
//else
//{
//    print '入力パスワードが一致しません。<br/>';
//    print '<br/>' ;
//}

//if ($name==''||$pass=='')
//{
//    print '<form>';
//    print '<input type="button" onclick="history.back()" value="戻る">';
//    print '</form>';
//}
//elseif($pass==$pass2)
//{
else
{
//    print '<form method="post" action="hkanryo.php">';
//    print $sql= 'SELECT * FROM user WHERE 1';
//    print $stmt = $dbh->prepare($sql);
//    print $stmt->execute();
$sql= 'SELECT * FROM user WHERE userid = "$userid"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

//if($rec['sakujo']=='1')
//{
//  print '削除済みユーザーです。<br/><br/>'; 
//}
//    print $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    print '</br>';
    print '変更内容を入力してください。<br/><br/>';
    print 'ユーザーID：';
    print $userid ;
    print '</br>';
//    print $sql = 'SELECT * FROM user WHERE userid = "$userid"';
//    print $sql = 'SELECT * FROM user';
//    print '</br>';
//    print 'foreach ($dbh->query($sql) as $row)';
//    print '</br>';
//    print '新ユーザー：';
//    print '<input name="name" type="text" style="width:200px">';;
//    print '</br>';
    print '</br>';
    print '新パスワード：';
    print '<input name="pass" type="text" style="width:50px">';
    print '</br>';
    print '新パスワード：';
    print '<input name="pass2" type="text" style="width:50px">';
    print'　(確認用）</br>';

    print '</br>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print ' ';

    print '<input type="hidden" name="userid" value="'.$userid.'">';
//    print '<input type="hidden" name="name" value="'.$name.'">';
//    print '<input type="hidden" name="pass" value="'.$pass.'">';
//    print '<input type="button" onclick="history.back()" value="戻る">';
//    print '  ';
    print '<input type="submit" value="変更">';
}
print '</form>';


$dbh = null;

?>
</body>
</html>
