<?php
    session_start();

    // Si le formulaire est envoyé
    if (isset($_POST['submitLogin'])) {

        // Se connecter à la base de données
        include "connexionBdd.php";
        // Extraire les infos du formulaire
        extract($_POST);

        // Vérifier que les champs ne soient pas vides
        if (!empty($emailAdress && !empty($password))) {

            // On nettoie l'adresse mail
            $emailAdress = filter_var($emailAdress, FILTER_SANITIZE_EMAIL);

            // On vérifie si l'adresse mail est valide
            if (filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
                
                // On hache le mdp
                $password = sha1($password);
                // On verifie si les données del'utilisateur correspondent à un utilisateur en bdd
                $selectUser = $db->query("SELECT * FROM `user` WHERE emailAdress = '$emailAdress' AND password = '$password'");


                // Si l'adresse mail et le mdp existe en bdd
                if ($selectUser->rowCount() > 0) {

                    $status = 'connecter';

                    // On update le status en "connecter"
                    $updateStatus = $db->query("UPDATE `user` SET status = '$status' WHERE emailAdress = '$emailAdress' AND password = '$password'");

                    // Si le status à été update
                    if ($updateStatus) {

                        // On stocke le mail de l'utilisateur dans une variable globale
                        $_SESSION['userMail'] = $emailAdress;
                        
                        // Et on redirige l'utilisateur vers la page de chat
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