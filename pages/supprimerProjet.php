<?php 
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        
        require_once('connexiondb.php');

        $idP = isset($_GET['idP'])?$_GET['idP']:0;

        $requete = "delete from projet where idProjet=?";
        $params = array($idP);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:projets.php');

    }else{
        header('location:login.php');
    }
?>
