<?php
	global $pdo;
	require "db.php";
	require "systems.php";

	if(isset($_POST["name"]) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["role"]) && isset($_POST["content"])){
		if($_POST["role"] == 1  && isset($_POST["login"]) && isset($_POST["content"])) {
			$sqlUsers = "INSERT INTO `users` (id_group, name_user, user_password, user_login) VALUES (:role, :name, :password, :login)";
			$query = $pdo->prepare($sqlUsers);
			$query->execute(array(
				"role" => $_POST["role"],
				"name" => $_POST["name"],
				"password" => $_POST["password"],
				"login" => $_POST["login"]
			));
			$login = $_POST["login"];
		
			$sql = "SELECT * FROM `users` WHERE `users`.`user_login` = '$login'";
			$query = $pdo->prepare($sql);
			$query->execute();
			$students = $query->fetch(PDO::FETCH_ASSOC);
			$idUser = $students["id_user"];

			$sqlStudents = "INSERT INTO `students`(`id_user`, `nameFIO_student`) VALUES ($idUser,:content);";
			$query = $pdo->prepare($sqlStudents);
			$query->execute(array(
				"content" => $_POST["content"]
			));
			
		} else{
			$sql = "INSERT INTO `users` (id_group, name_user, user_password, user_login) VALUES (:role, :name, :password, :login)";
			$query = $pdo->prepare($sql);
			$query->execute(array(
				"role" => $_POST["role"],
				"name" => $_POST["name"],
				"password" => $_POST["password"],
				"login" => $_POST["login"]
			));
		}

	}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Пользователи</title>
</head>
<body>
	<div class="wrapper">
		<div class="page__container container">
			<section class="page__section">
				<form  method="post" action="">
					<ul class="page__section-list section__list">
						<li>
							<input name="name" type="text" maxlength="128" placeholder= "Имя">
						</li>
						<li>
							<input name="login" type="text" maxlength="128" placeholder= "Логин">
						</li>
						<li>
							<input name="password" type="text" maxlength="128" placeholder= "Пароль">
						</li>
						<li>
							<p>При добавление ученика введите его ФИО </p>
							<input name="content" type="text" maxlength="128" placeholder= "ФИО">
						</li>
						<li>
							<p><select name="role" size="1"  name="">
								<option>Выберите роль</option>
								<option value="4">Преподаватель</option>
								<option value="2">Администратор</option>
								<option value="3">Директор</option>
								<option value="1">Ученик</option>
							</select></p>
						</li>
						<li>
							<button type="submit" class = "section__list-button">Подтвердить</button>
						</li>
					</ul>
				</form>
			</section>
			<div class="page__link">
				<a class="page__link-elements" href="user.php">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>