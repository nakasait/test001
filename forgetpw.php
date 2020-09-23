<?php
//session_start();
$errmessage = array();
$complete = false;
//POST
if( $_POST ){
//入力チェック
  if( !$_POST['userid'] ){
    $errmessage[] = "Ｅメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  }else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
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
      //Eメールアドレス一致ならばパスワード生成
      if( $v_ary[0]==$_POST['userid'] ) {
        $pass = bin2hex(random_bytes(5));
        //メール送信
        $message = "パスワード変更しました \r\n" . $pass . "\r\n" ;
        mail( $_POST['userid'] , 'パスワード変更しました' , $message) ;
        //userinfo.txt ファイル更新
        $ph = password_hash($pass ,PASSWORD_DEFAULT) ;
        $line = '"'.$_POST['userid'].'","'.$ph.'"' ;
        $users[$k] = $line ;
        $userinfo = implode( "\n" , $users ) ;
        $ret = file_put_contents( $userfile, $userinfo );
        $complete = true ;
        break ;
      }
    }
    if( !$complete ) {
        $errmessage[] = "ユーザー名が一致しません" ;
    } 
  }else{
    $errmessage[] = "ユーザーリストファイルが存在しません" ;
  }
//GET
}else {
//セッション情報あればログイン画面スキップ
  if( isset($_SESSION['userid']) && $_SESSION['userid']) {
  //ログイン済みなのでメインメニューへ
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
    header( "Location: //$host$uri/mainmenu.php");
    exit;
  }
  $_POST['userid'] = '';
  $errmessage = array();
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>パスワード再発行</title>
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
      <h1>パスワード再発行</h1>
      <?php
        if( $errmessage ){
          echo '<div class="alert alert-danger" role="alert">';
          echo implode( '<br>', $errmessage );
          echo '</div>';
        }
      ?>
      <?php if ( $complete ) { ?>
        パスワード再発行しました。
      <?php } else { ?> 

        <form method="post" action="./forgetpw.php">

        Ｅメール<input name="userid" type="email" value="<?php echo htmlspecialchars($_POST['userid'])?>"" class="form-control">
        <br/><br/>
          <div class="button">
            <input type="submit" value="再発行" class="btn btn-primary btn-lg">
          </div>
        </form>
      <?php } ?>
    </div>
  </div>
</body>
</html>