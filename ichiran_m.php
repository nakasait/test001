<?php
session_start();
//$userid = $_POST['userid'] ;
//$userid = array();

//$pass = $_POST['pass'] ;

//セッション情報がない時はログイン画面へ
if ( !isset($_SESSION['userid']) ){
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
    header( "Location: //$host$uri/login.php");
    exit;
  }
$errmessage = array();
$complete = false;
$kanrisha = '';
//POST
//if( $_POST ){
//入力チェック

//ユーザー認証
//認証チェック
  $userfile = '../userinfo.txt';
  if( file_exists($userfile)){
    $users = file_get_contents( $userfile );
    $users = explode("\n",$users);
    print '<div style="text-align:center">';
    print '<br/><h3>アカウント一覧</h3><br/>';
    print '</div>';
    foreach( $users as $k => $v) {
      $v_ary = str_getcsv($v);
      //Eメールアドレス一致か
//      if(( $v_ary[0]==$_POST['userid'] ) && ( $v_ary[3]=="0" )) {
      if( $v_ary[0]!="" ) {
      //  if( $v_ary[2]!="" ) {
          if( $v_ary[3]=="0" ) {
          $email = $v_ary[0];
          $kan = $v_ary[2];
          if($kan == "1"){
            $kanrisha = '管理者';
          }else{
            $kanrisha = '一般';  
          }
     //     $del = "1";
          //ユーザー情報ファイルを更新
          //$line = '"'.$email.'","'.$kanrisha.'"' ;
          $line = '"'.$email.'","'.$kanrisha.'"' ;
          //$users[$k] = $line ;
          //$userinfo = implode( "\n" , $users ) ;
          //$ret = file_put_contents( $userfile, $userinfo );

          //print '<h4>$line</h2><br/>';
          //print '<div style="text-align:center" class="d-flex justify-content-start">';
          //print '<div class="mr-50 text d-flex justify-content-start">';
          print '<div style="text-align:center">';
          print '<div class="list-group">';
          print '<h6><a href="#" class="mt-1 list-group list-group-item list-group-item-action list-group-item-dark">"'.$line.'"</a></h6>';
          //print $line;
          //print '<br/>';
          print '</div>';
          print '</div>';
          $complete = true ;
          //break ;

      }
    }
    //} 
    }
    if ( !$complete ) { 
      $errmessage[] = "登録アカウントがありません"; 
    }
}else{
    $errmessage[] = "ユーザーリストファイルが存在しません";  
}
//GET
//}else {
  $errmessage = array();
//}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>アカウント一覧</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body style="background-image: url(b1161.jpg);">
  <style>
    div.button{
    text-align: center;
    }
  </style>


  <div class="container">
    <div class="mx-auto" style="...">

      <?php
        if( $errmessage ){
          echo '<div class="alert alert-danger" role="alert">';
          echo implode( '<br>', $errmessage );
          echo '</div>';
        }
        else{ 
          echo '<form method="post" action="./indexu.php"><br/>';
          //echo '<div class="alert alert-primary" role="alert">';
          echo '<div style="text-align:center">';     
          //echo '<br/><h3>アカウント一覧</h3><br/>';
          //echo implode( '<br>', $line );
          echo '</div>';
          echo '</div>';
          //echo '</form>';
          echo '<div class="button">';
          echo '<input type="submit" value="ユーザー管理メニュー" class="btn btn-danger btn-lg">';
          echo '</div>';
          echo '</form>';
        }
     ?> 
        
    </div>
  </div>
</body>
</html>