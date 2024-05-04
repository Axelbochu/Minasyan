<?php

    include_once "admin/actionPhp/connexionBdd.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minasyan Avocats</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../source/logo-header.png">
    <link rel="stylesheet" href="../css/secondary.css">
</head>
<body>
    <header>
        <div class="headerLogo">
            <a href="index.php"></a>
            <div class="titleLogo">
                <h1>MINASYAN</h1>
                <h2>Avocats</h2>
            </div>
        </div>

        <div class="headerLink">
            <a href="index.php">ACCEUIL</a>
            <a href="expertises.html">EXPERTISES</a>
            <a href="equipe.php">L'ÉQUIPE</a>
        </div>
    </header>

    <main>
        <div class="h1-container">
            <h1 class="h1-body">Nos bureaux</h1>
        </div>
        <p class="description">Installé en métropole lilloise, nous avons à coeur de vous acceuillir dans les meilleures conditions. C'est pourquoi nous avons migré vers des locaux neufs situés au <span>2 rue Hergé, 59650, Villeneuve-d'Ascq</span></p>

        <?php
            
                $requete = "SELECT * FROM `photos`";
                $resultat = mysqli_query($connexion, $requete);
                $compteur = 0;

                if($resultat == false){
                    echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                    die();
                }

                if(mysqli_num_rows($resultat) > 0){
        ?>
                <div class="h2-container">
                    <h2 class="bureaux-h2">Les photos :</h2>
                </div>

                    <div class="slider-container">
                        <div class="slider">
                            <div class="cont-slides">
                                <?php

                                    while($row = mysqli_fetch_assoc($resultat)){
                                        ?>
                                        
                                        <img src="admin/imgBdd/<?php echo $row['src']; ?>" <?php if($compteur == 0) echo "class = 'active'";?>>
                                        
                                        <?php
                                        $compteur = $compteur + 1;
                                    }

                                ?>
                            </div>
                            <div class="commandes">
                                <button class="left">
                                    <img src="imgs/left.svg">
                                </button>
                                <button class="right">
                                    <img src="imgs/right.svg">
                                </button>
                            </div>
                            <div class="cercles">
                                <?php
                                
                                for($i = 0; $i < $compteur; $i++){
                                    ?>
                                        <button data-clic="<?php echo $i+1; ?>" <?php if($i == 0) echo "class='cercle active-cercle'";
                                                                                            else echo "class = 'cercle'"; ?>></button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
        <?php
                }
                //sinon on affiche pas le slider car pas de photo
        ?>

        <div class="h2-container">
            <h2 class="bureaux-h2">Plan d'accès :</h2>
        </div>
        <div class="container-acces">
            <div class="google">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2532.1490170403736!2d3.1535338149364174!3d50.605768484043445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2d7b01d2b13ed%3A0xde6ac631641c9866!2s2%20Rue%20Herg%C3%A9%2C%2059650%20Villeneuve-d&#39;Ascq!5e0!3m2!1sfr!2sfr!4v1664228124926!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <img src="../source/logo-header.png" alt="logo Avocats">
            <div class="ressourcesExt">
                <h3>Ressources externes :</h3>
                <a href="mentionsLegales.html">Mentions Légales</a>
                <a href="#">Politique de Confidentialité</a>
                <a href="#">Contacts</a>
            </div>
            <div class="cityFooter">
                <h4>Nous sommes situés dans les villes de <span>Lille</span> et <span>Paris</span>.</h4>
            </div>
        </div>
    </footer>

    <script src="../js/slider.js"></script>
</body>
</html>