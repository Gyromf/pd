<?php 

        require "systems.php";
        @
        $id = $_SESSION["rule"];
        @
        $idUser =  $_SESSION["id_user"];
  
        if($id == 20){
          $sql = "SELECT * FROM `students` WHERE students.id_user = $idUser";
          $query = $pdo->prepare($sql);
          $query->execute();
          $students = $query->fetchAll(PDO::FETCH_ASSOC);
          
        } else{
          $sql = "SELECT * FROM `students`";
          $query = $pdo->prepare($sql);
          $query->execute();
          $students = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        if(isset($_POST["login"]) && isset($_POST["password"])) {
            $sql = "SELECT * FROM users WHERE user_login = :login AND BINARY user_password = :password";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "login" => $_POST["login"],
                "password" => $_POST["password"]
            ));
            if($query->rowCount() == 1) {
                $user = $query->fetch(PDO::FETCH_ASSOC);
                saveAuth($user["id_user"]);
                header("Location: /index.php");
            }

        }

        else {}
        
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Такси</title>
  </head>
  <body>
    <div class="wrapper">
      <header class="header">
        <div class="header__container container">
          <nav class="header__menu">
            <ul class="header__list">
               <?php if(checkRule() >= 10): ?>
                  <!-- <li><a href="" class="header__link">Регистрация</a></li> -->
                  <li>Ваше имя: <span class="header__name"> <?=$_SESSION['name']?> </span></li>
                  <li>
                    Ваша должность: <span class="header__role"><?=$_SESSION["role_name"]?> </span>
                  </li>
                  <?php if(checkRule() > 49): ?>
                    <li>
                      <a class="header__link" href="user.php">Пользователи</a> <! -- Сдесб должны показываться только пользователи -->
                    </li>
                    <li>
                      <a class="header__link" href="user.php">Автомобили</a> <! -- А вот тут уже только машины -->
                    </li>
                    <li>
                      <a class="header__link" href="additems.php">Редактировать водителя</a> <! -- изначально-добавить предмет, но нужно сделать редактор водителей(проставить стаж и тд.)-->
                    </li>
                  <li>
                      <a class="header__link" href="Deleteitems1.php">Редактировать автомобиль</a> <! -- изначально-удалить предмет, но нужно сделать редактор машин по типу редактора водителей -->
                    </li>
                  <li>
                      <a class="header__link" href="">шаблон</a> <! -- сюда нужно запихнуть печать шаблона -->
                    </li>
                   <?php endif?>
                  <li>
                    <a class="header__link" href="exit.php">Выход</a>
                  </li>
               <?php else: ?>
              <li><a data-modal href="#" class="header__link">Войти </a></li>
                <?php endif; ?> 
            </ul>
          </nav>
        </div>
      </header>
      <main class="main">
        <div class="main__container container">
          <div class="main__title">
            <h3>Список водителей:</h3> <! -- список учеников -->
          </div>
          <ul class="main__list">
            <?php if(checkRule() > 5): ?>
              <?php foreach($students as $item): ?>
                <li>
                  <a href="journal.php?id=<?=$item["id_student"]?>" class="main__list-link"><?=$item["nameFIO_student"]?></a>
                </li>   
              <?php endforeach; ?>
            <?php endif ?>
          </ul>
        </div>
      </main>
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
    <script src="script/modal.js"></script>
  </body>
</html>
