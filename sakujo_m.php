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
//POST
if( $_POST ){
//入力チェック
if( !$_POST['userid'] ){
    $errmessage[] = "削除するＥメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  } else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "不正なメールアドレスです";
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
      if(( $v_ary[0]==$_POST['userid'] ) && ( $v_ary[3]=="0" )) {
     //     $ph = password_hash($_POST['pass2'] ,PASSWORD_DEFAULT) ;
          $email = $_POST['userid'];
          $ph = $v_ary[1];
     //     $kan = $v_ary[2];
          $kan = "0";
          $del = "1";

          //ユーザー情報ファイルを更新
          $line = '"'.$_POST['userid'].'","'.$ph.'","'.$kan.'","'.$del.'"' ;
          $users[$k] = $line ;
          $userinfo = implode( "\n" , $users ) ;
          $ret = file_put_contents( $userfile, $userinfo );
          $complete = true ;
          break ;

      } 
    }
    if ( !$complete ) { 
      $errmessage[] = "削除するアカウントがありません"; 
    }
}else{
    $errmessage[] = "ユーザーリストファイルが存在しません";  
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
  <title>アカウント削除</title>
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
      <?php 
      if( $complete )
      { ?>
        <?php 
        print '<div class="container">';
        print '<div style="text-align:center">';
        
        print '<br/><h3>アカウントを削除しました。</h3><br/>';
        print '<div class="alert alert-primary" role="alert">';
        print '<h3>'.$v_ary[0].'</h3>'; 
        print '</div>';
        print '<br/>';
        print '<a href="./indexu.php"><h3>ユーザー管理メニューへ</h3></a><br/><br/>';
        print '</div>';
        print '</div>';
        ?>
      <?php
       } else 
      { ?>
      
      <form method="post" action="./sakujo_m.php">
       削除するＥメール<input name="userid" type="email"  class="form-control"><br/><br/>
         <div class="button">
           <input type="submit" name=change value="削除" class="btn btn-primary btn-lg">
         </div>
       </form>
       <form method="post" action="./indexu.php"><br/>
        <div class="button">
          <input type="submit" value="ユーザー管理メニュー" class="btn btn-danger btn-lg">
        </div>
       </form>
      <?php } ?>        
    </div>
  </div>
</body>
</html>