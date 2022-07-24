    <?php
        session_start();
        include 'head.php';

        //se connecter à la base de donnée
        include "connexionBdd.php";


        if (isset($_SESSION['userMail'])) {

            // email de l'utilisateur
            $userMail = $_SESSION['userMail'] ;
        
            // on select l'utilisateur actuelle
            $user = $db->query("SELECT * FROM `users` WHERE emailAdress = '$userMail'");

            // si select réussie on stocke cesdonnées puis on les affiches
            if ($user->rowCount() > 0) {

                $dataUser = $user->fetchAll(pdo::FETCH_ASSOC)[0];
            }
        } else {
            header("Location: login.php");
        }

    ?>

    <body>
        
    <section class="container">
        <div class="formLeft">
            <div class="illustrationLeftHomeChat"></div>
        </div>
        <div class="formRight">
            <header class="top">
                <img class="imageProfil" src="assets/images/<?php echo $dataUser['image'];?>" alt="photo de profile">
                <div class="name">
                    <h1><?php echo $dataUser['firstName'] . ' aaaaaaaaaaaaaaaaaaaa' . $dataUser['lastName']?></h1>
                    <p class="status"><?php echo $dataUser['status']?></p>
                </div>
                <img class="imageStatus" src="assets/status.png" alt="status">
                <a class="logout" href="logout.php">Déconnexion</a>
            </header>
            <div class="infoSearch">
                <h2>Choississez un utilisateur</h2>
                <input type="search" placeholder="Recherché un utilisateur">
                <i class="fas fa-search"></i>
            </div>


            <div class="usersList">
                <?php
                    include 'usersList.php';
                ?>
                <div class="user">
                <div class="leftUser">
                        <img class="imageProfil" src="assets/photoProfile.png" alt="">
                        <div class="name">
                            <h3>Jean Pierre</h3>
                            <p class="message">Hello comment tu vas depuis le temps ?</p>
                        </div>
                    </div>
                    <img class="imageStatus" src="assets/status.png" alt="status">            
                </div>
                <div class="user">
                <div class="leftUser">
                        <img class="imageProfil" src="assets/photoProfile.png" alt="">
                        <div class="name">
                            <h3>Jean Pierre</h3>
                            <p class="message">Hello comment tu vas depuis le temps ?</p>
                        </div>
                    </div>
                    <img class="imageStatus" src="assets/status.png" alt="status">            
                </div>
                <div class="user">
                    <div class="leftUser">
                        <img class="imageProfil" src="assets/photoProfile.png" alt="">
                        <div class="name">
                            <h3>Jean Pierre</h3>
                            <p class="message">Hello comment tu vas depuis le temps ?</p>
                        </div>
                    </div>
                    <img class="imageStatus" src="assets/status.png" alt="status">            
                </div>
            </div>
        </div>
    </body>