<?php
    session_start();
    if(isset($_SESSION['userMail'])){
        //se connecter à la base de donnée
        include "connexionBdd.php";

        $emailAdress = $_SESSION['userMail'];

        // on update le status en offline
        $status = 'deconnecter';
        $updateStatus = $db->query("UPDATE `user` SET status = '$status' WHERE emailAdress = '$emailAdress'");

        // $updateStatus = $db->query("UPDATE `user` SET status = '$status' WHERE 'emailAdress' = '$emailAdress' AND `password` = '$password'");
        if ($updateStatus) {

            echo 'change';
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