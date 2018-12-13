<?php 
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        
        require_once('connexiondb.php');

        $idStruct = isset($_GET['idStruct'])?$_GET['idStruct']:0;

        $requete = "delete from structure where idStructure=?";
        $params = array($idStruct);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:structures.php');

    }else{
        header('location:login.php');
    }
?>
