<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scalCe=1.0">
    <meta name="description" content="La connexion à votre compte a lieu ici. Vous n'avez pas de compte? Rendez-vous à la page Inscription.">
    <title>Connexion</title>
    <link rel="stylesheet" href="./style/styleAccount.css">
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
                <li class="<?php echo $classNavUnconnected ?>"><a href="./signin.php"><span>Connexion</span></a></li>
                <li class="<?php echo $classNavUnconnected ?>"><a href="./signup.php"><span>Inscription</span></a></li>
                <li class="<?php echo $classNavConnected ?> active"><a href="./account.php"><span>Mon compte</span></a></li>
                <li class="<?php echo $classNavConnected ?>"><a href="deco.php"><span>Se déconnecter</span></a></li>
            </ol>
            <a href="javascript:void(0);" class="icon">
                <img class="imgHamburgerMenu" src="../icons/header/bars-solid.svg" alt="Menu Hamburger responsive">
            </a>
          </nav>
    </header>
    <main>
        <section>
            <h1>Mon Compte</h1>
            <p>Pseudo: <?php echo $pseudo ?></p>
            <p>Nom : <?php echo $nameUser ?></p>
            <p>Prénom : <?php echo $firstnameUser ?></p>
            <p>Email : <?php echo $email ?></p>
        <section>
    </main>
    <footer>
        <a href="#">Réseaux sociaux</a>
        <a href="#">Nous contacter</a>
        <a href="#">Mentions légales</a>
        <script src="./script/header.js"></script>
    </footer>
</body>
</html>