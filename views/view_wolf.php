<main>
    <h1 id="title">Le Loup Gris</h1>
    <section id="idCard">
        <div id="tag">
            CANIS LUPUS
        </div>
        <article id="infoCard">
            <img src="./img/wolf.webp" alt="Loup.">
            <div id="features">
                <p><strong>Nom commun : </strong>Loup gris</p>
                <p><strong>Classification : </strong>Mammifère, Carnivore, Famille des Canidés</p>
                <p><strong>Habitat : </strong>Forêts, Toundras, Montagnes, Prairies</p>
                <p><strong>Régime alimentaire : </strong>Carnivore, chasse principalement des grands mammifères,commeles cerfs et les wapitis</p>
                <p><strong>Comportement social : </strong>Vivent en meutes hiérarchisées avec des structures sociales complexes</p>
                <p><strong>Reproduction : </strong>Une portée par an, composée de 4 à 6 louveteaux en moyenne</p>
                <p><strong>Statut de conservation : </strong>LC, Préoccupation mineure</p>
            </div>
        </article>
    </section>
    <section id="location">
        <h2 class="subtitle">LE LOUPS GRIS DANS LE PARC DU YELLOWSTONE</h2>
        <div id="containImg">
            <img src="./img/wolf-animals-aera-map.webp" alt="Carte montrant la répartition faune dans le parc Yellowstone" />
        </div>
    </section>
    <section id="comments">
        <h2 class="subtitle">COMMENTAIRES</h2>
        <h3>Notez</h3>
        <?php if(isset($_SESSION['id_user'])){
            echo '<div class="rating">
                <input type="radio" id="star5" name="rating" value="5" />
                <label for="star5" title="5 étoiles"><i class="fa-solid fa-star"></i></label>

                <input type="radio" id="star4" name="rating" value="4" />
                <label for="star4" title="4 étoiles"><i class="fa-solid fa-star"></i></label>

                <input type="radio" id="star3" name="rating" value="3" />
                <label for="star3" title="3 étoiles"><i class="fa-solid fa-star" ></i></label>

                <input type="radio" id="star2" name="rating" value="2" />
                <label for="star2" title="2 étoiles"><i class="fa-solid fa-star" ></i></label>

                <input type="radio" id="star1" name="rating" value="1" />
                <label for="star1" title="1 étoile"><i class="fa-solid fa-star" ></i></label>
            </div>
            <form action="" method="post" id="selectedStar">
            <input id="numberOfStars" type="text" name="numberOfStars">
            <input type="submit" name="Noter"
            </form>
            ';
        }else{
            echo "Veuillez vous connecter pour beneficier de cette fonctionnalité";
        }
        ?>        
        <h3>Commentez</h3>
        <?php if(isset($_SESSION['id_user'])){
            echo '<form action="" method="post">
                <label for="newComment">Nouveau Commentaire</label>
                <textarea name="contenuCommentaire" id="newComment"></textarea>
                <input type="submit" name="Poster">
            </form>';
        }else{
            echo "Veuillez vous connecter pour beneficier de cette fonctionnalité";
        }
        ?>
        <h3>Notes des visiteurs</h3>
        <?php echo $listRatings ?>
        <h3>Commentaires des visiteurs<h3>
        <?php echo $listComments ?>
    </section>
</main>