<?php
	require "systems.php";
	global $pdo;

	$sql = "SELECT * FROM items";
	$query = $pdo->prepare($sql);
	$query->execute();
	$items = $query->fetchAll(PDO::FETCH_ASSOC);


	if(isset($_POST["role"])){
		$sqlaccounting = "DELETE FROM accounting WHERE id_items= :role";

		$query = $pdo->prepare($sqlaccounting);
		$query->execute(array(
			"role" => $_POST["role"]
		));
		$sqlitems = "DELETE FROM items WHERE id_items=:role";
		$query = $pdo->prepare($sqlitems);
		$query->execute(array(
			"role" => $_POST["role"]
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
							<p><select name="role" size="1"  name=>
								<option>Выберите предмет</option>
								<?php foreach($items as $it): ?>
									<option value=<?=$it["id_items"] ?>><?=$it["item_name"]?></option>
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