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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section>
        <header>
            <div class="headerLogo">
                <div class="titleLogo">
                    <h1>MINASYAN</h1>
                    <h2>Avocats</h2>
                </div>
            </div>

            <div class="headerLink">
                <a href="bureaux.php">NOS BUREAUX</a>
                <a href="expertises.html">EXPERTISES</a>
                <a href="equipe.php">L'ÉQUIPE</a>
            </div>
        </header>

    <main>
            <div class="mainPage">
                <div class="containerMainPage">
                    <div class="citation">
                        <h2>Excellence, dévouement, réactivité.</h2>
                    </div>
                    <div class="manouk-container">
                    </div>
                    <div class="avocatPhoto"></div>
                </div>
            </div>
        </section>
        
        <div class="space"></div>

        
        
        

        <section class="operation">

            <div class="imgChiffreContainer">

            </div>
            <div class="rond-blanc-container">
                <h1 id="chiffreGlobalTitre">Le cabinet en chiffre :</h1>
                <div class="containerChiffres">
                    <div class="containerChiffres1">

        
                       <?php 
                        $requete= "SELECT * FROM `entrepriseenchiffres`";//La requere SQL
                        $resultat = mysqli_query($connexion, $requete) ; //Executer la requete
                        
                        if ( $resultat == FALSE ){
                            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                            die();
                        }
                        else{
                            if(mysqli_num_rows($resultat) > 0){
                                $bloc1 = mysqli_fetch_assoc($resultat);
                                $bloc2 = mysqli_fetch_assoc($resultat);
                                $bloc3 = mysqli_fetch_assoc($resultat);
                            }
                            else{
                                echo "erreur serveur! pas de résultat.";
                            }
                        }
                        ?>
                        


                        <h3 id="chiffre1"><?php echo $bloc1['valeur'] ?></h3>
                        <p id="txtChiffre1"><?php echo $bloc1['descriptionValeur'] ?></p>
                    </div>

                    <div class="containerChiffres2">
                        <h3 id="chiffre2"><?php echo $bloc2['valeur'] ?></h3>
                        <p id="txtChiffre2"><?php echo $bloc2['descriptionValeur'] ?></p>
                    </div>

                    <div class="containerChiffres3">
                        <h3 id="chiffre3"><?php echo $bloc3['valeur'] ?></h3>
                        <p id="txtChiffre3"><?php echo $bloc3['descriptionValeur'] ?></p>
                    </div>
                </div>
            </div>        

            <?php 

            ?>

        </section>

        <div class="space"></div>

        <section class="advice">
            <div class="titleAdvice">
                <h1>Ce qu'en pensent nos clients</h1>
                <p>Depuis la création de notre cabinet, nous nous efforçons d'offrir au client la meilleure expérience possible. Leur satisafaction étant notre principale priorité, nous sommes très attentif aux commentaires de nos clients.</p>
            </div>
            <div class="cardContainer">
                <div class="adviceCard">
                    <div class="profilePart">
                        <div class="pictProf"></div>
                        <div class="clientName">
                            <p>François-Xavier CAO</p>
                        </div>
                        <div class="societe">
                            <p>Directeur général de CODE IS LAW</p>
                        </div>
                    </div>
                    <div class="advicePart">
                        <p>"Le cabinet Minasyan incarne parfaitement sa devise. Nous avons grandement apprécié leur accompagnement d'excellence allié à une grande disponibilité."</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="space"></div>


        <section class="actu">
            <h1>Les actualités du cabinet</h1>
            <div class="actu-global-container">
                <div class="center-container">
                    <div class="actu-container">
                        
                    </div>
                    <div class="actu-container">
                        
                    </div>
                    <div class="actu-container">
                        
                    </div>
                </div>
            </div>
        </section>  
    </main>

    <div class="space"></div>

    <section>
        <div class="loc">
            <h1>Où nous trouver ?</h1>
            <div class="locTxt">
                <p>Cabinet Minasyan Avocats,<br>
                    2 rue Hergé<br>
                    59650 Villeneuve d’Ascq</p>
            </div>
            <div class="google">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2532.1490170403736!2d3.1535338149364174!3d50.605768484043445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2d7b01d2b13ed%3A0xde6ac631641c9866!2s2%20Rue%20Herg%C3%A9%2C%2059650%20Villeneuve-d&#39;Ascq!5e0!3m2!1sfr!2sfr!4v1664228124926!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
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
    </section>
</body>
</html>

<?php
    mysqli_close($connexion);
?>