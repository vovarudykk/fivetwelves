<?php
	function connecting() {
		$host='localhost';
		$database='check_events';
		$user='root';
		$password='root';

		$sql=mysqli_connect($host, $user, $password, $database) or die("Помилка при з'єднанні за базою");
		return $sql;
	}

	function generateCode($length=6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) {
				$code .= $chars[mt_rand(0,$clen)];
		}
		return $code;
	}

	function getEvents($tmp){	
		if ($tmp==1) {
			$query="SELECT events.id, events.name, events.description, cities.name as city, places.name as place, DATE_FORMAT(events.date, '%Y-%m-%d %H:%i') as 'date', events.photo
					FROM events, cities, places
					WHERE cities.id = events.id_city AND places.id = events.id_place ORDER BY events.date ASC";
		}
		elseif ($tmp==2) {
			$query="SELECT events.id, events.name, events.description, cities.name as city, places.name as place, DATE_FORMAT(events.date, '%Y-%m-%d %H:%i') as 'date', events.photo
					FROM events, cities, places
					WHERE cities.id = events.id_city AND places.id = events.id_place ORDER BY events.name ASC";
		}

		elseif ($tmp=3) {
			$query="SELECT events.id, events.name, events.description, cities.name as city, places.name as place, DATE_FORMAT(events.date, '%Y-%m-%d %H:%i') as 'date', events.photo
					FROM events, cities, places
					WHERE cities.id = events.id_city AND places.id = events.id_place ORDER BY events.id ASC";
		}

		$res=mysqli_query(connecting(), $query);
		return $res;
	}

	function getCategories($event_ct) {
		$query_cat="SELECT categories.name as category
				FROM categories, events, events_categories_list
				WHERE categories.id = events_categories_list.id_category AND events_categories_list.id_event = events.id AND events.id = $event_ct";

		$categories = mysqli_query(connecting(), $query_cat);
		return $categories;
	}

	function getEventsById($tmp){	
		$query="SELECT events.id, events.name, organizers.name as organizer, events.max_visitors, events.description, cities.name as city, places.name as place, DATE_FORMAT(events.date, '%Y-%m-%d %H:%i') as 'date', events.photo
			FROM events, cities, places, organizers
			WHERE cities.id = events.id_city AND places.id = events.id_place AND events.id_organizer=organizers.id AND events.id = $tmp";

		$res=mysqli_query(connecting(), $query);
		return $res;
	}

	function getEventByUser($tmp){	
		$query="SELECT DISTINCT events.id, events.name, organizers.name as organizer, events.max_visitors, events.description, cities.name as city, places.name as place, DATE_FORMAT(events.date, '%Y-%m-%d %H:%i') as 'date', events.photo
				FROM events, cities, places, organizers, sold_tickets
				WHERE cities.id = events.id_city AND places.id = events.id_place AND events.id_organizer=organizers.id AND events.id = sold_tickets.id_event AND sold_tickets.id_user = $tmp";

		$res=mysqli_query(connecting(), $query);
		return $res;
	}

	function getUserById($tmp){	
		$query="SELECT users.name, users.surname, cities.name as city, users.email, users.login
				FROM users, cities
				WHERE cities.id = users.id_city AND users.id = $tmp";

		$res=mysqli_query(connecting(), $query);
		return $res;
	}

	function changeLogin($id, $login, $password) {
		$query = "SELECT users.password
					FROM users
					WHERE users.id = $id";

		$res=mysqli_query(connecting(), $query);
		$row = mysqli_fetch_array($res);
		$pass_bd = $row[0];

		if($pass_bd == md5(md5($password))) {
			$query = "UPDATE users 
					SET users.login = '$login' 
					WHERE users.id = $id";
			mysqli_query(connecting(), $query);
			return 'Логін успішно змінено';
		}
		else {
			return 'Не вірний пароль';
		}
	}

	function changePassword($id, $password, $password_new, $password_confirm) {
		$query = "SELECT users.password
					FROM users
					WHERE users.id = $id";

		$res=mysqli_query(connecting(), $query);
		$row = mysqli_fetch_array($res);
		$pass_bd = $row[0];

		if(($pass_bd == md5(md5($password))) and ($password_new == $password_confirm)) {
			$password_new = md5(md5($password_new));
			$query = "UPDATE users 
					SET users.password = $password_new 
					WHERE users.id = $id";
			mysqli_query(connecting(), $query);
			return 'Пароль успішно змінено';
		}
		else {
			return 'Не вірний пароль';
		}
	}

	function addTicket($event, $user) {
		$query = "INSERT INTO sold_tickets (id, id_event, id_user) VALUES (NULL, $event, $user)";
		$res = mysqli_query(connecting(), $query);
	}





?>