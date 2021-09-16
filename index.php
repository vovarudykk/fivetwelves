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

<body>
	<main class="blog">
		<div class="blog-head-buttons">
			<div class = "blog-buttons">
				<form action="" method="post"> 
					<input type="submit" class="blog-footer-button" name="event_by_date" value="По даті">
				</form>
				<form action="" method="post"> 
					<input type="submit" class="blog-footer-button" name="event_by_name" value="По назві">
				</form>
				<form action="" method="post"> 
					<input type="submit" class="blog-footer-button" name="event_by_popular" value="По популярності">
				</form>
			</div>
		</div>

		<?php 
			if(isset($_POST['event_by_date']) or isset($_POST['event_by_name']) or isset($_POST['event_by_popular'])) {

				if (isset($_POST['event_by_date'])) {
					$events = getEvents(1);
				}
				elseif (isset($_POST['event_by_name'])) {
					$events = getEvents(2);
				}
				elseif (isset($_POST['event_by_popular'])) {
					$events = getEvents(3);
				}
			}
			else {
				$events = getEvents(3);
			}
		?>
		<?php foreach ($events as $event): ?>
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
					 <h3><a href="#"><?=$event['city']?>, <?=$event['place']?> </a></h3>
				</div>
				<div class="blog-text">
					<p><?=$event['description']?></p>
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
				<div class="blog-footer">
					<form action="event.php" method="post"> 
						<input type="submit" class="blog-footer-button" name="name_button" value="Подробнее">
						<input type="hidden" class="blog-footer-button" name="event_id" value="<?=$event['id']?>">
					</form>
				</div>
		</div>
		<?php endforeach; ?>
	</main>

<?php require_once('footer.php') ?>

</body>
</html>