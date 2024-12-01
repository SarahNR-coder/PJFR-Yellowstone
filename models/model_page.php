<?php

class ModelPage{
    //Attributs
    private ?int $idPage;
    private ?string $nomPage;

    //Constructeur
    public function __construct(?string $nomPage){
        $this->nomPage = $nomPage;
    }

    //Getter et Setters
    public function getIdPage(): ?int{
        return $this->idPage;
    }
    
    public function setIdPage(?int $idPage): ModelPage{
        $this->idPage = $idPage;
        return $this;
    }

    public function getNomPage(): ?string{
        return $this->nomPage;
    }
    
    public function setIdNomPage(?string $nomPage): ModelPage{
        $this->nomPage = $nomPage;
        return $this;
    }

    public function getPageIdFromName():array|string{
         //1Er Etape : Instancier l'objet de connexion PDO
        $bdd = new PDO('mysql:host=localhost;dbname=yellowstone','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Récupération de $nom_page depuis l'objet
        $nomPage = $this->getNomPage();

        //Try...Catch
        try{
            //2nd Etape : préparer ma requête SELECT
            $req = $bdd->prepare('SELECT id_page FROM page_site WHERE nom_page = ?');

             //3eme Etape : Binding de Paramètre pour relier chaque ? à sa donnée
            $req->bindParam(1,$nomPage,PDO::PARAM_STR);

            //4eme Etape : exécution de la requête
            $req->execute();

            //5eme Etape : Retourne la réponse de la BDD
            return $req->fetch();

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }
}

?>