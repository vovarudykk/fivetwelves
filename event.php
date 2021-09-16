<?php
session_start();
require_once('connection.php');
if(isset($_POST['addTicket'])) {
	addTicket($_POST['eventID'], $_COOKIE['id']);
	header("Location: index.php");
	exit();
}
if($_COOKIE['id'] == 0) {
	require_once('header_logout.php');
}
else {
	require_once('header.php');
}
?>

<body>
	<?php 
	$tmp = (int)$_POST['event_id']+1-1;
	$events = getEventsById($tmp);?>
	<?php foreach ($events as $event): 
	?>
	<div class="event-container">
		<div class="event-header">
			<div class="event-cover">
				<img src="<?=$event['photo']?>"alt="">
			</div>
		</div>
		<div class="event-body">
			<div class="event-title fade">
				 <h1><a href="#"><?=$event['name']?></a></h1> 
				 <h2 class="right"><a href="#">Дата: <?=$event['date']?></a></h2>
				 <h2><a href="#">Локація: <?=$event['city']?>, <?=$event['place']?> </a></h2>
			</div>

			<div class="event-tags">
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

			<div class="event-creators">
				<div class="event-creators-title">Організатор: <?=$event['organizer']?></div> 
				
				<div class="event-creators-amount">Кількість місць: <?=$event['max_visitors']?></div>

			</div>


			<div class="event-text">
				<p><?=$event['description']?></p>
			</div>

		</div>
			<div class="blog-footer">
				<form action="#" method="post"> 
					<input type="hidden" name="eventID" value="<?=$event['id']?>">
					<input type="submit" class="blog-footer-button" name="addTicket" value="Купити квиток">
				</form>
			</div>
		</div>
	<?php endforeach; ?>

<?php require_once('footer.php') ?>

</body>

</html>