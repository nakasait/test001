<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー管理</title>
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
$errmessage = array();
//$userid=$_POST['userid'];
//権限チェック
$userfile = '../userinfo.txt';
if( file_exists($userfile)){
  $users = file_get_contents( $userfile );
  $users = explode("\n",$users);
  foreach( $users as $k => $v) {
    $v_ary = str_getcsv($v);
    //Eメールアドレス一致か
    if( $v_ary[0] == $_SESSION['userid'] ) {
      if( $v_ary[2] == '0' ) {
//        if( $v_ary[3] == '0' ) {
         //一致ならば管理者で未削除
        $errmessage[] = "管理者のみ作業が可能です";
        break;
//        }
      }
    }
  }
}  

print '<div class="container">';
  print '<div style="text-align:center">';
//時計のアイコン
//print '<svg width="10em" height="10em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
//print '<path fill-rule="evenodd" d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>';
//print '</svg>';
    print '<br/><h1>ユーザー管理</h1>';
        if( $errmessage ){
          print '<div class="alert alert-danger" role="alert">';
          print implode( '<br>', $errmessage );
          print '</div>';
          print '<br/>';
          //print '<form method="post" action="kanrichk.php">';
          //<button type="button" class="btn btn-primary">Primary</button>
          //print '<button type="button" style="width:500px" class="btn btn-dark btn-lg">詳細はこちらです</button><br/>';
          print '<div class="d-flex justify-content-center">';
          print '<button type="button" class="btn btn-dark btn-lg">詳細はこちらです</button><br/>';
          print '</div>';
          //print '</form><br/>';
          print '<br/>';
          print '<a href="./logout.php" class="text-danger">';
          print '<h3>ログアウトする</h3></a>';
          print '<script src="kanrichk.js"></script>';
          exit;
        }
  print '</div>';
print '</div>';

print '<div class="container">';
print '<div class="mx-auto" style="...">';
print '<div style="text-align:center">';
print '<br/>';
print '<form method="post" action="indexu.php">';
print '<input type="submit" value="ユーザー管理" style="width:500px" class="btn btn-primary btn-lg">';
print '</form><br/>';
//print '<br/><br/>';

print '<form method="post" action="mainmenu.php">';
print '<input type="submit" value="メインメニュー" style="width:500px" class="btn btn-danger btn-lg">';
print '</form><br/>';

print '<form method="post" action="logout.php">';
print '<input type="submit" value="ログアウト" style="width:500px" class="btn btn-primary btn-lg">';
print '</form><br/><br/>';
print '</div>';
print '</div>';
print '</div>';

//print '<script src="kanrichk.js"></script>';
?>
 <script src="kanrichk.js"></script> 
</body>
</html>
