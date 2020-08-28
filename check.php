<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー登録</title>
</head>
<body>

<?php

$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES UTF-8');

$id=$_POST['id'];
$name=$_POST['name'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];

$name=htmlspecialchars($name);
$pass=htmlspecialchars($pass);
$pass2=htmlspecialchars($pass2);

//$sql= 'SELECT id,usersu+1 FROM kensu WHERE 1';
//$sql= 'SELECT * FROM kensu WHERE 1';
//$stmt = $dbh->prepare($sql);
//$stmt->execute();

//$rec = $stmt->fetch(PDO::FETCH_ASSOC);


if($name=='')
{
    print 'ユーザー名が入力されていません。<br/><br/>';
}
else
{

//    print 'ID：';
//    print $rec['usersu']+1 ;
//    print '<br/>';

    print '<br/>';
    print 'ユーザー名：';
    print $name ;
    print '<br/>' ;
    print '</form>';

}
if($pass=='')
{
    print 'パスワードが入力されていません。<br/><br/>';
}
else
{
    print 'パスワード：';
    print $pass ;
    print '<br/>' ;
}
if($pass==$pass2)
{
    print '<br/>' ;
}
else
{
    print '入力パスワードが一致しません。<br/>';
    print '<br/>' ;
}

if ($name==''||$pass=='')
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}
elseif($pass==$pass2)
{
    print 'このユーザーを登録します。<br/>';
    print '<form method="post" action="tkanryo.php">';
//    print '<input type="hidden" name="id" value="'.$id.'">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="pass" value="'.$pass.'">';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '  ';
    print '<input type="submit" value="登録">';
    print '</form>';
}
else
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '</form>';
}

//$dbh = null;

?>
</body>
</html>
