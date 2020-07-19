<?php
require_once './functions.php';
require_logined_session();

$message = '';
 
$autoLoginKey = filter_input(INPUT_COOKIE, 'auto_log_key', FILTER_SANITIZE_SPECIAL_CHARS);

if ( ! $autoLoginKey) {
    $_SESSION["auto_login_key"] = $_COOKIE["auto_login_key"];
}

try {
	if (! isset($_SESSION['auto_login_key'])) {
		if (! isset($_SESSION['username'])) {
			throw new Exception('no authorized.');
		}
	}
	$message = "Login success";
}
catch (Exception $e)
{
    session_destroy();
//    header("Location:login.php?error=".$e->getMessage());
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Admin</title>
</head>
<body>
<h1>Admin</h1>
<?php
    if($message!=""){
        print "<p class=\"message\">".$message."</p>\n";
    }
?>
<div>
<a href="./remove_cookie.php">remove cookie</a>
<a href="./logout.php">logout</a>
</div>
</body>
</html>
