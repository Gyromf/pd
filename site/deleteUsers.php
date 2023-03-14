<?php
    require "db.php";

    $sqlId = "SELECT * FROM `users` WHERE `id_user` = ?";
    $queryId = $pdo->prepare($sqlId);
    $queryId->execute(array($_GET["id"]));
    $usersID = $queryId->fetch(PDO::FETCH_ASSOC);
    $idUsers = $usersID["id_user"];
    echo $idUsers;
    $sqlId = "SELECT * FROM `students` WHERE `id_user` = ?";
    $queryId = $pdo->prepare($sqlId);
    $queryId->execute(array($_GET["id"]));
    $studentsID = $queryId->fetch(PDO::FETCH_ASSOC);
    $idStudents = $studentsID["id_student"];

    $data = [
        'date' => $idStudents
    ];

    $sqlDeleteAccounting = "DELETE FROM `accounting` WHERE `accounting`.`id_students` = :date";
    $sqlDeleteAccounting = $pdo->prepare($sqlDeleteAccounting);
    $sqlDeleteAccounting->execute($data);
    $sqlDeleteAccounting->fetch(PDO::FETCH_ASSOC);

	$sqlDeleteStudents = "DELETE FROM `students` WHERE `id_user` = ?";
    $sqlDeleteStudents = $pdo->prepare($sqlDeleteStudents);
    $sqlDeleteStudents->execute(array($_GET["id"]));
    $sqlDeleteStudents->fetch(PDO::FETCH_ASSOC);

    $sql = "DELETE FROM `users` WHERE `id_user` = ?";
    $query = $pdo->prepare($sql);
    $query->execute(array($_GET["id"]));
    $users = $query->fetch(PDO::FETCH_ASSOC);
    header("Location: user.php?id=$id");

?>