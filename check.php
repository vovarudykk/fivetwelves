<?php
session_start();
require_once('connection.php');
$link=connecting();
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
	$query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE users.id = '".intval($_COOKIE['id'])."' LIMIT 1");
	$userdata = mysqli_fetch_assoc($query);

	if(($userdata['user_hash'] !== $_COOKIE['hash']) or 
		($userdata['id'] !== $_COOKIE['id']) or 
		(($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR']) and ($userdata['user_ip'] !== "0")))
	{
		setcookie("id", "", time() - 3600*24*30*12, "/");
		setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
		print "Ой, щось пішло не так :с";
	}
	else
	{
		header("Location: index.php");
		exit();
	}
}
else
{
	print "Кукі вимкнені";
}
?>