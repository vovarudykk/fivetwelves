<?php
session_start();
require_once('connection.php');
if($_COOKIE['id'] == 0) {
	require_once('header_logout.php');
}
else {
	require_once('header.php');
}
?>

<?php 
	if(isset($_POST['changeLogin']) or isset($_POST['changePassword'])) {
		if (isset($_POST['changeLogin'])) {
			$id = (int)$_COOKIE['id']+1-1;
			$login = $_POST['userLoginChange'];
			$password = $_POST['userPasswordChange'];
			$msg = changeLogin($id, $login, $password);
		}
		elseif (isset($_POST['changePassword'])) {
			$id = (int)$_COOKIE['id']+1-1;
			$password = $_POST['userPasswordChange'];
			$password_new = $_POST['userPasswordChangeNew'];
			$password_confirm = $_POST['userPasswordChangeConfirm'];
			$msg = changeLogin($id, $password, $password_new, $password_confirm);
		}
	}
	else {
		$msg = "";
	}
?>

<body>
	<?php 
	$tmp = (int)$_COOKIE['id']+1-1;
	$user_arr = getUserById($tmp);?>
	<?php foreach ($user_arr as $user): ?>
	<main>
		<div class="user">
			<div class="user-logo">
				<img src="img/user_icon.png" alt="">
			</div>

			<div class="user-name">Ім'я: <?=$user['name']?> <?=$user['surname']?></div>

			<div class="user-city">Місто: <?=$user['city']?></div>

			<div class="user-email">Email: <?=$user['email']?></div>

			<div class="user-login">Логін: <?=$user['login']?></div>

			<div class="user-login-change">
				<div class= "change-text">Змінити логін</div>
				<form method="post">
					<input type="password" name="userPasswordChange" placeholder="Пароль" />
					<input type="text" name="userLoginChange" placeholder="Новий логін" />
					<input type="submit" name = "changeLogin" value="Змінити логін" />
				</form>
			</div>

			<div class="user-password-change">
				<div class= "change-text">Змінити пароль</div>
				<form method="post" action="#">
					<input type="password" name="userPasswordChange" placeholder="Cтарий пароль" />
					<input type="password" name="userPasswordChangeNew" placeholder="Новий пароль" />
					<input type="password" name="userPasswordChangeConfirm" placeholder="Повторіть новий пароль" />
					<input type="submit" name = "changePassword" value="Змінити пароль" />
				</form>
				<div><?php echo($msg) ?></div>
			</div>
		</div>
		<div class="user-password-change-logout">
			<div class= "change-text-logout">
				<form method="post" action="logout.php">
					<input type="submit" name = "logout" value="Вийти" />
				</form>
			</div>
		</div>
		<?php endforeach; ?>

    <div class="tickets">
        <div class="tickets-title">Придбані вами квитки:</div>
        <?php 
		$tmp = (int)$_COOKIE['id']+1-1;
		$events = getEventByUser($tmp);?>
		<?php foreach ($events as $event): ?>
        <div class="tickets-items">
                <div class="blog-container">
                    <div class="blog-header">
                        <div class="blog-cover">
							<img src="<?=$event['photo']?>" alt="">
						</div>
                    </div>
                    <div class="blog-body">
                        <div class="blog-title">
                             <h1><a href="#"><?=$event['name']?></a></h1> 
                             <h2><a href="#"><?=$event['date']?></a></h2>
                             <h3><a href="#"><?=$event['city']?>, <?=$event['place']?></a></h3>
                        </div>
						<div class="blog-tags">
							<ul>
								<?php 
								$event_cat = $event['id'];
								$caterories = getCategories($event_cat); ?>
								<?php if (is_array($caterories) || is_object($caterories)) {?>
								<? foreach ($caterories as $category): ?>
								<li><a href="#"><?=$category['category']?></a></li>
								<? endforeach; } ?>
							</ul>
						</div>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
	</main>
<?php require_once('footer.php') ?>

</body>