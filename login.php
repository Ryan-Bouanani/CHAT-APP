
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
            <h1>CONNEXION</h1>
            <form action="loginProcessing.php" method="post">
                <div class='errorDiv'>
                    <?php
                        if (isset($_GET['error'])) {
                            echo "<p class='errorMessage'>" . $_GET['error'] . "</p>";
                        };
                    ?>
                </div>
                <div class="emailAdress">
                    <label for="emailAdress">Adresse mail</label>
                    <input type="email" name="emailAdress" placeholder="Entrez votre adresse mail" required>
                </div>
                <div class="password">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="Entrez votre mot de passe" required>
                    <i class="fas fa-eye-slash"></i>
                </div>
                <div class="formSubmit">
                    <input type="submit" name="submitLogin" value="Se connecter">
                </div>
            </form>
            <div class="allReadySignup">
                <p>Pas encore Inscrit(e) ? <a href="signup.php">S'inscrire</a></p>
            </div>
        </div>
    </section>

    <script src="javascript/index.js"></script>
</body>
</html>