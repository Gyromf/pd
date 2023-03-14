<?php
	require "db.php";
	$sql = "SELECT id_user ,name_user, groups.group_name FROM `users`, `groups` WHERE users.id_group = groups.id_group";
	$query = $pdo->prepare($sql);
	$query->execute();
	$user = $query->fetchAll(PDO::FETCH_ASSOC);
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
		<div class="page container">
			<ul class="list">
				<?php foreach($user as $item): ?>
				<li>
					<span class="list__name"><?=$item["name_user"]?>(<?=$item["group_name"]?>)</span>
					<a href="deleteUsers.php?id=<?=$item["id_user"]?>" class="list__link">Удалить </a>
				</li>
				<?php endforeach; ?>
			</ul>
			<div class="navigation__elements">
				<ul class="navigation__elements-list elements__list">
					<li>
						<a href="addUsers.php" class="elements__list-link">Добавить пользователя</a>
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