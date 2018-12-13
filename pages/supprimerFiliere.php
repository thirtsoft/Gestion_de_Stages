<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){

        require_once('connexiondb.php');

        $idf = isset($_GET['idF'])?$_GET['idF']:0;

        $requeteStag = "select count(*) countStag from stagiaire where idFiliere=$idf";
        $resultatStag = $pdo->query($requeteStag);
        $tabCountStag = $resultatStag->fetch();
        $nbreStag = $tabCountStag['countStag'];

        if($nbreStag == 0){
            $requete = "delete from filiere where idFiliere=?";
            $params = array($idf);
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location:filieres.php');

        }else{
            $msg = "suppression impossible: vous devez supprimer tous les stagiaires
                    inscrits dans cette filière";
            header("location:alert.php?message=$msg");        
        }
    }else{
    header('location:login.php');
   }

?>
