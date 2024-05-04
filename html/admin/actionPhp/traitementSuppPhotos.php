<?php
    include_once "connexionBdd.php";

    if(isset($_POST['supprimer'])){
        //on veut supprimer un employé
        $persAsuppr = $_POST["id"];

        //on selectionne le nom du fichier à suppr
        $requeteSrc = "SELECT src FROM photos WHERE id = $persAsuppr";
        $resultatSrc = mysqli_query($connexion, $requeteSrc);

        $requete = "DELETE FROM photos WHERE id = '$persAsuppr'";
        $resultat = mysqli_query($connexion, $requete);

        if($resultat == false){
            echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
            die();
        }
        else{
            $row = mysqli_fetch_assoc($resultatSrc);
            unlink("../imgBdd/".$row['src']);
            //on redirige
            header('Location: ../gestionPhoto.php');
        }
    }
    else{
        echo('erreur');
    }   

?>