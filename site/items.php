<?php
	require "db.php";
	//$predmet_id=$_GET['items.id_items'];
	$sql = "SELECT id_items , item_name FROM `items`, `groups` WHERE id_items>0";
	//$item = mysqli_fetch_all($sql)
	
	$query = $pdo->prepare($sql);
	$query->execute();
	$items = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Предметы</title>
</head>
<body>
<p><?php $items?></p>
	<div class="wrapper">
		<div class="page container">
			<ul class="list">
				<?php foreach($items as $item): ?>
				<li>
					<a $item </a>
					<span class="list__name"><?=$item["item_name"]?></span>
					<a href="deleteitems.php?id=<?=$item["id_items"]?>" class="list__link">Удалить</a>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="navigation__elements">
				<ul class="navigation__elements-list elements__list">
					<li>
						<a href="additems.php" class="elements__list-link">Добавить предмет</a>
					</li>
					<li>
						<a href="index.php" class="elements__list-link">Назад</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>	