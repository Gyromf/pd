<?php
    require "systems.php";

    global $pdo;

    $sql = "SELECT * FROM `students` WHERE id_student = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_GET["id"]));
    $student = $query->fetch(PDO::FETCH_ASSOC);
    $idItem = $student["id_student"];

    $sql = "SELECT * FROM `items`";
    $query = $pdo->prepare($sql);
    $query->execute();
    $items = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT * FROM `students`";
    $query = $pdo->prepare($sql);
    $query->execute();
    $students = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM `accounting` WHERE id_students = $idItem" ;
    $query = $pdo->prepare($sql);
    $query->execute();
    $marks = $query->fetchAll(PDO::FETCH_ASSOC);
    echo checkrule();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Журнал</title>
  </head>
  <body>
    <div class="wrapper">
      <main class="main">
        <div class="main__page container">
          <div class="main__table">
            <ul class="main__table-list main__list">
              <?php foreach($items as $i): ?>
                <li class="main__list-elements">
                  <div class="column__left-text"><?=$i["item_name"]?></div>
                      <ul class="main__sublist">
                        <?php foreach($marks as $j): ?>
                          <?php if ($i["id_items"] == $j["id_items"]): ?>
                              <li><a class="main__sublist-link" href=""><?=$j["mark"]?></a></li> 
                          <?php endif ?>
                        <?php endforeach; ?> 
                      </ul>
                </li>
              <?php endforeach; ?>
            </ul>
            <?php if(checkRule() > 44): ?>
                <div class="main__add">
                <a href="addMarks.php?id=<?=$idItem ?>" class="main__mark">
                    Поставить оценку
                </a>
                </div>
            <?php endif?>
          </div>
        </div>
      </main>
      <footer class="footer">
        <div class="footer__back">
          <a class="footer__back-link" href="index.php">Назад</a>
        </div>
      </footer>
    </div>
    <div class="modal hide">
      <div class="modal__dialog">
        <div class="modal__content">
          <form method="post" action="">
              <div data-close class="modal__close">&times;</div>
              <div class="modal__title">Вход</div>
              <ul>
                <li><input name="login" type="text" maxlength="128" placeholder= "Ваш логин" /></li>
                <li><input name="password" type="password" maxlength="128" placeholder= "Ваш пароль"/></li>
              </ul>
              <button class="button">Войти</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
