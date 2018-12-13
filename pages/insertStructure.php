<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $nom = isset($_POST['nomStructure'])?$_POST['nomStructure']:"";
        $adresse = isset($_POST['adresse'])?$_POST['adresse']:"";
        $telephone = isset($_POST['telephone'])?$_POST['telephone']:"";
        $siteWeb = isset($_POST['siteWeb'])?$_POST['siteWeb']:"";
        $effectif = isset($_POST['effectif'])?$_POST['effectif']:"";
        $idStagiaire = isset($_POST['idStagiaire'])?$_POST['idStagiaire']:1;

        
        $requete = "insert into structure(nomStructure,effectif,idStagiaire,adresse,siteWeb,telephone) values(?,?,?,?,?,?)";
        $params = array($nom,$effectif,$idStagiaire,$adresse,$siteWeb,$telephone); 
    
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);  

        header('location:structures.php');
    }else{
        header('location:login.php');
    } 

?>
