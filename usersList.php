<?php
    //se connecter à la base de donnée
    include "connexionBdd.php";

    // on recupere le mail de l'utilisateur connecté
    $userMail = $_SESSION['userMail'];

    // on select tout les users sauf l'utilisateur principal
    $usersQuery = $db->query("SELECT * FROM `users` WHERE NOT emailAdress = '$userMail'");

    $renderedUser = "";
    if ($usersQuery->rowCount() == 0) {
        $renderedUser .= "Il n'y a pas d'utilisateur pour le moment";
    } elseif ($usersQuery->rowCount() > 0) {
       
        while ($users = $usersQuery->fetchAll(PDO::FETCH_ASSOC)) {

            foreach ($users as $userKey => $user) {
           
            ($user['status'] === 'online') ? $status[$userKey] = 'online' : $status[$userKey] = '' ;
                $renderedUser .=  '<a href="chat.php?id='. $user['id'] .'">

                <div class="user">
                    <div class="leftUser">
                        <img class="imageProfil" src="assets/images/' . $user['image'] . '" alt="">
                        <div class="name">
                            <h3>' . $user['firstName'] . ' ' . $user['lastName'] . '</h3>
                            <p class="message"></p>
                        </div>
                    </div>
                    <div class="status ' . $status[$userKey] . 
                    '">
                        <i class="fas fa-circle"></i>
                    </div>          
                </div>';
            };
        };
    };
    echo $renderedUser;

?>