<?php
function require_unlogined_session() {
	session_start();

	if (isset($_SESSION['username'])) {
		header("Location:admin.php");
		exit;
	}
}

function require_logined_session() {
	session_start();

	if ( ! isset($_SESSION['username'])) {
		header("Location:login.php");
		exit;
	}
}

function isValidUser(string $user, string $password): bool {
	if ($user === 'user' && $password === 'pass1') {
		return true;
	}
	return false;
}

function isValidAutoLoginKey(string $autoLoginKey): bool {
	return true;
}
