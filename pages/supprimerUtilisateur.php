<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $idUtilisateur = isset($_GET['idUtilisateur'])?$_GET['idUtilisateur']:0;

        $requete = "delete from utilisateur where idUtilisateur=?";
        $params = array($idUtilisateur);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:utilisateurs.php');
    }else{
        header('location:login.php');
    }

?>
