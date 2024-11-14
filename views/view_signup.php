    <main>
        <div id="form-display">
            <form method="post">
                <h1>Inscription</h1>
                <div class="parent-input">
                    <label for="pseudo">Choisissez votre pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                    <p class="error-line" id="error-pseudo"></p>
                    <p class="error-line" id="error-pseudo-xss"></p>
                </div>
                <div class="parent-input">
                    <label for="email">Entrez votre email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <p class="error-line" id="error-email"></p>
                    <p class="error-line" id="error-email-xss"></p>
                </div>
                <div class="parent-input">
                    <label for="passwordOne">Entrez votre mot de passe</label>
                    <input type="password" name="password-one" id="password-one" placeholder="Mot de Passe" required>
                    <p class="error-line" id="error-length"></p>
                    <p class="error-line" id="error-decimal"></p>
                    <p class="error-line" id="error-special"></p>
                    <p class="error-line" id="error-fstpwd-xss"></p>
                </div>
                <div class="parent-input">
                    <label for="passwordTwo">Répétez votre mot de passe</label>
                    <input type="password" name="password-two" id="password-two" placeholder="Confirmation Mot de Passe" required>
                    <p class="error-line" id="error-match"></p>
                    <p class="error-line" id="error-scdpwd-xss"></p>
                    <p class="error-line" id="error-disabled"></p>
                </div>
                <div class="parent-button">
                    <input type="submit" name="Inscription">
                </div>
                <div class="parent-message">
                    <p id="form-no-valid"></p>
                    <?php if($message !=""){
                        echo "<p style='background-color:red;color:white;font-weight:bold;font-size:15.5px;border-radius:4.5px;border:1px solid white;padding-top:7px;padding-bottom:7px;box-shadow: 3px 3px 3px black'>".$message."</p>";
                    }
                    ?>
                </div>                
            </form>
        </div>
    </main>
