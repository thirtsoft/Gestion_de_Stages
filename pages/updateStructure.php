<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
            require_once('connexiondb.php');

            $idStruct = isset($_POST['idStruct'])?$_POST['idStruct']:0;
            $nomStructure = isset($_POST['nomStructure'])?$_POST['nomStructure']:"";
            $effectif = isset($_POST['effectif'])?$_POST['effectif']:"";
            $idStagiaire = isset($_POST['idStagiaire'])?$_POST['idStagiaire']:1;
            $adresse = isset($_POST['adresse'])?$_POST['adresse']:"";
            $siteWeb = isset($_POST['siteWeb'])?$_POST['siteWeb']:"";
            $telephone = isset($_POST['telephone'])?$_POST['telephone']:"";
            
       
            $requete = "update structure set nomStructure=?,effectif=?,idStagiaire=?,adresse=?,siteWeb=?,telephone=? where idStructure=?";
            $params = array($nomStructure,$effectif,$idStagiaire,$adresse,$siteWeb,$telephone,$idStruct);
        
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);  

            header('location:structures.php'); 
   }else{
       header('location:login.php');
   }

?>
