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
                    setlocale(LC_TIME, 'fr_FR');
                    date_default_timezone_set('Europe/Paris');
                    $dateSent = new DateTime($message['dateSent']);
                    $hourSent = new DateTime($message['dateSent']);
    

                    $dateSent = IntlDateFormatter::formatObject( 
                        $dateSent, 
                        'eeee d MMMM y', 
                        'fr' 
                      );
                    $hourSent = IntlDateFormatter::formatObject( 
                        $hourSent, 
                        'HH:mm', 
                        'fr' 
                      );
 
                    // si l'envoyeur est le compte actuelle
                    if ($message['userSenderId'] == $idSender) {
                    ?>
                            <span class="dateMessage"><?= $dateSent ?></span>
                        <div class="messageSend right">
                            <p><?= $message['message'] ?></p>
                        </div>
                        <span class="hourMessage right"><?= $hourSent ?></span>

                        <?php

                     // si l'envoyeur est le compte a qui s'adresse le message
                    } elseif ($message['userSenderId'] == $idReceiver) {
                    ?>
                        <span class="dateMessage right"><?= $dateSent ?></span>
                        <div class="messageSend left">
                            <p><?= $message['message'] ?></p>
                        </div>
                        <span class="hourMessage left"><?= $hourSent ?></span>
                        <?php
                    }
                }

            }
        } else {
                    // s'il n'y a pas encore de message
                    echo "<p class='messagingEmpty'>Messagerie vide</p>";
        }



?>





          