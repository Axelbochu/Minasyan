<?php
    include_once "connexionBdd.php";

    if(isset($_POST['modifier'])){
        //on verifie si la photo a été modifier
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
            //une photo a bien été chargée
            //testons si le fichier n'est pas supérieur à 1Mo
            if($_FILES['photo']['size'] <= 1000000){

                //testons si l'extension est autorisée
                $fileInfo = pathinfo($_FILES['photo']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtension = ['jpg', 'jpeg', 'png'];

                if(in_array($extension, $allowedExtension)){
                    //si on a une extension autorisé
                    //on delete l'ancien
                    //on veut supprimer un employé
                    $persAsuppr = $_POST["id"];

                    //on selectionne le nom du fichier à suppr
                    $requeteSrc = "SELECT src FROM guest WHERE id = $persAsuppr";
                    $resultatSrc = mysqli_query($connexion, $requeteSrc);

                    if($resultatSrc == false){
                        echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                        die();
                    }
                    else{
                        $row = mysqli_fetch_assoc($resultatSrc);
                        unlink("../imgBdd/".$row['src']);
                    }
                    //le nouveau fichier s'appelle date + nom
                    $newNameImg = time() . $_FILES['photo']['name'];
                    move_uploaded_file($_FILES['photo']['tmp_name'], '../imgBdd/' . $newNameImg);
                    $nameImgCorrec = addslashes($newNameImg);
                
                }
                else{
                    //extension non conforme
                    echo "Base de donnée non mise à jour ! Veuillez choisir une photo en .jpeg/.jpg/.png";
                }
            }
            else{
                //photo trop grande
                echo "Erreur ! Veuillez choisir une photo inférieur à 1Mo";
            }
        }
        else{
            //aucue photo chargée
            //on selectionne le nom du fichier
            $id = $_POST['id'];
            $requeteSrc = "SELECT src FROM guest WHERE id = $id";
            $resultatSrc = mysqli_query($connexion, $requeteSrc);

            if($resultatSrc == false){
                echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
                die();
            }
            else{
                $row = mysqli_fetch_assoc($resultatSrc);
                $nameImgCorrec = $row['src'];
            }
        }
        //on récupère toutes les valeurs
        $nom = addslashes($_POST["nom"]);
        $prenom = addslashes($_POST["prenom"]);
        $fonction = addslashes($_POST["fonction"]);
        $desfonction = addslashes($_POST["desfonction"]);
        $id = $_POST['id'];

        $requete = "UPDATE guest SET nom = '$nom',prenom = '$prenom',fonction = '$fonction',fonctionExplain = '$desfonction', src = '$nameImgCorrec' WHERE id = '$id'";
        $resultat = mysqli_query($connexion, $requete);

        if($resultat == false){
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
            die();
        }
        else{
            //bdd mise à jour
            //on redirige
            header('Location: ../equipeGestion.php');
        }
    }




    else if(isset($_POST['supprimer'])){
        //on veut supprimer un employé
        $persAsuppr = $_POST["id"];

        //on selectionne le nom du fichier à suppr
        $requeteSrc = "SELECT src FROM guest WHERE id = $persAsuppr";
        $resultatSrc = mysqli_query($connexion, $requeteSrc);

        $requete = "DELETE FROM guest WHERE id = '$persAsuppr'";
        $resultat = mysqli_query($connexion, $requete);

        if($resultat == false){
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
            die();
        }
        else{
            $row = mysqli_fetch_assoc($resultatSrc);
            unlink("../imgBdd/".$row['src']);
            //on redirige
            header('Location: ../equipeGestion.php');
        }
    }
    else{
        echo('erreur');
    }
?>
