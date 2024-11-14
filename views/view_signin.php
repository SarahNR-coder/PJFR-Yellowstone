    <main>
        <div id="form-display">
            <form action="" method="post">
                <h1>Connexion</h1>         
                <div class="parent-input">
                    <label for="email">Entrez votre email</label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre email" required>
                    <p class="error-line" id="error-email-xss"></p>
                </div>
                <div class="parent-input">
                    <label for="password">Entrez votre mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de Passe" required>
                    <p class="error-line" id="error-pwd-xss"></p>
                </div>
                <div class="parent-button">
                    <input type="submit" name="Connexion">
                </div>
                <div class="parent-message">
                    <?php if($message !=""){
                            echo "<p style='background-color:red;color:white;font-weight:bold;font-size:15.5px;border-radius:4.5px;border:1px solid white;padding-top:7px;padding-bottom:7px;box-shadow: 3px 3px 3px black'>".$message."</p>";
                        }
                    ?>
                </div>
            </form>
        </div>
    </main>
