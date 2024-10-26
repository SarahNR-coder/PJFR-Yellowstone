<?php

class ModelUser{
    //Attributs
    private ?int $idUtilisateur;
    private ?string $pseudo;  
    private ?string $email;
    private ?string $motDePasse;
    private ?string $nom;
    private ?string $prenom;
    private ?DATETIME $dateInscription;
    private ?BLOB $image;


    //constructeur
    public function __construct(?string $email){
        $this->email=$email;
    }

    //Getters et Setters
    public function getIdUtilisateur(): ?int{
        return $this->idUtilisateur;
    }

    public function getPseudo(): ?string{
        return $this->pseudo;
    }

    public function getEmail(): ?string{
        return $this->email;
    }

    public function getMotdepasse(): ?string{
        return $this->motDePasse;
    }

    public function getNom(): ?string{
        return $this->nom;
    }

    public function getPrenom(): ?string{
        return $this->prenom;
    }

    public function getDateInscription(): ?DATETIME{
        return $this->dateInscription;
    }

    public function getImage(): ?BLOB{
        return $this->image;
    }

    public function setIdUtilisateur(?int $idUtilisateur): ModelUser{
        $this->idUtilisateur= $idUtilisateur;
        return $this;
    }

    public function setPseudo(?string $pseudo): ModelUser{
        $this->pseudo= $pseudo;
        return $this;
    }

    public function setEmail(?string $email): ModelUser{
        $this->email= $email;
        return $this;
    }

    public function setMotDePasse(?string $motDePasse): ModelUser{
        $this->motDePasse= $motDePasse;
        return $this;
    }

    public function setNom(?string $nom): ModelUser{
        $this->nom= $nom;
        return $this;
    }

    public function setPrenom(?string $prenom): ModelUser{
        $this->prenom= $prenom;
        return $this;
    }

    public function setDateInscription(?DATETIME $dateInscription): ModelUser{
        $this->dateInscription = $dateInscription;
        return $this;
    }

    public function setImage(?BLOB $image): ModelUser{
        $this->image = $image;
        return $this;
    }

    function addUser():string{
        //1ere étape intancier l'objet de connexion PDO
        $bdd= new PDO("mysql:host=127.0.0.1;dbname=utilisateurs","root","",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

        //Récupération des données de l'objet
        $pseudo = $this->getPseudo();
        $email =$this->getEmail();
        $motDePasse=$this->getMotdepasse();
        $dateInscription = date("Y-m-d H:i:s");
        $idRoleUtilisateur = "1";

        try{
            //2eme étape : préparer la requête
            $req =$bdd->prepare('INSERT INTO utilisateur(pseudo, email, motdepasse, date_inscription,id_role_utilisateur) VALUES (?,?,?,?,?)');

            //3eme étape : binding de paramètres
            $req->bindParam(1,$pseudo,PDO::PARAM_STR);
            $req->bindParam(2,$email,PDO::PARAM_STR);
            $req->bindParam(3,$motDePasse,PDO::PARAM_STR);
            $req->bindParam(4,$dateInscription,PDO::PARAM_STR);
            $req->bindParam(5,$idRoleUtilisateur,PDO::PARAM_STR);

            //4ème étape : executer la requête
            $req->execute();


            //5ème étape : Retourne un message de confirmation
            return "{$pseudo}, vous êtes dorénavant inscrit(e)! Profitez dès à présent des nouvelles fonctionnalités à votre disposition.";

            
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    function readUserByEmail():array | string{
        //1ere Etape : instancier l'objet de connexion PDO
        $bdd = new PDO("mysql:host=127.0.0.1;dbname=utilisateurs", 'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //Récupération du pseudo depuis l'objet
        $email=$this->email;

        //Try..Catch
        try{
            //2nd étape : péparer la requête SELECT
            $req=$bdd->prepare('SELECT id_utilisateur, motdepasse, pseudo, email, nom, prenom, image FROM utilisateur WHERE email = ?');

            //3eme étape: Biding de paramètre pour le pseudo
            $req->bindParam(1,$email,PDO::PARAM_STR);
            
            //4eme étape : executer la requête
            $req->execute();

            //5eme étape: récupèrer les réponses de la base de données
            $data= $req->fetchAll(PDO::FETCH_ASSOC);

            //6eme étape : retourner les $data
            return $data;
        }catch(EXCEPTION $error){
            return $error->getMessage();
        }}}
?>
