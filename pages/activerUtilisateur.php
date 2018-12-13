<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $idUtilisateur = isset($_GET['idUtilisateur'])?$_GET['idUtilisateur']:0;
        $etat = isset($_GET['etat'])?$_GET['etat']:0;

        if($etat==1)
            $newEtat=0;
        else
            $newEtat=1;
        
        $requete = "update utilisateur set etat=? where idUtilisateur=?";
        $params = array($newEtat,$idUtilisateur); 
    
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);  

        header('location:utilisateurs.php'); 
    
    }else{
        header('location:login.php');
    }

?>
