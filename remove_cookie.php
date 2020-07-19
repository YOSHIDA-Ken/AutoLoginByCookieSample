<?php

session_start();
setcookie(
	'auto_login_key', 
	sha1(uniqid().mt_Rand(1,999999999).'_auto_login_key'), 
	time() - 1800
);
header("Location:admin.php");
