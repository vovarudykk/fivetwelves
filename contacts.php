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
	<main class="location">
		<div class="location__info">
			<h1>Контакти</h1>
			<p>+38(073)123-92-96</p>
			<p>+38(093)123-92-96</p>
			<p>fivetwelves@gmail.com</p>
			<p>fivetwelves.support@mail.ru</p>
			<h1>Театральні каси:</h1>
		</div>
		<div id="map"></div>
	</main>

	<script>
		function initMap() {
			var uluru = {lat: 50.449271, lng: 30.4520235};
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: uluru
			});
			var marker = new google.maps.Marker({
				position: uluru,
				map: map
			});
		}
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMLdZ9glcC7givLUJFRhnrs3gF3JaQH20&callback=initMap">
	</script>
	

<?php require_once('footer.php') ?>

</body>
</html>