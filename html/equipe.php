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
            <a href="bureaux.php">NOS BUREAUX</a>
            <a href="expertises.html">EXPERTISES</a>
        </div>
    </header>

    <main>
        <div class="h1-container">
            <h1 class="h1-body">Notre équipe</h1>
        </div>
        <p class="description">Parce que votre satisfaction est notre priorité, Minasyan Avocats est une équipe à taille humaine de <span>3 personnes</span> travaillant ensemble afin de satisfaire au mieux vos exigences.</p>
        <div class="team-container">

            <?php
            
                $requete = "SELECT * FROM `guest`";
                $resultat = mysqli_query($connexion, $requete) ; //Executer la requete
                        
                if ( $resultat == FALSE ){
                    echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                    die();
                }

                if(mysqli_num_rows($resultat)>0){
                    while($row = mysqli_fetch_assoc($resultat)){
                        ?>
                        
                        <div class="memberCard" style="background-image: url('admin/imgBdd/<?php echo $row['src']; ?>');">
                            <div class="member-description">
                                <div class="arrow"></div>
                                <h2><?php echo $row['nom']." ".$row['prenom']; ?></h2>
                                <p><?php echo $row['fonction']; ?></p>
                                <p class="globalDescription"><?php echo $row['fonctionExplain']; ?></p>
                            </div>
                        </div>


                        <?php
                    }
                }
                else{
                    echo "Pas de personnes enregistrées.";
                }
            ?>
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

    <script src="../js/team.js"></script>
</body>
</html>

<?php
    mysqli_close($connexion);
?>