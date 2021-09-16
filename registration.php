<?php
session_start();
require_once('connection.php');
$link = connecting();
if(isset($_POST['submit']))
{
	$err = [];
	// проверям логин
	if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['userLogin']))
	{
		$err[] = "Логін повинен складатися лише з букв англійського алфавіту та цифр";
	}

	if(strlen($_POST['userLogin']) < 3 or strlen($_POST['userLogin']) > 30)
	{
		$err[] = "Логін повинен бути не менше 3-х символів, та не більше 3-ти";
	}
	if($_POST['userPassword'] != $_POST['userPasswordConfirm'])
	{	
		$err[] = "Пароль не збігається з підтвердженням";
	}

	// проверяем, не сущестует ли пользователя с таким именем
	$query = mysqli_query(connecting(), "SELECT users.login FROM users WHERE users.login='".mysqli_real_escape_string(connecting(), $_POST['userLogin'])."'");
	if(mysqli_num_rows($query) > 0)
	{
		$err[] = "Користувач з таким іменем вже існує";
	}

	// Если нет ошибок, то добавляем в БД нового пользователя
	if(count($err) == 0)
	{
		$login = $_POST['userLogin'];
		$password = md5(md5(trim($_POST['userPassword'])));
		$email = $_POST['userEmail'];
		$name = $_POST['userName'];
		$surname = $_POST['userSurname'];

		$query = "INSERT INTO users (id, login, password, email, name, surname, id_city) VALUES 
		(NULL, '$login', '$password', '$email', '$name', '$surname', 1)";

		mysqli_query(connecting(), $query);
		header("Location: login.php");
		exit();
	}
	else
	{
		print "<b>При реєстрації сталися помилки:</b><br>";
		foreach($err AS $error)
		{
			print $error."<br>";
		}
	}
}
?>

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

		<div class="registration">

			<div class="registration-title">Реєстрація</div>

			<form method="POST" action="">

				<input type="text" name="userName" placeholder="Ім'я" required/> <br>
				<input type="text" name="userSurname" placeholder="Прізвище" required /><br>
				<input type="text" name="userLogin" placeholder="Логін" required /> <br>

				<input type="text" name="userEmail" placeholder="Email" required /> <br>
				<input type="password" name="userPassword" placeholder="Пароль" required /><br>
				<input type="password" name="userPasswordConfirm" placeholder="Повторіть пароль" required /><br>
	
				<input name="submit" type="submit" value="Зареєструватися"/>
			</form>

			<div class="tologin">Вже є акаунт? <a href="login.php">- Ввійти</a></div>
			
		</div>
	
	</main>

<?php require_once('footer.php') ?>

</body>
</html>