<?php

    session_start();    

    if (!isset($_SESSION['userMail'])) {
            header('Location:login.php');
    };
    
    //se connecter à la base de donnée
     include "connexionBdd.php";

    // on recupere le mail de l'utilisateur connecté
    $userMail = $_SESSION['userMail'];

    // on select tout les users sauf l'utilisateur principal
    $usersQuery = $db->query("SELECT * FROM `user` WHERE NOT emailAdress = '$userMail'");

    $renderedUser = "";

    // si la requette ne trouve pas d'utilisateurs
    if ($usersQuery->rowCount() == 0) {

        $renderedUser .= "Il n'y a pas d'utilisateur trouvés pour le moment";

    // sinon on affiche les autres utilisateurs
    } elseif ($usersQuery->rowCount() > 0) {
       
        include "userListData.php";
    }
    // on affiche le rendue
    echo $renderedUser;

?>
