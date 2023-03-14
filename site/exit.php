<?php 
require "systems.php";
session_destroy();

// $sql = "INSERT INTO log (Event, id_user, Date, IP_adress, Browser) VALUES ('Пользователь вышел', :idusera, :data, :ipusera, :brows)";
// $query = $pdo->prepare($sql);
// $query->execute(array(
//     "idusera" => $_SESSION["id_user"],
//     "data" => date("Y d F G:i:s"),
//     "ipusera" => $_SERVER['REMOTE_ADDR'],
//     "brows" => $_SERVER['HTTP_USER_AGENT']
// ));
header("Location: /");
?>