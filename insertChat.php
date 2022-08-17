
<?php
    session_start();

    // if (!isset($_SESSION['userMail'])) {
    //     header('Location:login.php');
    // };
            //se connecter à la base de donnée
            include "connexionBdd.php";

    $idReceiver = $_SESSION['idReceiver'];
    $idSender = $_SESSION['userId'];
    if (isset($_POST['message'])) {

        $message = $_POST['message'];

        // on vérifie que le message ne soit pas vide
        if (!empty($message)) {

            // on insert le message envoyé dans la bdd
            $insertMessage = $db->query("INSERT INTO `message` (userSenderId, userReceiverId, message, dateSent) VALUES ('$idSender', '$idReceiver', '$message', NOW())");

            //on actualise la page
            // header('location:chat.php?id=' . $idReceiver);
        } else {
            // si le message est vide , on actualise la page
            header('location:chat.php?id=' . $idReceiver);
        }
    }

?>