<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>タスク登録</title>
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
//$dsn = 'mysql:dbname=todo;host=localhost';
//$user = 'root';
//$password = '';
//$dbh = new PDO($dsn,$user,$password);
//$dbh->query('SET NAMES UTF-8');

//$userid=$_POST['userid'];
$userid=$_SESSION['userid'];

//$uname=$_POST['uname'];
//$view=$_POST['view'];
print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';
//時計のアイコン
print '<svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
print '<path fill-rule="evenodd" d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>';
print '</svg>';
print '<br/><br/>';
//print '</div>';
//print '</div>';


print '<font color="000000" size="6">タスク登録</font>';
print '<br/><br/>';
//print '</div>';
//print '</div>';

print '<form method="post" action="ttcheck.php">';

print '<div class="container">';
  print '<div class="mx-auto" style="...">';
  //print '<form>';
  print '<h4>ユーザーID：';
  print $userid;
  print '</h4><br/>';
  //print '</form>';

  //print 'ユーザー名　';
  //print $uname;
  print '<br/>';
  //print '<input name="userid" type="text" style="width:50px"><br/><br/>';
  print '</div>';
print '</div>';

//print '<form>';
print '<h4>タスク名</h4>';
print '<input name="name" type="text" class="form-control"><br/><br/>';


print '<h4>公開範囲　<br/><br/></h4>';

print '</label><h4>全体<input name="view" type="radio" value="全体" class="form-control"></h4></label>';
print '　';
print '</label><h4>個人<input name="view" type="radio" value="個人" class="form-control"></h4></label>';

print '<h4>（どちらかを選択）</h4>';
print '<br/><br/>';

print '<h4>完了日</h4>';
print '<input name="enddate" type="date" class="form-control"><br/><br/>';

print '<h4>完了期限</h4>';
print '<input name="limitdate" type="date" class="form-control">';
print '<h4>（任意）</h4>';
print '<br/><br/>';

print '</div>';
print '</div>';
//print '</form>';

//print '</form>';

//print '<form method="post" action="ttcheck.php">';
print '<div class="button">';
  print '<input type="hidden" name="userid" value="'.$userid.'">';
  print '<input type="submit" value="登録" class="btn btn-primary btn-lg">';
print '</div>';

print '</form>';
print '<br/><br/>';

print '<form method="post" action="mainmenu.php">';
print '<div class="button">';
  print '<input type="submit" value="メインメニュー"  class="btn btn-danger btn-lg">';
print '</div>';
print '</form>';

?>
</body>
</html>
