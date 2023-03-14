<?php
	require "systems.php";
	global $pdo;

	$sql = "SELECT * FROM items";
	$query = $pdo->prepare($sql);
	$query->execute();
	$items = $query->fetchAll(PDO::FETCH_ASSOC);


	if(isset($_POST["name"]) ){
	$sqlitems = "DELETE FROM items WHERE item_name= :name";
		/*$sqlId = "SELECT id_items FROM `items` WHERE item_name=:name ";
		$sqlaccounting = "DELETE FROM accounting WHERE id_items= $sqlId";
		$sqlitems = "DELETE FROM items WHERE item_name= $sqlId";
		$queryId = $pdo->prepare($sqlId);
		$queryId = $pdo->prepare($sqlaccounting);*/
		$query = $pdo->prepare($sqlitems);
		$query->execute(array(
			"name" => $_POST["name"]
			
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
	<title>Удаление предмета</title>
</head>
<body>
	<div class="wrapper">
		<div class="page__container container">
			<section class="page__section">
				<form method="POST" action="">
					<ul class="page__section-list section__list">
						<li>
							<input name="name" type="text" maxlength="128" placeholder= "Название предмета">
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