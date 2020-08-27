<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ユーザー登録</title>
</head>
<body>

<font color="0000ff" size="6">ユーザー登録</font><br/><br/>

<form method="post" action="check.php">
<input type="hidden" name="id" value="'.$id.'">
ユーザー名　
<input name="name" type="text" style="width:100px">


<br/><br/>

パスワード　
<input name="pass" type="text" style="width:100px"><br/><br/>
パスワード　
<input name="pass2" type="text" style="width:100px">
（確認用）<br/><br/>
　　　　　　
<input type="submit" value="登録">

</form>


</body>
</html>
