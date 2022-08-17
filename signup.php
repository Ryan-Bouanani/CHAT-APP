<?php
    session_start();

    if (isset($_SESSION['userMail'])) {
        header('Location:homeChat.php');
    };
    
    include 'head.php';
?>
<body>
    <section class="container">
        <div class="formLeft">
            <div class="illustrationFormLeft"></div>
        </div>
        <div class="formRight">
            <h1>INSCRIPTION</h1>
            <form action="signupProcessing.php" enctype="multipart/form-data" method="POST">
                <div class='errorDiv'>
                <?php
                    if (isset($_GET['error'])) {
                        echo "<p class='errorMessage'>" . $_GET['error'] . "</p>";
                    };
                ?>
                </div>
                <div class="fullName">
                    <div class="firstName">
                        <label for="firstName">Prenom</label>
                        <input type="text" id="firstName"  name="firstName" placeholder="Entrez votre prenom" required value="<?= htmlentities($_POST['firstName'] ?? '')?>" >
                    </div>
                    <div class="lastName">
                        <label for="lastName">Nom</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Entrez votre nom" required value="<?= htmlentities($_POST['lastName'] ?? '')?>">
                    </div>
                </div>
                <div class="emailAdress">
                    <label for="emailAdress">Adresse mail</label>
                    <input type="email" id="emailAdress" name="emailAdress" placeholder="Entrez votre adresse mail" required value="<?= htmlentities($_POST['emailAdress'] ?? '')?>">
                </div>
                <div class="password">
                    <label for="password1">Mot de passe</label>
                    <input type="password" id="password1" name="password1" placeholder="Entrez un mot de passe"class="mdp2" required value="<?= htmlentities($_POST['password1'] ?? '')?>">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <div class="password">
                    <label for="password2">Confirmer votre mot de passe</label>
                    <input type="password" id="password2"
                    name="password2" placeholder="Confirmer votre mot de passe" class="mdp2" required value="<?= htmlentities($_POST['password2'] ?? '')?>">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <div class="image">
                    <label for="imageProfil">Choisissez une image</label>
                    <input type="file" id="imageProfil" name="imageProfil" accept="image/x-png,image/gif,image/jpeg,image/jpg" required value="">
                </div>
                <div class="formSubmit">
                    <input type="submit" name="submitSignup" value="S'inscrire">
                </div>
            </form>
            <div class="allReadySignup">
                <p>Deja Inscrit(e) ? <a href="login.php">Se Connecter</a></p>
            </div>
        </div>
    </section>

    <script src="javascript/index.js"></script>
</body>
</html>