<main>
        <div id="form-display">
            <form method="post">
                <h1>Inscription</h1>
                <div class="parent-input">
                    <label for="pseudo">Choisissez votre pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                </div>
                <div class="parent-input">
                    <label for="email">Entrez votre email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="parent-input">
                    <label for="originalPwd">Entrez votre mot de passe</label>
                    <input type="password" name="originalPwd" id="originalPwd" placeholder="Mot de Passe" required>
                </div>
                <div class="parent-input">
                    <label for="confirmationPwd">Répétez votre mot de passe</label>
                    <input type="password" name="confirmationPwd" id="confirmationPwd" placeholder="Confirmation Mot de Passe" required disabled>
                </div>
                <div class="parent-message">
                    <?php if(isset($message)){
                        if($message !=""){
                            echo "<p id='errSubmitMssg'>{$message}</p>";
                        }
                    }?>
                </div>          
                <div class="parent-button">
                    <input type="submit" name="Inscription">
                </div>
            </form>
        </div>
    </main>
