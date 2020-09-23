<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>タスク管理</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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


//$userid=$_POST['userid'];
$userid=$_SESSION['userid'];
//$pass=$_POST['pass'];
//$uname=$_POST['uname'];
$errmessage='';
//print '<font color="0000ff" size="6">ToDoリスト　タスク管理　メインメニュー</font><br/>';

//print '<style>';
//print '<div style="text-align:center">';
//print '</div>';
//print '</style>';

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
print '<div style="text-align:center">';
print '<h1>ToDoリスト　メインメニュー</h1>';
        if( $errmessage ){
          print '<div class="alert alert-danger" role="alert">';
          print implode( '<br>', $errmessage );
          print '</div>';
        }
print '<form method="post">';
print '<h2>処理を選択してください</h2>';
print '<br/>';
print '<form>';
print '<h2>ユーザーID：';
print $userid;
print '</h2><br/>';
//print 'ユーザー名：';
//print $uname;
print '</form>';

print '<a href="./logout.php" class="text-danger"><h2>ログアウトする</h2></a><br/>';

print '</div>';
print '</div>';

//<input type="button" onclick="location.href='ttouroku.php'" value="タスク登録">
//<br/><br/>
print '<div class="container">';
print '<div class="mx-auto" style="...">';
print '<form method="post" action="ttouroku.php">';
print '<div class="button">';
//print '<br/>';
print '<input type="submit" value="タスク登録" style="width:500px" class="btn btn-primary btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '</div>';
//print '</div>';
print '</form>';

//<input type="button" onclick="location.href='thenkou.php'" value="タスク変更">
//print '<br/><br/>';
print '<form method="post" action="thenkou_mn.php">';
//print '<div class="container">';
//print '<div class="mx-auto" style="...">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="タスク変更" style="width:500px" class="btn btn-primary btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '</div>';
//print '</div>';
print '</form>';

//<input type="button" onclick="location.href='tsakujo.php'" value="タスク削除">
//<br/><br/><br/>
print '<form method="post" action="tsakujo_mn.php">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="タスク削除" style="width:500px" class="btn btn-primary btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '</form>';

print '<form method="post" action="tsakujoi_mn.php">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="タスク一括削除" style="width:500px" class="btn btn-primary btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '<input type="hidden" name="view" value="'.$view.'">';
print '</form>';

//<input type="button" onclick="location.href='tichiran_mn.php'" value="タスク一覧">
//<br/><br/><br/>
print '<form method="post" action="tichiran_mn.php">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="タスク一覧" style="width:500px" class="btn btn-primary btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '</form><br/>';

//<input type="button" onclick="location.href='tichiran.php'" value="パスワード変更">
//<br/><br/>
print '<form method="post" action="changepw.php">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="パスワード変更" style="width:500px" class="btn btn-success btn-lg">';
print '</div>';
//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="pass" value="'.$pass.'">';
print '</form><br/>';

print '<form method="post" action="kanrichk.php">';
print '<div class="button">';
print '<br/>';
print '<input type="submit" value="ユーザー管理" style="width:500px" class="btn btn-danger btn-lg">';
print '</div>';
print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '</form><br/>';

//print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
print '</div>';
print '</div>';

$dbh = null;

?>
</body>
</html>
