<?php
session_start();
$errmessage = array();
//POST
//if( $_POST ){
//入力チェック
if( $_POST ){
//入力チェック
  if( !$_POST['userid'] ){
    $errmessage[] = "Ｅメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  }else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "不正なメールアドレスです";
  }
  
  if( !$_POST['pass']){
      $errmessage[] = "パスワードを入力してください";
  } else if ( strlen($_POST['pass']) > 100 ){
      $errmessage[] = "パスワードは100文字以内に入力してください";
  }

//ユーザー認証
//認証チェック
  $userfile = '../userinfo.txt';
  if( file_exists($userfile)){
    $users = file_get_contents( $userfile );
    $users = explode("\n",$users);
    foreach( $users as $k => $v) {
      $v_ary = str_getcsv($v);
      //Eメールアドレス一致で未削除か
      if(( $v_ary[0]==$_POST['userid'] ) && ( $v_ary[3]== "0")) {
        //一致ならばＰＷチェック
        if( password_verify($_POST['pass'], $v_ary[1]) ){
         //PW一致
         //メイン画面へリダイレクト
         
          $_SESSION['userid'] = $_POST['userid']; //セッション情報保存
          print $_POST['userid'];
          print $_SESSION['userid'];
          $host = $_SERVER['HTTP_HOST'];
          $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
          header( "Location: //$host$uri/mainmenu.php");
          print '<form>';
//          print $pass = $_POST['pass'];
print '<input type="hidden" name="pass" value="'.$pass.'">';
          print '</form>'; 
          exit;
        }
      } 
    }  
    $errmessage[] = "ユーザー名またはパスワードが一致しません"; 
  }else{
    $errmessage[] = "ユーザーリストファイルが存在しません";  
  }
//GET
}else {
//セッション情報あればログイン画面スキップ
  if( isset($_SESSION['userid']) && $_SESSION['userid']) {
  //ログイン済みなのでメインメニューへ
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
    header( "Location: //$host$uri/mainmenu.php");
    print '<form>';
    print '<input type="hidden" name="pass" value="'.$pass.'">';
    print '</form>';
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
  <title>ログイン</title>
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
      <h1>ログイン</h1>
      <?php
        if( $errmessage ){
          echo '<div class="alert alert-danger" role="alert">';
          echo implode( '<br>', $errmessage );
          echo '</div>';
        }
      ?>
      <form method="post" action="./login.php">

        Ｅメール<input name="userid" type="email" value="<?php echo htmlspecialchars($_POST['userid'])?>"" class="form-control">
        <br/><br/>
        パスワード<input name="pass" type="password" class="form-control">
        <br/><br/>
        <div class="button">
          <input type="submit" value="ログイン" class="btn btn-primary btn-lg">
        </div>
      </form>
    
      <form method="post" action="./register.php">
        <div class="button">
          <br/>
          <input type="submit" value="新規登録" class="btn btn-danger btn-lg">
        </div>
      </form>
    </div>
  </div>
</body>
</html>