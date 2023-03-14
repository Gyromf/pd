<?php
	require "systems.php";
	global $pdo;

	$sql = "SELECT * FROM `items`";
	$query = $pdo->prepare($sql);
	$query->execute();
	$items = $query->fetchAll(PDO::FETCH_ASSOC);
	$id = $_GET['id'];
	
	
	

	if(isset($_POST["mark"]) && isset($_POST["role"]) && isset($_POST["da"])){
		
		$sqlUsers = "INSERT INTO `accounting`( `mark`, `id_items`, `id_students`, `date`) VALUES (:mark, :role, $id, :da)";
		$query = $pdo->prepare($sqlUsers);
		$query->execute(array(
			"mark" => $_POST["mark"],
			"role" => $_POST["role"],
			"da" => $_POST["da"]
			
			
		));
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Выставление оценок</title>
</head>
<body>
	<div class="wrapper">
		<div class="page__container container">
			<section class="page__section">
				<form method="POST" action="">
					<ul class="page__section-list section__list">
						<!--<li>
							<input name="mark" type="text" maxlength="128" placeholder= "Оценка">
						</li>-->
						<li>
							<input name="da" type="text" maxlength="128" placeholder= "Дата">
						</li>
						<li>
							<p><select name="mark" size="1"  name="">
								<option>Выберите отметку</option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>
								<option value="Доп.">Допуск</option>
								<option value="Зач.">Зачет</option>
							</select></p>
						</li>
						<!--<li>
							<input name="da" type="text" maxlength="128" placeholder= "Дата">
						</li>-->
						<li>
							<p><select name="role" size="1"  name="">
								<option>Выберите предмет</option>
								<?php foreach($items as $it): ?>
									<option value="<?=$it["id_items"] ?>"><?=$it["item_name"]?></option>
								<?php endforeach; ?>
							</select></p>
						</li>
						<li>
							<button type="submit" class = "section__list-button">Подтвердить</button>
						</li>
					</ul>
				</form>
			</section>
			<div class="page__link">
				<a class="page__link-elements" href="index.php">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>