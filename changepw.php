<?php
//$pass = $_POST['pass'];
session_start();
//セッション情報がない時はログイン画面へ
if ( !isset($_SESSION['userid']) ){
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
    header( "Location: //$host$uri/login.php");
    exit;
  }
$errmessage = array();
$complete = false;
//POST
if( $_POST ){
//入力チェック
// if ( !isset($_SESSION['userid']) ){  
  if( !$_POST['pass']){
      $errmessage[] = "現在のパスワードを入力してください";
  } else if ( strlen($_POST['pass']) > 50 ){
      $errmessage[] = "パスワードは50文字以内に入力してください";
  }
  if( !$_POST['pass2']){
    $errmessage[] = "新しいパスワードを入力してください";
  } else if ( strlen($_POST['pass2']) > 50 ){
    $errmessage[] = "パスワードは50文字以内に入力してください";
  }
  if( !$_POST['pass22']){
    $errmessage[] = "確認用パスワードを入力してください";
    $complete = false;
  } else if ( $_POST['pass22']!=$_POST['pass2'] ){
    $errmessage[] = "新しいパスワードの値が一致しません";
    $complete = false;
  }

//ユーザー認証
//認証チェック
  $userfile = '../userinfo.txt';
  if( file_exists($userfile)){
    $users = file_get_contents( $userfile );
    $users = explode("\n",$users);
    foreach( $users as $k => $v) {
      $v_ary = str_getcsv($v);
      //Eメールアドレス一致か
      if( $v_ary[0]==$_SESSION['userid'] ) {
        //一致ならば現ＰＷチェック
        if( password_verify($_POST['pass'], $v_ary[1]) ){
         //PW一致

         //新ＰＷのハッシュ値を作る
          $ph = password_hash($_POST['pass2'] ,PASSWORD_DEFAULT) ;
          $kan = $v_ary[2];
          $del = $v_ary[3];

          //ユーザー情報ファイルを更新
//        $line = '"'.$_SESSION['userid'].'","'.$ph.'"' ;
          $line = '"'.$_SESSION['userid'].'","'.$ph.'","'.$kan.'","'.$del.'"' ;
          $users[$k] = $line ;
          $userinfo = implode( "\n" , $users ) ;
          $ret = file_put_contents( $userfile, $userinfo );
          $complete = true ;
          break ;

        }
      } 
    }
    if ( !$complete ) { 
      $errmessage[] = "現在のパスワードが一致しません"; 
    }
}else{
    $errmessage[] = "ユーザーリストファイルが存在しません";  
//}
}
//GET
}else {
  $errmessage = array();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>パスワード変更</title>
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
      ?>
      <?php if( $complete ){ ?>
        <h4>パスワードを変更しました。<br/><br/>
        <a href="./mainmenu.php">メインメニューへ</h4></a>
      <?php } else { ?>
      <form method="post" action="./changepw.php">
      <br/>
      <h4>現在のパスワード</h4><input name="pass" type="password" class="form-control"><br/><br/>
      <h4>新しいパスワード</h4><input name="pass2" type="password" class="form-control"><br/><br/>
      <h4>新しいパスワード（確認用）</h4><input name="pass22" type="password" class="form-control"><br/><br/>　　
         <div class="button">
           <input type="submit" name=change value="変更" class="btn btn-primary btn-lg">
         </div>
         </form>
      <?php } ?>        
     </div>
  </div>
</body>
</html>