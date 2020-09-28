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

print '<div class="container">';
//print '<div class="mx-auto" style="...">';
  print '<div style="text-align:center">';
//時計のアイコン
print '<svg width="5em" height="5em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
print '<path fill-rule="evenodd" d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>';
print '</svg>';
print '<br/><br/>';
  //print '<br/>';
  //print '<h3>ユーザーID：';
  //print $userid ;
  //print '</h3><br/>';
  print '<div class="d-inline-flex p-1 bg-success text-white"><h3>ユーザーID："'.$userid.'"</h3></div>';
  //print 'ユーザー名：';
  //print $uname;
  print '<br/><br/>';
//  print '</div>';
//print '</div>';

if($name==null)
{
    print '<h4>タスク名が入力されていません。</h4><br/><br/>';
    $i=1;
}

else if ( strlen($name) > 41 ){
    print '<h4>タスク名は全角20文字・半角40文字以内に入力してください。</h4>';
    print '<br/><br/>';
    $i=1;
}
else {
    //print '<br/>';
    //print '<h3>タスク名：';
    //print $name ;
    //print '</h3>';
    //print '</h3><br/>';
    print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>タスク名："'.$name.'"</h3></div>';
    print '<br/><br/>';
}
//  print $view;
//if(isset($_POST['view'])=='全体')
if($view=='全体')
{
//print $view;
//print isset($view);
  //print '<h3>公開範囲：';
  //print '全体</h3>';
  print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>公開範囲："'.$view.'"</h3></div>';
  print '<br/><br/>';
}
//elseif(isset($_POST['view'])=='個人')
elseif($view=='個人')
 {   
    //print '<h3>公開範囲：';
    //print '個人</h3>';
    print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>公開範囲："'.$view.'"</h3></div>';
    print '<br/><br/>' ;
 }
 else
 {
//     print '<br/>' ;
     print '<h4>公開範囲が選択されていません。</h4><br/><br/>';
     $view=' ';
     $i=1;
 }

if($enddate=='')
{
//    print '<br/>' ;
    print $enddate='';
    print '<h4>完了日が入力されていません。</h4><br/>' ;
    $i=1;
}
else
{
    //print '<h3>完了日：';
    //print $enddate;
    //print '</h3>' ;
    print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>完了日："'.$enddate.'"</h3></div>';
    print '<br/>' ;

}
if($limitdate=='')
{
    print '<br/>' ;
    //print '<h3>完了期限：未設定</h3>';
    print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>完了期限：未設定</h3></div>';
    print '<br/>' ;
}
    else
{
    print '<br/>' ;
    //print '<h3>完了期限：';
    //print $limitdate;
    //print '</h3><br/>' ;
    //print '<span class="d-block p-2 bg-primary text-white"><h3>完了期限："'.$limitdate.'"</h3></span>';
    //print '<br/>' ;
    print '<div class="d-inline-flex p-1 bg-primary text-white"><h3>完了期限："'.$limitdate.'"</h3></div>';
    print '<br/>' ;
}
 
if($i==1)
{
    print '<br/>' ;
    print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg">';
}
else
{
    print '<br/>' ;
    print '<h3>※このタスクを登録します。</h3><br/>';
    print '<br/>' ;
    print '<input type="button" onclick="history.back()" value="戻る" class="btn btn-danger btn-lg">';
    print '  ';
    print '<input type="submit" value="登録" class="btn btn-primary btn-lg">';
    
    //print '</form>';
}
  print '</div>';
print '</div>';


print '<input type="hidden" name="userid" value="'.$userid.'">';
//print '<input type="hidden" name="uname" value="'.$uname.'">';
//print '<input type="hidden" name="hid" value="'.$hid.'">';
print '<input type="hidden" name="name" value="'.$name.'">';
print '<input type="hidden" name="view" value="'.$view.'">';
print '<input type="hidden" name="enddate" value="'.$enddate.'">';
print '<input type="hidden" name="limitdate" value="'.$limitdate.'">';
print '</form>';

$dbh = null;

?>
</body>
</html>
