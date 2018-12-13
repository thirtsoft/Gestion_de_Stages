<?php 
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        
        require_once('connexiondb.php');

        $idEncadrant = isset($_GET['idEncad'])?$_GET['idEncad']:0;

        $requeteProjet = "select count(*) countP from projet where idEncadrant=$idEncadrant";

        $resultatProjet = $pdo->query($requeteProjet);
        $tabCountProjet = $resultatProjet->fetch();
        $nbreProjet = $tabCountProjet['countP'];
      
        if($nbreProjet == 0){
            $requete = "delete from encadrant where idEncadrant=?";
            $params = array($idEncadrant);
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location:encadrants.php');

        }else{
            $msg = "suppression impossible: vous devez supprimer tous les projets
                    dirigées par ces encadrants";
            header("location:alert.php?message=$msg"); 

        }

       

    }else{
        header('location:login.php');
    }
?>


