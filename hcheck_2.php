<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー変更</title>
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
$pass=$_POST['pass'];
//$name2=$_POST['name2'];
$pass2=$_POST['pass2'];

//$name=htmlspecialchars($name2);
//$pass=htmlspecialchars($pass2);

//$sql= 'SELECT * FROM kensu';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();
//$rec = $stmt->fetch(PDO::FETCH_ASSOC);

print '<form method="post" action="hkanryo.php">';
print 'ユーザー：';
print $userid ;
print '<br/>';

if ($name == '')
   $i=1;
elseif ($pass == '')
   $i=2;
else
   $i=3;

//ユーザー未入力
if($name=='')
 {
//
//パスワード未入力
  if($pass=='')
  {
    print '<br/>';
    print '変更内容が入力されていません。<br/><br/>';
  }
  else
  {
//////////////
//パスワード一致☆
  if($pass==$pass2) 
  {
    print '<br/>';
    print '新パスワード：';
    print $pass;
    $i=1;
    print '<br/><br/>';
    print 'このユーザーを変更します。<br/><br/>';
//    print '<form method="post" action="hkanryo.php">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="pass" value="'.$pass.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '  ';
    print '<input type="submit" value="変更">';
//    print '</form>';

  }
//パスワード一致しない
  else
  {
    print '<br/>' ;
    print '入力パスワードが一致しません。<br/>';

    print '<br/>' ;
//    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
//    print '</form>';

  }
//////////////
}
}
//ユーザー名入力あり☆
else
{
//パスワード一致
  if($pass==$pass2) 
  {
    print '<br/>';
//    print '新ユーザー名：';
//    print $name;
    print '<br/><br/>';
    print '新パスワード：';
    print $pass;
    print '<br/><br/>';
    print 'このユーザーを変更します。<br/><br/>';
//    print '<form method="post" action="hkanryo.php">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '  ';
    print '<input type="submit" value="変更">';
//    print '</form>';

  }
//パスワード不一致
  else
  {
    print '<br/>' ;
    print '入力パスワードが一致しません。<br/>';
    print '<br/>' ;
//    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
//    print '</form>';

  }
}

print '<input type="hidden" name="userid" value="'.$userid.'">';
print '<input type="hidden" name="name" value="'.$name.'">';
print '<input type="hidden" name="pass" value="'.$pass.'">';
print '</form>';

$dbh = null;


?>
</body>
</html>
