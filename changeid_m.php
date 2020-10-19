<?php
session_start();
//$userid = $_POST['userid'] ;
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
$chk = '0';
//POST
//管理画面から来た場合？　一発目かどうか？
if( $_POST ){
//if( $chk != '0' ){
  //入力チェック
if( !$_POST['userid'] ){
    $errmessage[] = "現在のＥメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  } else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "不正なメールアドレスです";
  }
  
  if( !$_POST['userid'] ){
    $errmessage[] = "Ｅメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  } else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "不正なメールアドレスです";
  }
  if( !$_POST['kanri'] ){
    $errmessage[] = "権限を入力してください";
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
      if( $v_ary[0]==$_POST['userid'] ) {
     //   //一致ならば現ＰＷチェック
     //   if( password_verify($_POST['pass'], $v_ary[1]) ){
     //    //PW一致
         //新ＰＷのハッシュ値を作る
     //     $ph = password_hash($_POST['pass2'] ,PASSWORD_DEFAULT) ;
          $ph = $v_ary[1];
     //     $kan = $v_ary[2];
          if($_POST['kanri']=="kanrisha"){
             $kan = "1";}
          else{$kan = "0";}
          $del = $v_ary[3];

          //ユーザー情報ファイルを更新
          $line = '"'.$_POST['userid'].'","'.$ph.'","'.$kan.'","'.$del.'"' ;
          $users[$k] = $line ;
          $userinfo = implode( "\n" , $users ) ;
          $ret = file_put_contents( $userfile, $userinfo );
          $complete = true ;
          break ;
     //    }
      } 
    }
    if ( !$complete ) { 
      $errmessage[] = "Ｅメールが一致しません"; 
    }
}else{
    $errmessage[] = "ユーザーリストファイルが存在しません";  
}
$chk = "1";
//GET
}else {
  $errmessage = array();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ユーザー情報変更</title>
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
        <br/><h4>ユーザー情報を変更しました。<br/><br/>
        <a href="./indexu.php">ユーザー管理メニューへ</a></h4><br/><br/>
      <?php
       } else 
      { ?>
      <form method="post" action="./changeid_m.php">
      <br/>Ｅメール<input name="userid" type="email" value="" class="form-control"><br/><br/>
        　　　　＜権限の変更＞<br/><br/>
         　　　　　管理者
        <input type="radio" name="kanri" value="kanrisha" class="form-control">
        　　　　　一般
        <input type="radio" name="kanri" value="ippan" class="form-control">
        <br/><br/>
         <div class="button">
           <input type="submit" name=change value="変更" class="btn btn-primary btn-lg">
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