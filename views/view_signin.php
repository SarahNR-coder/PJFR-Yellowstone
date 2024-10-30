<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scalCe=1.0">
    <meta name="description" content="La connexion à votre compte a lieu ici. Vous n'avez pas de compte? Rendez-vous à la page Inscription.">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style/styleForms.css">
    <link rel="stylesheet" href="./style/styleHome.css">
    <link rel="stylesheet" href="./style/active.css">
</head>
<body>
    <header>
        <nav class="navigationMenu">
            <ol>
                <li class="toPage logo"><a href="./index.php"><img id="logo" src="./img/logobison.webp" alt="Logo du site figurant un bison"></a></li>
                <li class="toPage toggle"><a href="#"><span>A propos</span></a></li>
                <li class="toPage toggle"><a href="#"><span>Venir au parc</span></a></li>
                <li class="toPage toggle"><a href="#"><span>La nature à Yellowstone</span></a></li>
                <li class="toPage toggle"><a href="#"><span>Activités</span></a></li>
                <li class="active <?php echo $classNavUnconnected ?>"><a href="./signin.php"><span>Connexion</span></a></li>
                <li class="<?php echo $classNavUnconnected ?>"><a href="./signup.php"><span>Inscription</span></a></li>
                <li class="<?php echo $classNavConnected ?>"><a href="./account.php"><span>Mon compte</span></a></li>
                <li class="<?php echo $classNavConnected ?>"><a href="deco.php"><span>Se déconnecter</span></a></li>
            </ol>
            <a href="javascript:void(0);" class="icon">
                <img class="imgHamburgerMenu" src="../icons/header/bars-solid.svg" alt="Menu Hamburger responsive">
            </a>
          </nav>
    </header>
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
    <footer>
        <a href="#">Réseaux sociaux</a>
        <a href="#">Nous contacter</a>
        <a href="#">Mentions légales</a>
    </footer>

<script src="./script/header.js"></script>   

</body>
</html>