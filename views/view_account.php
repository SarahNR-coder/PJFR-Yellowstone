    <main>
        <h1 id="title">Mon Compte</h1>
        <section id="infosUtilisateur">
        <h2 class="secondBestTitle">Mes Informations</h2>
            <div id="infosBasiques">
                <p><span>Nom : </span><span class="info"><?php echo $nameUser ?></span></p>
                <p><span>Prénom : </span><span class="info"><?php echo $firstnameUser ?></span></p>
                <p><span>Adresse email : </span><span class="info"><?php echo $email ?></span></p>
                <p><span>Pseudo: </span><span class="info"><?php echo $pseudo ?></span></p>
            </div>
        </section>
        <section id="historiqueCommandes">
            <h2 class="secondBestTitle">Mes Commandes</h2>
        </section>
        <section id="historiqueCommentaires">
            <h2 class="secondBestTitle">Mes Commentaires</h2>
            <?php echo $listComments ?>
        </section>
        <section id="historiqueNotes">
            <h2 class="secondBestTitle">Mes Notes</h2>
            <?php echo $listRatings ?>
        </section>
    </main>
