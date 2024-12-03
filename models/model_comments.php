<?php

class ModelComment{
    //Attributs
    private ?int $idCommentaire;
    private ?string $dateCommentaire;
    private ?string $contenuCommentaire;
    private ?int $idPage;
    private ?int $idCommentateur;

    //constructeur
    public function __construct(){
        
    }

    //Getters et Setters
    public function getIdCommentaire(): ?int{
        return $this->idCommentaire;
    }
    
    public function setIdCommentaire(?int $idCommentaire): ModelComment{
        $this->idCommentaire = $idCommentaire;
        return $this;
    }


    public function getDateCommentaire(): ?string{
        return $this->dateCommentaire;
    }

    public function setDateCommentaire(?string $dateCommentaire): ModelComment{
        $this->dateCommentaire = $dateCommentaire;
        return $this;
    }

    public function getContenuCommentaire(): ?string{
        return $this->contenuCommentaire;
    }

    public function setContenuCommentaire(?string $contenuCommentaire): ModelComment{
        $this->contenuCommentaire = $contenuCommentaire;
        return $this;
    }

    public function getIdPage(): ?int{
        return $this->idPage;
    }

    public function setIdPage(?int $idPage): ModelComment{
        $this->idPage = $idPage;
        return $this;
    }

    public function getIdCommentateur(): ?int{
        return $this->idCommentateur;
    }

    public function setIdCommentateur(?int $idCommentateur): ModelComment{
        $this->idCommentateur = $idCommentateur;
        return $this;
    }

    function addComment():string{
        //1ere étape intancier l'objet de connexion PDO
        $bdd= new PDO("mysql:host=127.0.0.1;dbname=yellowstone2","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        //Récupération des données de l'objet
        $dateCommentaire = $this->getDateCommentaire();
        $contenuCommentaire = $this->getContenuCommentaire();
        $idPage = $this->getIdPage();
        $idCommentateur=$this->getIdCommentateur();

        try{
            //2eme étape : préparer la requête
            $req =$bdd->prepare('INSERT INTO commentaire(date_commentaire, contenu_commentaire, id_page, id_commentateur) VALUES (?,?,?,?)');

            //3eme étape : binding de paramètres
            $req->bindParam(1,$dateCommentaire,PDO::PARAM_STR);
            $req->bindParam(2,$contenuCommentaire,PDO::PARAM_STR);
            $req->bindParam(3,$idPage,PDO::PARAM_INT);
            $req->bindParam(4,$idCommentateur,PDO::PARAM_INT);

            //4ème étape : executer la requête
            $req->execute();


            //5ème étape : Retourne un message de confirmation
            return "Commentaire ajouté";

            
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }


    public function readCommentsByUser(?int $idCommentateur):array | string{
        //1Er Etape : Instancier l'objet de connexion PDO
        $bdd = new PDO('mysql:host=localhost;dbname=yellowstone2','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Try...Catch
        try{
            //2nd Etape : préparer ma requête SELECT
            $req = $bdd->prepare('SELECT date_commentaire, contenu_commentaire, commentaire.id_page, id_commentateur, nom_page FROM commentaire INNER JOIN page_site ON commentaire.id_page = page_site.id_page WHERE id_commentateur = ?');

            //3eme Etape : Binding de Paramètre pour relier chaque ? à sa donnée
            $req->bindParam(1,$idCommentateur,PDO::PARAM_INT);

            //4eme Etape : exécution de la requête
            $req->execute();

            //5eme Etape : Retourne la réponse de la BDD
            return $req->fetchAll(PDO::FETCH_ASSOC);

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    public function readCommentsByPage(?int $idPage):array | string{
        //1Er Etape : Instancier l'objet de connexion PDO
        $bdd = new PDO('mysql:host=localhost;dbname=yellowstone2','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Try...Catch
        try{
            //2nd Etape : préparer ma requête SELECT
            $req = $bdd->prepare('SELECT date_commentaire, contenu_commentaire, id_page, id_commentateur, pseudo  FROM commentaire INNER JOIN utilisateur ON commentaire.id_commentateur = utilisateur.id_utilisateur WHERE commentaire.id_page = ?');

            //3eme Etape : Binding de Paramètre pour relier chaque ? à sa donnée
            $req->bindParam(1,$idPage,PDO::PARAM_INT);

            //4eme Etape : exécution de la requête
            $req->execute();

            //5eme Etape : Retourne la réponse de la BDD
            return $req->fetchAll(PDO::FETCH_ASSOC);

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }    
}