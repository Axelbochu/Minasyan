<?php
    //On inclue le fichier de connexion
    include_once "actionPhp/connexionBdd.php";

    //On vérifie que les données du form d'ajout on été envoyé
    if(isset($_POST['ajouter'])){
        //on vérifier que l'intégralité du formulaire est remplis
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0 && isset($_POST['desfonction']) && isset($_POST['fonction']) && isset($_POST['prenom']) && isset($_POST['nom']) && ($_POST['desfonction'] != "") && ($_POST['fonction'] != "") && ($_POST['prenom'] != "") && ($_POST['nom'] != ""))
        {
            //testons si le fichier n'est pas supérieur à 1Mo
            if($_FILES['photo']['size'] <= 1000000){
                //testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['photo']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtension = ['jpg', 'jpeg', 'png'];
                if(in_array($extension, $allowedExtension)){
                    //si on a une extension autorisé
                    //le nouveau fichier s'appelle date + nom
                    $newNameImg = time() . $_FILES['photo']['name'];
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'imgBdd/' . $newNameImg);
                    //recupérer toutes les valeurs
                    $nom = addslashes($_POST["nom"]);
                    $prenom = addslashes($_POST["prenom"]);
                    $fonction = addslashes($_POST["fonction"]);
                    $desfonction = addslashes($_POST["desfonction"]);
                    $nameImgCorrec = addslashes($newNameImg);
                    //on fait la requete
                    $requete = "INSERT INTO guest VALUES (null, '$nom', '$prenom', '$fonction', '$desfonction', '$nameImgCorrec')";
                    $resultat = mysqli_query($connexion, $requete);

                    if($resultat == false){
                        //erreur de la requete
                        die('Erreur :' .mysqli_error($resultat));
                    }
                    //base de donnée mise à jour
                }
                else{
                    //extension non conforme
                    $message = "Base de donnée non mise à jour ! Veuillez choisir une photo en .jpeg/.jpg/.png";
                }
            }
            else{
                //photo trop grande
                $message = "Base de donnée non mise à jour ! Veuillez choisir une photo avec une taille inférieure à 1Mo !";
            }
        }
        else{
            //si un des champs est vide
            $message = "Base de donnée non mise à jour ! Veuillez remplir tout le formulaire !";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Equipe</title>
    <link rel="stylesheet" href="css/teams.css">
</head>
<body>
    <script src="js/script.js"></script>
    <a href="index.html" id="retourBtn">Acceuil</a>

    <div class="textAcceuilContainer">
        <h1>Gestion Equipe</h1>
        <p>Quelle action souhaitez vous faire ?</p>
        <p style="color :red;"><?php if(isset($message)) echo $message ?></p>
    </div>

    <div class="downContainer ancienContainer">

        <!--Cards deja existantes-->
        <?php
            //on récupère l'intégralité de la base de donnée guest
            $requeteGetGuest = "SELECT * FROM guest";
            $resultatGetGuest = mysqli_query($connexion, $requeteGetGuest);
            if($resultatGetGuest == false){
                //erreur de la requete
                die('Erreur :' .mysqli_error($requeteGetGuest));
            }

            if(mysqli_num_rows($resultatGetGuest) > 0){
                
                $compteur = 0;

                while($row = mysqli_fetch_assoc($resultatGetGuest)){
                    ?>

                    <script>
                        //on ajoute chaque ligne à notre tbl
                        var newLigne = <?php echo json_encode($row); ?>;
                        infoDb.push(newLigne);
                    </script>
                    
                    <div class="cardNormale card" onclick="modifierGuest(<?php echo $compteur; ?>)" onmouseenter="affichageIcon(this)" onmouseleave="sortirIcon(this)">
                        <div class="blurCont" style = "background-image: url('imgBdd/<?php echo $row['src']; ?>');">
                            <div class="descriptionCard">
                                <h2><?php echo $row['nom']." ".$row['prenom']; ?></h2>
                                <h3><?php echo $row['fonction']; ?></h3>
                                <p><?php echo $row['fonctionExplain']; ?></p>
                            </div>
                        </div>
                        <img src="sources/crayon.png" alt="crayonModif" class="iconeModif initialHidden">
                    </div>
                    
                    <?php
                    $compteur = $compteur +1;
                }
            }
            else{
                $message = "Vous n'avez encore d'employé enregistré";
            }
        ?>
        
        <div class="cardPlus card">
            <div class="containerPlus" onclick="newTeams()">
                <img src="sources/plus.png" alt="bouton plus">
            </div>

            <div class="containerNewTeam" style="display: none;">
                <form action="" method="POST" enctype="multipart/form-data">
                    <button onclick="reload()">Annuler</button>
                    <label>Nom :</label>
                    <input type="text" name="nom">
                    <label>Prenom :</label>
                    <input type="text" name="prenom">   
                    <label>Fonction :</label>
                    <input type="text" name="fonction">
                    <label>Description de la fonction :</label>
                    <textarea name="desfonction" cols="40" rows="5"></textarea>
                    <label>photo :</label>
                    <input type="file" name="photo">
                    <div class="submitErr">
                        <input type="submit" name="ajouter" value="ajouter" id="submitBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="majContainer" style="display : none;">
        <button onclick="document.location.href = document.location">Annuler</button>
        <h2>Mise à jour base de donnée :</h2>
        <form action="actionPhp/majGuest.php" method="POST" enctype="multipart/form-data">
            <input name="id" type="hidden" class="idGuest">
            <div class="labelPlusInput">
                <div class="orgaLabel">
                    <label>Nom :</label>
                    <input type="text" name="nom" class="nomInput">
                </div>

                <div class="orgaLabel">
                    <label>Prenom :</label>
                    <input type="text" name="prenom" class="prenomInput">
                </div>
            </div>
            <label>Fonction :</label>
            <input type="text" name="fonction" class="fonctionInput">
            <label>Description de la fonction :</label>
            <textarea name="desfonction" class="desfonctionInput" cols="50" rows="5"></textarea>
            <label>photo : (laisser vide si pas de changement photo)</label>
            <input type="file" name="photo">
            
            <div class="labelPlusInput">
                <input type="submit" name="modifier" value="modifier" id="modifierGuest">
                <input type="submit" name="supprimer" value="supprimer l'employé" id="supprimerGuest">
            </div>
            
        </form>
    </div>
</body>
</html>