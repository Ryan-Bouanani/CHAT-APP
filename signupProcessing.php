<?php
    session_start();


    //si le formulaire est envoyé
    if (isset($_POST['submitSignup'])) {

        //se connecter à la base de donnée
        include "connexionBdd.php";
        //extraire les infos du formulaire
        extract($_POST);

        // verifier que les champs ne sont pas vides
        if (!empty($firstName) && !empty($lastName) && !empty($emailAdress) && !empty($password1) && !empty($password2) ) {

            //on vérifie si les mots de passes sont conformes            
            if ($password1 === $password2) {
                $emailAdress = filter_var($emailAdress, FILTER_SANITIZE_EMAIL);

                // on vérifie si l'adresse mail est valide
                if (filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) {
                    // on vérfie si le mail est déja utilisé
                    $selectMail = $db->query("SELECT `emailAdress` FROM `users` WHERE emailAdress = '$emailAdress'");

                    // si l'adresse mail est déja utilisé alors erreur
                    if ($selectMail->rowCount() === 0) {

                        // si l'image est valide
                        if (isset($_FILES['imageProfil'])) {
                            $imageType = $_FILES['imageProfil']['type'];
                            $imageName = $_FILES['imageProfil']['name'];
                            $ImageTmpName = $_FILES['imageProfil']['tmp_name'];


                            var_dump($_FILES['imageProfil']);

                            $imageExplode = explode('.', $imageName);
                            $imageExtension = end($imageExplode);

                            $extensionsImg = ["png", "jpeg", "jpg"];
                            if (in_array($imageExtension, $extensionsImg)) {

                                $formatsImage = [
                                    "image/jpeg", 
                                    "image/jpg", 
                                    "image/png"
                                ];

                                // on reverifie l'image
                                if (in_array($imageType, $formatsImage)) {

                                    // on renomme l'image de manier securisé
                                    $time = time();
                                    $newImageName = $time . $imageName;

                                    // on deplace l'image avec son nouveau nom vers notre dossier assets
                                    if (move_uploaded_file($ImageTmpName, 'assets/images/' . $newImageName)) {

                                        // on hache le mdp
                                        $password = sha1($password1);
                                        $status = "connecté";

                                        
                                        // on insert notre nouvelle utilisateur
                                        $insertNewUser = $db->query("INSERT INTO `users`(`firstName`, `lastName`, `emailAdress`,`password`, `image`, `status`) VALUES ('$firstName', '$lastName', '$emailAdress', '$password', '$newImageName', '$status')");


                                        // si l'insertion est reussie
                                        if ($insertNewUser) {
                
                                                $_SESSION['userMail'] = $emailAdress;
    
                                                // l'utilisateur est maintenant connecté
                                                $_SESSION['is_connected'] = true;
                                                
                                                // redirection vers la page chat
                                                header("Location:homeChat.php");
                                                
                                        } else {
                                            $error = urlencode('L\'inscription a échouée merci de réessayer');
                                            header('Location:signup.php?error=' . $error);  
                                        }
                                        
                                    } else {
                                        $error = urlencode('Le téléchargementde votre image a échoué veuiller réessayer');
                                        header('Location:signup.php?error=' . $error);   
                                    }


                                    

                                } else {
                                    $error = urlencode('Entrer une image valide de type "png", "jpeg" ou "jpg"');
                                    header('Location:signup.php?error=' . $error);
                                }   
                                         
                            } else {
                                $error = urlencode('Entrer une image valide de type "png", "jpeg" ou "jpg"');
                                header('Location:signup.php?error=' . $error);
                            }
                        } 
                    } else {
                        $error = urlencode('Cette adresse mail existe deja !');
                        header('Location:signup.php?error=' . $error);
                    }

                    
                } else {
                    $error = urlencode('Cette adresse mail n\'est pas valide !');
                    header('Location:signup.php?error=' . $error);
                }

            } else {
                $error = urlencode('Les Mots de passes ne sont pas identiques !');
                header('Location:signup.php?error=' . $error);
            }
        } else {
            $error = urlencode("Veuillez remplir tous les champs !");
            header('Location:signup.php?error=' . $error);
        }
    }
?>