<?php
//print_r($_SERVER);
$errmessage = array();
//POST
if( $_POST ){
//入力チェック
  if( !$_POST['userid'] ){
    $errmessage[] = "Ｅメールを入力してください"; 
  }else if ( strlen($_POST['userid']) > 200 ){
    $errmessage[] = "200文字以内に入力してください";
  } else if ( !filter_var($_POST['userid'], FILTER_VALIDATE_EMAIL) ){
    $errmessage[] = "不正なメールアドレスです";
  }

  if(!$_POST['pass']){
    $errmessage[] = "パスワードを入力してください";
  } else if ( strlen($_POST['pass']) > 100 ){
  $errmessage[] = "パスワードは100文字以内に入力してください";
  }

  if( $_POST['pass'] != $_POST['pass2'] ){
    $errmessage[] = "確認用パスワードが一致しません";
  }

  $userfile = '../userinfo.txt';
  $users = array();
  if(file_exists($userfile)){
    $users = file_get_contents( $userfile );
    $users = explode("\n",$users);
    foreach( $users as $k => $v) {
      $v_ary = str_getcsv($v);
      if( $v_ary[0]==$_POST['userid'] ){
        $errmessage[] = "そのＥメールアドレスはすでに登録されています"; 
        break;
      }
    }
  }

//ユーザー新規登録
//$userfile = '../userinfo.txt';
  if( !$errmessage ){
    $ph = password_hash($_POST['pass'],  PASSWORD_DEFAULT );
    $kan = '0';
    $del = '0';
    $line ='"'.$_POST['userid'].'","'.$ph.'","'.$kan.'","'.$del.'"'."\n";
    $ret = file_put_contents( $userfile, $line, FILE_APPEND );
  }

  if( !$errmessage ){
    $host = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') ;
    header( "Location: //$host$uri/login.php");
    exit;
  }
//GET
}else {
  $_POST['userid'] = '';
  $errmessage = array();
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>新規登録</title>
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
      <h1>新規登録</h1>
      <?php
        if( $errmessage ){
          echo '<div class="alert alert-danger" role="alert">';
          echo implode( '<br>', $errmessage );
          echo '</div>';
        }
      ?>
      <form method="post" action="./register.php">

        Ｅメール<input name="userid" type="email" value="<?php echo htmlspecialchars($_POST['userid'])?>"" class="form-control">
        <br/><br/>
        パスワード<input name="pass" type="password" class="form-control">
        <br/><br/>
        パスワード（確認）<input name="pass2" type="password" class="form-control">
        <br/><br/>
        <div class="button">
          <input type="submit" value="登録" class="btn btn-primary btn-lg">
        </div>
      </form>
    </div>
  </div>
</body>
</html>