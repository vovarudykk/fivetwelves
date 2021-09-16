<?php
session_start();
require_once('connection.php');
// Соединямся с БД
$link=connecting();

if(isset($_POST['submit']))
{
	// Вытаскиваем из БД запись, у которой логин равняеться введенному
	$query = mysqli_query($link,"SELECT users.id as user_id, users.password as user_password 
								FROM users 
								WHERE users.login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
	$data = mysqli_fetch_assoc($query);

	// Сравниваем пароли
	if($data['user_password'] === md5(md5($_POST['password'])))
	{
		// Генерируем случайное число и шифруем его
		$hash = md5(generateCode(10));
		if(!empty($_POST['not_attach_ip']))
		{
			// Если пользователя выбрал привязку к IP
			// Переводим IP в строку
			$insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
		}
		// Записываем в БД новый хеш авторизации и IP
		mysqli_query($link, "UPDATE users SET users.user_hash='".$hash."' ".$insip." WHERE users.id='".$data['user_id']."'");
		setcookie("id",$data['user_id'],time()+60*60*24*30,"/");
		setcookie("hash",$hash,time()+60*60*24*30,"/",null,null,true);
		header("Location: check.php");
		exit();
	}
	else
	{
		print "Вы ввели неправильный логин/пароль";
	}
}
?>
<!-- <form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>

</form>
 -->

<?php
if($_COOKIE['id'] == 0) {
	require_once('header_logout.php');
}
else {
	require_once('header.php');
}
?>
<body>

	<main>

		<div class="login">

			<div class="login-title">Увійдіть в свій акаунт</div>
			
			<form method="post">
				<input type="text" name="login" placeholder="Ваш логін" required /> <br>
				<input type="password" name="password" placeholder="Ваш пароль" required /><br>
				Не прикріпляти до IP(небезпечно)
				<input type="checkbox" name="not_attach_ip"><br>
				<input name="submit" type="submit" value="Ввійти">
			</form>

			<div class="toregistration">Немає акаунта? <a href="registration.php">- Реєстрація</a></div>
			
		</div>
	


	</main>

<?php require_once('footer.php') ?>

</body>
</html>