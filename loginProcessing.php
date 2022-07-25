
<?php
    session_start();

    //si le formulaire est envoyé
    if (isset($_POST['submitLogin'])) {

        //se connecter à la base de donnée
        include "connexionBdd.php";
        //extraire les infos du formulaire
        extract($_POST);

        // vérifier que les champs ne sont pas vides
        if (!empty($emailAdress && !empty($password))) {
            echo $emailAdress . 'et' . $password;

            // on nettoie l'adresse mail
            $emailAdress = filter_var($emailAdress, FILTER_SANITIZE_EMAIL);

            // on vérifie si l'adresse mail est valide
            if (filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
                
                // on hache le mdp
                $password = sha1($password);
                // on verifie si les données del'utilisateur corresponde à un user en bdd
                $selectUser = $db->query("SELECT * FROM `users` WHERE emailAdress = '$emailAdress' AND password = '$password'");


                // si l'adresse mail et le mdp existe en bdd
                if ($selectUser->rowCount() > 0) {

                    $status = 'online';

                    // on update le status en online
                    $updateStatus = $db->query("UPDATE `users` SET status = '$status' WHERE 'emailAdress' = '$emailAdress' AND `password` = '$password'");

                    if ($updateStatus) {

                        $_SESSION['userMail'] = $emailAdress;
                        
                        $_SESSION['is_connected'] = true;

                        //redirection vert la page chat
                        header("Location:homeChat.php");
                    } else {
                        $error = urlencode('Une erreur est survenue veuillez réessayer');
                        header('Location:login.php?error=' . $error);
                    }

                } else {
                    $error = urlencode('Vos identifiants sont incorrects !');
                    header('Location:login.php?error=' . $error);
                }



            } else {
                $error = urlencode('Veuillez entrez une adresse mail valide !');
                header('Location:login.php?error=' . $error);
            }

        } else {
            $error = urlencode('Veuillez remplir tous les champs !');
            header('Location:login.php?error=' . $error);   
        }
    }
?>