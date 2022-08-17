    <?php
        session_start();

        include 'head.php';

        if (!isset($_SESSION['userMail'])) {
            header('Location:login.php');
        };

        //se connecter à la base de donnée
        include "connexionBdd.php";


        if (isset($_SESSION['userMail'])) {

            // email de l'utilisateur
            $userMail = $_SESSION['userMail'] ;
        
            // on select l'utilisateur actuelle
            $user = $db->query("SELECT * FROM `user` WHERE emailAdress = '$userMail'");

            // si select réussie on stocke ces données puis on les affiches
            if ($user->rowCount() > 0) {

                $dataUser = $user->fetchAll(pdo::FETCH_ASSOC)[0];

                // on stock l'id de l'utilisateur actuelle
               $_SESSION['userId'] = $dataUser['id'];
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
                <div class="topLeft">
                    <img class="imageProfil" src="assets/images/<?= $dataUser['image'];?>" alt="photo de profile">
                    <div class="name">
                        <h1><?= $dataUser['firstName'] . ' ' . $dataUser['lastName']?></h1>
                        <p class="statusText"><?= $dataUser['status']?></p>
                    </div>
                </div>
                <i class="fas fa-circle status"></i> 
                <i class="fas fa-search searchIcon"></i>    
            </header>
            
            <input class="searchInput" type="search" name="searchInput" placeholder="Recherché un utilisateur">
            <h2 class="h2">Choississez un utilisateur</h2>


            <div class="usersList">
            </div> 
            <a class="logout" href="logout.php">Déconnexion</a>
        </div>

        
        <script src="javascript/homeChat.js"></script>
    </body>

    </html>