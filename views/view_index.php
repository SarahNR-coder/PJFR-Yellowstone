          
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Connaissez vous Yellowstone? Instruisez-vous sur la nature unique du parc et bénéficiez des meilleures recommandations pour votre visite">
            <title>Parc Yellowstone : visiter et découvrir</title>
            <link rel="stylesheet" href="./style/styleHome.css">
            <link rel="stylesheet" href="./style/active.css">
        </head>
        <body>
            <header>
                <nav class="navigationMenu">
                <ol>
                    <li class="toPage logo active"><a href="./index.php"><img id="logo" src="./img/logobison.webp" alt="Logo du site figurant un bison"></a></li>
                    <li class="toPage toggle"><a href="#"><span>A propos</span></a></li>
                    <li class="toPage toggle"><a href="#"><span>Venir au parc</span></a></li>
                    <li class="toPage toggle"><a href="#"><span>La nature à Yellowstone</span></a></li>
                    <li class="toPage toggle"><a href="#"><span>Activités</span></a></li>
                    <li class="<?php echo $classNavUnconnected ?>"><a href="./signin.php"><span>Connexion</span></a></li>
                    <li class="<?php echo $classNavUnconnected ?>"><a href="./signup.php"><span>Inscription</span></a></li>
                    <li class="<?php echo $classNavConnected ?>"><a href="./account.php"><span>Mon compte</span></a></li>
                    <li class="<?php echo $classNavConnected ?>"><a href="deco.php"><span>Se déconnecter</span></a></li>
                </ol>
                    <a href="javascript:void(0);" class="icon">
                        <img class="imgHamburgerMenu" 
                        src="./icons/header/bars-solid.svg" 
                        alt="Menu Hamburger responsive">
                    </a>
                </nav>
            </header>
          <main>
                <div class="imageInBg">
                    <h1 class="textOverImage">
                        YELLOWSTONE NATIONAL PARK
                    </h1>
                </div>
                <section class="pagesMenu">
                    <h2 class="uppage-title">Plan de visite du site : les pages détaillées</h2>
                    <article class="pageTeaser  odd pageTeaserBg first">
                        <div class="imageBox background">
                            <a href="#"><img src="./img/home-symbole-NPS.webp" alt="Pointe de flèche, le symbole du National Park Service"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>A propos : le parc Yellowstone et le NPS</h3></a>
                            <p>En apprendre plus à propos du parc et de l’agence fédérale qui le gère, parmis un grand nombre de parcs nationaux aux Etats Unis et dont la mission est la préservation et la transmission.</p>
                        </div>
                    </article>
                    <article class="pageTeaser even">
                        <div class="imageBox">
                            <a href="#"><img src="./img/home-activites.webp" alt="Photographie de rafting"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>Les activités</h3></a>
                            <p>Venez pratiquer une activité dans le parc Yellowstone. Nous vous proposons des itinéraires de randonnées ou de participer à des activités organisées</p>
                        </div>
                    </article>
                    <article class="pageTeaser odd">
                        <div class="imageBox">
                            <a href="#"><img src="./img/home-yellowstone-entry.webp" alt="Photographie d'une entrée du parc de Yellowstone"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>Anticipez votre venue</h3></a>
                            <p>Retrouvez des informations pour organiser votre venue, pour une visite sans imprévus. Vous trouverez tous les détails pratiques mais aussi une billeterie en ligne.</p>
                        </div>
                    </article>
                    <article class="pageTeaser even pageTeaserBg">
                        <div class="imageBox background">
                            <a href="#"><img src="./img/home-key.webp" alt="Photographie d'une clé"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>Authentifiez-vous</h3></a>
                            <p>En étant connecté sur le site vous bénificierez d’avantages, premier lieu la possibilité d’interagir avec le contenu en metant des notes et des commentaires.</p>
                        </div>
                    </article>
                    <article class="pageTeaser odd">
                        <div class="imageBox">
                            <a href="#"><img src="./img/home-wolf.webp" alt="Photographie d'un loup"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>Faune, flore et autre</h3></a>
                            <p>Venez apprécier la vie sauvage  mais aussi les phénomènes géologolique des lieux, en parcourant des fiches scientifiques détaillées.</p>
                        </div>
                    </article>
                    <article class="pageTeaser even pageTeaserBg">
                        <div class="imageBox background">
                            <a href="#"><img src="./img/home-user.webp" alt="Image par défaut de compte utilisateur"></a>
                        </div>
                        <div class="textBox">
                            <a href="#"><h3>Créez un compte</h3></a>
                            <p>Inscrivez-vous. Vous trouverez dans votre compte vos informations, vos achats passés et toute votre activité : les notes et les commentaires.</p>
                        </div>
                    </article>
                </section>
            </main>
            <footer>
                <a href="#">Réseaux sociaux</a>
                <a href="#">Nous contacter</a>
                <a href="#">Mentions légales</a>
                <script src="./script/header.js"></script>
            </footer>
        </body>
    </html>
