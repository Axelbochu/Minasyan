<?php

    include_once "actionPhp/connexionBdd.php";
    if(isset($_POST['submit'])){
        //on est rentré dans le fomulaire
        if(isset($_POST['valeur']) && isset($_POST['description']) && $_POST['valeur'] != "" && $_POST['description'] != ""){
            //on recup les valeurs
            $id = $_POST['id'];
            $valeur = $_POST['valeur'];
            $description = $_POST['description'];

            //avant la requete nous devons nous assurer qu'il n'y a pas d'apostrophe
            $valeur = addslashes($valeur);
            $description = addslashes($description);

            //on fait la requete
            $requete= "UPDATE entrepriseenchiffres SET valeur='$valeur',descriptionValeur = '$description' WHERE id=$id ";//La requere SQL
            $resultat = mysqli_query($connexion, $requete) ; //Executer la requete
            
            if ( $resultat == FALSE ){
                //erreur de la requete
                die('Erreur :' .mysqli_error($resultat));
            }
            //bdd maj
        }
        else{
            //formulaire non rempli complétement
            $message = "Veuillez remplir tout les champs !";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Chiffres</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <script src="js/script.js"></script>
    <a href="index.html" id="retourBtn">Acceuil</a>

    <div class="textAcceuilContainer">
        <h1>Gestion Chiffres de l'entreprise</h1>
        <p>Survoler une donnée pour la modifier</p>
    </div>

    <div class="dataGlobalContainer ancienContainer">
        <?php
        
            $requete = "SELECT * FROM entrepriseenchiffres";
            $resultat = mysqli_query($connexion, $requete);

            if($resultat == false){
                //erreur de la requete
                die('Erreur :' .mysqli_error($requeteGetGuest));
            }

            if(mysqli_num_rows($resultat) > 0){
                $compteur = 0;
                //on affiche tout 
                while($row = mysqli_fetch_assoc($resultat)){
                    ?>

                        <script>
                            //on ajoute chaque ligne à notre tbl
                            var newLigne = <?php echo json_encode($row); ?>;
                            infoDb.push(newLigne);
                        </script>

                            <div class="dataContainer" onclick="modifierValeur(<?php echo $compteur; ?>)" onmouseenter="affichageIcon(this)" onmouseleave="sortirIcon(this)">
                                <div class="blurCont">
                                    <h2><?php echo $row['valeur']; ?></h2>
                                    <p><?php echo $row['descriptionValeur']; ?></p>
                                </div>
                                <img src="sources/crayon.png" alt="crayonModif" class="iconeModif initialHidden">
                            </div>
                    <?php
                    $compteur = $compteur + 1;
                }


            }
            else{
                //resultat vide
            }
        
        ?>
    </div>

    <div class="majContainer" style="display : none;">
        <button onclick="location.reload()">Annuler</button>
        <h2>Mise à jour base de donnée :</h2>
        <form action="" method="POST">
            <input name="id" type="hidden" class="idInput" >
            <label for="valeur">valeur :</label>
            <input name="valeur" type="text" class="valeurInput">
            <label>description :</label>
            <textarea name="description" id="description" cols="50" rows="4" class="descriptionInput"></textarea>
            <input name="submit" type="submit" value="mettre à jour">
        </form>
    </div>
</body>
</html>