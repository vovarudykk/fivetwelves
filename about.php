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

	<main>

		<div class="info__container">
			<div class="info">
				<div class="info__item_header">
					<p class="info__item__header__p"><h1>FiveTwelves events</h1> новий крупний квитковий оператор України в сегменті "живих" розваг: вистави, концерти, мюзикли, фестивалі, класична музика, спорт, заходи для дітей та багато-багато іншого.</p>
					<p>Ми допомагаємо клієнтам при виборі квитків на події і пропонуємо квитки на будь-які місця та дати, а також постійно намагаємось робити унікальні персоналізовані рекомендації для наших корисутвачів, орієнтуючись на їх інтереси.</p>
				</div>
				<div class="info__item_header">
					<p class="mamuse__info">FiveTwelves events</p>
				</div>
			</div>
		</div>

		<div class="info__h">
			<h1>Переваги нашого сервісу<h1>
		</div>

		<div class="info__container">
			<div class="info">
				<div class="info__item">
						<p class="info__item__p"><h2>Сайт</h2> надає можливість придбати квиток у будь-який зручний для вас час прямо з телефона чи комп'ютера підключенного до інтернету.</p>  
				</div>
				<div class="info__item">
						<p class="info__item__p"><h2>Call-центр</h2>з професійними операторами, які завжди готові відповісти на будь-які питання та допомогти зробити правильний вибір.</p>  
				</div>
				<div class="info__item">
						<p class="info__item__p"><h2>Театральні каси</h2> в яких ви можете придбати або розрукувати фізичний квиток, зручно розміщені по всій країні</p>  
				</div>
				<div class="info__item">
					<p class="info__icon"><i class="fas fa-clock fa-fw" aria-hidden="true"></i></p>
						<p class="info__item__p"><h2>Електронний квиток</h2> можна придбати прямо на сайті, без необхідності в роздрукуванні. Просто відкрийте його на телефоні.</p>  
				</div>
			</div>
		</div>
	</main>

<?php require_once('footer.php') ?>

</body>
</html>