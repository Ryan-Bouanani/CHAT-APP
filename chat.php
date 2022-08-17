<?php
        session_start();
        
        include 'head.php';

        if (!isset($_SESSION['userMail']) && !isset($_SESSION['userId'])) {
            header('Location:login.php');
        };
        
        //se connecter à la base de donnée
        include "connexionBdd.php";

        $_SESSION['idReceiver'] = $_GET['id'];
        $idReceiver = $_SESSION['idReceiver'];
        ?>
<body>
    <section class="container chat">
        <header class="top">
            <?php

                $idSender = $_SESSION['userId'];

                $user = $db->query("SELECT * FROM `user` WHERE id = $idReceiver");

                if ($user->rowCount() > 0) {
                    $dataUser = $user->fetchAll(pdo::FETCH_ASSOC)[0];
                } else {
                        header('Location:homeChat.php');
                }
            ?>
            <a href="homeChat.php"><div class="arrowReturn"></div></a>
                <div class="topLeft">
                    <img class="imageProfil" src="assets/images/<?= $dataUser['image'] ?>" alt="photo de profile">
                    <div class="name">
                        <h1><?= $dataUser['firstName'] ?></h1>
                        <p class="statusText"><?= $dataUser['status'] ?></p>
                    </div>
                </div>
                <i class="fas fa-circle status"></i>   
            </header>

            <div class="chatContainer">

            </div>
            <form  class="formMessage">         
                <textarea class="message" name="message" cols="30" rows="2" placeholder="Votre message ..."></textarea>
                <input type="submit" class="sendMessage" value="Envoyé" name="sendMessage">
            </form>

    </section>

    <script src="javascript/chat.js"></script>
</body>
</html>