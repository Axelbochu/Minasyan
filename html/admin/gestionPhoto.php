<?php
    include_once "actionPhp/connexionBdd.php";

    if(isset($_POST['submitPhoto'])){
        //on vérifier que l'intégralité du formulaire est remplis
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
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
                    $nameImgCorrec = addslashes($newNameImg);
                    //on fait la requete

                    $requete = "INSERT INTO `photos` (`id`, `src`) VALUES (NULL, '$nameImgCorrec')";
                    $resultat = mysqli_query($connexion, $requete);

                    if($resultat == false){
                        //erreur de la requete
                        die('Erreur :' .mysqli_error($resultat));
                    }
                    //base de donnée mise à jour
                }
                else{
                    //extension non conforme
                    $message = "Veuillez choisir une photo en .jpeg/.jpg/.png";
                }
            }
            else{
                //photo trop grande
                $message = "Veuillez choisir une photo avec une taille inférieure à 1Mo !";
            }
        }
        else{
            //si un des champs est vide
            $message = "Veuillez selectionner une photo !";
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-photo</title>
    <link rel="stylesheet" href="css/photo.css">
</head>
<body>
    <a href="index.html" class="acceuil">Acceuil</a>
    <form action="" class="formAdd" method="POST" enctype="multipart/form-data">
        <p class="error"> <?php if(isset($message)) echo $message; ?></p>
        <h1>Ajouter une photo</h1>
        <label>Choisissez une photo à ajouter</label>
        <input type="file" name="photo" class="photoInput">
        <input type="submit" value="Ajouter la photo" name="submitPhoto">
    </form>

    <div class="affichagePhotoContainer">
        <h1>Les photos Actuelles :</h1>
        <p>Cliquer sur une photo pour la supprimer</p>
        <div class="photoActuelles">
            <?php
            
                $requeteSelect = "SELECT * FROM `photos`";
                $resultatSelect = mysqli_query($connexion, $requeteSelect);

                if($resultatSelect == false){
                    //erreur de la requete
                    die('Erreur :' .mysqli_error($resultat));
                }
                if(mysqli_num_rows($resultatSelect) > 0){

                    while($row = mysqli_fetch_assoc($resultatSelect)){
                        ?>
                            <div class="photoIndiv">
                                <img src="imgBdd/<?php echo $row['src']; ?>">
                                <form action="actionPhp/traitementSuppPhotos.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
                                    <input type="submit" value="Supprimer" class="deleteImg" name="supprimer">
                                </form>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>