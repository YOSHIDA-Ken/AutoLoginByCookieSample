<?php
require_once './functions.php';
$message = '';

require_unlogined_session();

if (isset($_COOKIE["auto_login_key"])) {
       	$autoLoginKey = $_COOKIE['auto_login_key'];

	if (isValidAutoLoginKey($autoLoginKey)) {
		$_SESSION["auto_login_key"] = $autoLoginKey;
		$_SESSION['username'] = getUsenameByAutoLoginKey($autoLoginKey);
		header("Location:admin.php");
	}
}

if(isset($_POST["action"])&&$_POST["action"]==="login"){
	$username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

	if(isValidUser($username, $password)){
		if(isset($_POST["memory"]) && $_POST["memory"]==="true"){
			setcookie(
				'auto_login_key', 
				sha1(uniqid().mt_Rand(1,999999999).'_auto_login_key'), 
				time() + 3600 * 24 * 14
			);
		}
		$_SESSION['username'] = $username;
		header("Location:admin.php");

	}else{
		session_destroy();
		$message = "パスワードが違います";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<?php
    if($message!=""){
        print "<p class=\"message\">".$message."</p>\n";
    }
?>
<form action="" method="post">
<p>
<input name="user" type="text" value="user" /><br/>
<input name="password" type="text" value="pass" />
<input name="action" type="submit" value="login" />
</p>
<p>
<label>
<input type="checkbox" name="memory" value="true" />次回からは自動的にログイン
</label>
</p>
</form>
</body>
</html>
