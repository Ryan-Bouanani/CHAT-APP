<?php
    //se connecter à la base de donnée
    include "connexionBdd.php";
    $userMail = $_SESSION['userMail'];
    $usersQuery = $db->query("SELECT * FROM `users` WHERE NOT emailAdress = '$userMail'");
    $message = "";
    if ($usersQuery->rowCount() == 0) {
        $message .= "Il n'y a pas d'utilisateur pour le moment";
    } elseif ($usersQuery->rowCount() > 0) {
        # code...
    };
    echo $message;

?>