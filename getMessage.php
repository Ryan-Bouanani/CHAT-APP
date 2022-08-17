<?php
        session_start();

        if (!isset($_SESSION['userMail'])) {
            header('Location:login.php');
        };

        //se connecter à la base de donnée
        include "connexionBdd.php";

        $idReceiver = $_SESSION['idReceiver'];
        $idSender = $_SESSION['userId'];

        // requete pour récuperer les messages
        $queryMessage = $db->query("SELECT * FROM `message` WHERE (userSenderId = '$idSender' AND userReceiverId = '$idReceiver') OR (userSenderId = '$idReceiver' AND userReceiverId = '$idSender') ORDER BY message.id");

        // si il y'a des messages
        if ($queryMessage->rowCount() > 0) {

            while ($messages = $queryMessage->fetchAll(PDO::FETCH_ASSOC)) {
               

                // pour chaque message
                foreach ($messages as $message) {
                
                    // si l'envoyeur est le compte actuelle
                    if ($message['userSenderId'] == $idSender) {
                    ?>
                        <div class="messageSend right">
                            <p><?= $message['message'] ?></p>
                        </div>

                        <?php

                     // si l'envoyeur est le compte a qui s'adresse le message
                    } elseif ($message['userSenderId'] == $idReceiver) {
                    ?>
                        
                        <div class="messageSend left">
                            <p><?= $message['message'] ?></p>
                        </div>
                        <?php
                    }
                }

            }
        } else {
                    // s'il n'y a pas encore de message
                    echo "<p class='messagingEmpty'>Messagerie vide</p>";
        }



?>





          