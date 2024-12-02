<?php

class ModelRating{
    //Attributs
    private ?int $idNote;
    private ?string $dateNote;
    private ?int $note;
    private ?int $idPage;
    private ?int $idNoteur;

    //constructeur
    public function __construct(){
        $this->dateNote = date("Y-m-d H:i:s");
    }

    //Getters et Setters
    public function getIdNote(): ?int{
        return $this->idNote;
    }
    
    public function setIdNote(?int $idNote): ModelRating{
        $this->idNote = $idNote;
        return $this;
    }


    public function getDateNote(): ?string{
        return $this->dateNote;
    }

    public function setDateNote(?string $dateNote): ModelRating{
        $this->dateNote = $dateNote;
        return $this;
    }

    public function getNote(): ?int{
        return $this->note;
    }

    public function setNote(?int $note): ModelRating{
        $this->note = $note;
        return $this;
    }

    public function getIdPage(): ?int{
        return $this->idPage;
    }

    public function setIdPage(?int $idPage): ModelRating{
        $this->idPage = $idPage;
        return $this;
    }

    public function getIdNoteur(): ?int{
        return $this->idNoteur;
    }

    public function setIdNoteur(?int $idNoteur): ModelRating{
        $this->idNoteur = $idNoteur;
        return $this;
    }

    function addRating():string{
        //1ere étape intancier l'objet de connexion PDO
        $bdd= new PDO("mysql:host=127.0.0.1;dbname=yellowstone2","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        //Récupération des données de l'objet
        $dateNote = $this->getDateNote();
        $note = $this->getNote();
        $idPage = $this->getIdPage();
        $idNoteur=$this->getIdNoteur();

        try{
            //2eme étape : préparer la requête
            $req =$bdd->prepare('INSERT INTO note(date_note, note, id_page, id_noteur) VALUES (?,?,?,?)');

            //3eme étape : binding de paramètres
            $req->bindParam(1,$dateNote,PDO::PARAM_STR);
            $req->bindParam(2,$note,PDO::PARAM_INT);
            $req->bindParam(3,$idPage,PDO::PARAM_INT);
            $req->bindParam(4,$idNoteur,PDO::PARAM_INT);

            //4ème étape : executer la requête
            $req->execute();


            //5ème étape : Retourne un message de confirmation
            return "Note ajoutée";

            
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }


    public function readRatingsByUser(?int $idNoteur):array | string{
        //1Er Etape : Instancier l'objet de connexion PDO
        $bdd = new PDO('mysql:host=localhost;dbname=yellowstone2','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Try...Catch
        try{
            //2nd Etape : préparer ma requête SELECT
            $req = $bdd->prepare('SELECT date_note, note, id_page, id_noteur, nom_page FROM note INNER JOIN page_site ON note.id_page = page_site.id_page WHERE id_noteur = ?');

            //3eme Etape : Binding de Paramètre pour relier chaque ? à sa donnée
            $req->bindParam(1,$idNoteur,PDO::PARAM_INT);

            //4eme Etape : exécution de la requête
            $req->execute();

            //5eme Etape : Retourne la réponse de la BDD
            return $req->fetchAll(PDO::FETCH_ASSOC);

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    public function readRatingsByPage(?int $idPage):array | string{
        //1Er Etape : Instancier l'objet de connexion PDO
        $bdd = new PDO('mysql:host=localhost;dbname=yellowstone2','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Try...Catch
        try{
            //2nd Etape : préparer ma requête SELECT
            $req = $bdd->prepare('SELECT date_note, note, id_page, id_noteur, pseudo FROM note INNER JOIN utilisateur ON note.id_noteur = utilisateur.id_utilisateur WHERE note.id_page = ?');

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