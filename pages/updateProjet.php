<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
            require_once('connexiondb.php');

            $idP = isset($_POST['idP'])?$_POST['idP']:0;
            $intitule = isset($_POST['intitule'])?$_POST['intitule']:"";
            $description = isset($_POST['description'])?$_POST['description']:"";
            $idStagiaire = isset($_POST['idStagiaire'])?$_POST['idStagiaire']:1;
            $idEncadrant = isset($_POST['idEncadrant'])?$_POST['idEncadrant']:1;
            $renumeration = isset($_POST['renumeration'])?$_POST['renumeration']:"";
            $date_debut = isset($_POST['date_debut'])?$_POST['date_debut']:"";
            $date_fin = isset($_POST['date_fin'])?$_POST['date_fin']:"";
           

            $requete = "update projet set intitule=?,description=?,idStagiaire=?,idEncadrant=?,renumeration=?,date_debut=?,date_fin=? where idProjet=?";
            $params = array($intitule,$description,$idStagiaire,$idEncadrant,$renumeration,$date_debut,$date_fin,$idP);
        
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);  

            header('location:projets.php'); 
   }else{
       header('location:login.php');
   }

?>
