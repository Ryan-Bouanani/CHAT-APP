<?php
    session_start(); 

    if (!isset($_SESSION['userMail'])) {
        header('Location:login.php');
    };

    //se connecter à la base de donnée
    include "connexionBdd.php";

    // on recupere le mail de l'utilisateur connecté
    $userMail = $_SESSION['userMail'];
    $searchUser = $_POST['searchUser'];

    // requete pour récuperer les messages
    $usersQuery = $db->query("SELECT * FROM `user`  WHERE NOT emailAdress = '$userMail' AND (firstName LIKE '%$searchUser%' OR lastName = '%$searchUser%')");

    $renderedUser = "";

    if ($usersQuery->rowCount() > 0) {
        include "userListData.php";
    }
    // on affiche le rendue
    echo $renderedUser;
?>