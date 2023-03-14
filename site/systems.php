<?php
    require "db.php";
    session_start();
    function saveAuth($id) {
        global $pdo;
        $_SESSION["id"] = $id;
        $sql = "SELECT * FROM users, groups where users.id_group = groups.id_group and users.id_user = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
		  
        $_SESSION["rule"] = $user["group_rules"];
        $_SESSION["login"] = $user["user_login"];
        $_SESSION["role_name"] = $user["group_name"];
        $_SESSION["id_user"] = $user["id_user"];
        $_SESSION["name"] = $user["name_user"];
        $_SESSION["password"] = $user["user_password"];
    }
   
    function checkRule() {
        global $pdo;
        if(isset($_SESSION["id"]) && isset($_SESSION["rule"]) && isset($_SESSION["login"])) {
            $sql = "SELECT id_user, name_user, group_rules  FROM users JOIN groups WHERE users.id_group = groups.id_group AND id_user = :id";
            $query = $pdo->prepare($sql);
            $query->execute(array(
                "id" => $_SESSION["id"]
            ));
            $user = $query->fetch(PDO::FETCH_ASSOC);
            if($_SESSION["rule"] == $user["group_rules"]) {
                return $_SESSION["rule"];
            }
            else {
                $_SESSION["rule"] = $user["group_rules"];
                return $user["group_rules"];
            }
        }
        else {
            return 5;
        }
    }
?>