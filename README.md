## PJFR-Yellowstone ##

# Contours du projet #
Dans le cadre d'un projet de formation je travaille sur le projet d'un site web appelé feelyellowstone.com dédié au parc national de Yellowstone, un parc naturel des Etats-Unis d'Amérique. Afin d'établir un contexte autour de celui-ci, j'ai simulé avoir été embauchée par le National Park Service, l'agence fédérale américaine en charge de sa gestion. 

Ce site web est destiné à fournir des informations utiles pour la visite du parc, ainsi que des connaissances sur sa faune, sa flore et ses éléments géologiques uniques. Il hébergera également une boutique en ligne permettant d'acheter des billets d'entrée. Mais sa caractéristique la plus originale réside dans l'interactivité avec l'utilisateur connecté, puisqu'il lui est donné la possibilité d'évaluer ou de commenter certains contenus. L'objectif est d'amener les inscrits à un sentiment d'engagement et de faire en sorte que les nouveaux venus soient plus attirés par le site web, car il leur paraitra vivant. 

Le projet présente de nombreux avantages. Le contexte choisi donne de la crédibilité à feelyellowstone.com puisqu'il est commandé par le NPS et qu'il s'agit donc d'un site officiel. Cela garantit la confiance des utilisateurs. De plus, il est prévu de le rendre multilingue, ce qui signifie que de plus en plus de personnes le visiteront. Son interactivité séduira également. 

Il présente toutefois l'inconvénient de répéter des contenus que l'on peut trouver sur d'autres sites web, mais il centralise ainsi toutes les informations. 

Le site web s'adresse principalement aux Américains, mais il atteindra un public beaucoup plus large en devenant multilingue. Les citoyens américains sont le public le plus intéressé en raison de leur proximité avec le parc et parce qu'ils s'intéressent à leur propre pays et à ses caractéristiques.

# Compétences techniques exploitées jusqu'à présent #

- Réaliser des pages statiques correspondant à la maquette du projet - HTML5, CSS3

- Réaliser des animations - CSS3

- Adapter le contenu à la résolution (desktop, tablette, mobile) - media queries CSS3

- Implémenter des fonctionnalités frontend : Javascript
    -> menu hamburger à petite résolution : 
        au clic affiche ou masque les éléments de navigation
    -> vérification des éléments de saisie au formulaire : 
        on confronte les saisies utilisateur aux expressions régulières et aux contraintes auxquels elles doivent correspondre et informe l'utilisateur sur la validité de sa saisie

- Implémenter des fonctionnalités backend : fonctionnalité d'inscription et fonctionnalité connexion:
    INSCRIPTION
    -> Une base de données est créée au préalable avec une table utilisateur - SQL
    -> Un formulaire d'inscription est créé - HTML5/CSS3
    -> A partir d'un email saisi, si il n'y a pas d'utilisateur avec cet email enregistré en base de données on crée cet utilisateur - PHP/SQL

    -> On connecte l'utilisateur, c'est à dire qu'on enregistre les données de l'utilisateur dans des super globales $_SESSION accessibles dans toutes les pages activant la session, et on adapte le site accordément - PHP

    CONNEXION
    -> Un formulaire de connexion est aussi créé - HTML5/CSS3
    -> PHP/SQL - On compare les données saisies dans le formulaire, email et mot depasse, avec les données d'un enregistrement utilisateur en base de données avec cet email:
    Si on ne trouve pas d'enregistrement c'est que l'utilisateur n'est pas inscrit. 
    Sinon l'utilisateur est inscrit et il faut regarder la concordance entre le mot de passe saisi et le mot de passe hashé par mesure de sécurité se trouvant dans la base de données. 
    -> PHP - On connecte l'utilisateur si email et mot de passes  correspondent à un enregistrement utilisateur en base de données

    ETAT CONNECTE
    -> PHP - Lorsque l'on est déconnecté on a accès aux liens de navigation vers les pages connexion et inscription tandis que lorsque l'on est connecté ces liens de pages ne sont pas accessible et à la place se trouvent ceux pour la déconnexion et l'accès au compte personnel

    COMPTE PERSONNEL
    -> PHP - La page compte personnel active la session et affiche les données utilisateurs stockées dans les super globales $_SESSION, c'est à dire les données de l'utilisateur connecté

    DECONNEXION
    -> PHP - En cliquant sur l'élément déconnexion de la navigation l'utilisateur n'accède pas à une page, il s'execute seulemnt un script PHP qui va détruire la session correspondant à l'état connecté, puis rediriger vers l'accueil
    



