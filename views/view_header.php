<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scalCe=1.0">
    <meta name="description" content="La connexion à votre compte a lieu ici. Vous n'avez pas de compte? Rendez-vous à la page Inscription.">
    <title>FeelYellowstone</title>
    <?php echo ($current_page == 'account.php')? '<link rel="stylesheet" href="./style/styleAccount.css">' : ''; ?>
    <link rel="stylesheet" href="./style/styleHome.css">
    <link rel="stylesheet" href="./style/active.css">
    <?php echo ($current_page == 'signin.php' || $current_page == 'signup.php')? '<link rel="stylesheet" href="./style/styleForms.css">' : ''; ?>
</head>
<body>
    <header>
        <nav class="navigationMenu">
            <ol>
                <li class= "toPage logo <?php echo ($current_page == 'index.php')? 'active' : ''; ?>" ><a href="./index.php"><img id="logo" src="./img/logobison.webp" alt="Logo du site figurant un bison"></a></li>
                <li class="toPage toggle <?php echo ($current_page == 'about.php')? 'active' : ''; ?>"><a href="#"><span>A propos</span></a></li>
                <li class="toPage toggle <?php echo ($current_page == 'visit.php')? 'active' : '';?>" ><a href="#"><span>Venir au parc</span></a></li>
                <li class="toPage toggle <?php echo ($current_page == 'nature.php')? 'active' : '';?>"><a href="#"><span>La nature à Yellowstone</span></a></li>
                <li class="toPage toggle <?php echo ($current_page == 'activities.php')? 'active' : '';?>"><a href="#"><span>Activités</span></a></li>
                <li class="<?php echo $visibleUnconnectedUser ?> <?php echo ($current_page == 'signin.php')? 'active' : '';?>"><a href="./signin.php"><span>Connexion</span></a></li>
                <li class="<?php echo $visibleUnconnectedUser ?> <?php echo ($current_page == 'signup.php')? 'active' : '';?>"><a href="./signup.php"><span>Inscription</span></a></li>
                <li class="<?php echo $visibleConnectedUser ?> <?php echo ($current_page == 'account.php')? 'active' : '';?>"><a href="./account.php"><span>Mon compte</span></a></li>
                <li class="<?php echo $visibleConnectedUser ?>"><a href="deco.php"><span>Se déconnecter</span></a></li>
            </ol>
            <a href="javascript:void(0);" class="icon">
                <img class="imgHamburgerMenu" src="./icons/header/bars-solid.svg" alt="Menu Hamburger responsive">
            </a>
          </nav>
    </header>