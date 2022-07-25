<?php
    session_start();
    if(isset($_SESSION['userMail'])){
        //se connecter à la base de donnée
        include "connexionBdd.php";

        // on update le status en offline
        $status = 'offline';
        $updateStatus = $db->prepare("UPDATE `users` SET status = '$status' WHERE 'emailAdress' = '$emailAdress'");

        if ($updateStatus) {

            //destruction de toute les sessions
            session_unset();
            session_destroy();

            // redirection vers la page de connexion
            header("Location:login.php");

        };

    } else {
        header("Location:login.php");
    };
?>