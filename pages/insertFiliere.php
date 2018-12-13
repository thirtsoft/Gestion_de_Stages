<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $nomf = isset($_POST['nomF'])?$_POST['nomF']:"";
        $niveau = isset($_POST['niveau'])?$_POST['niveau']:"";

        $requete = "insert into filiere(nomFiliere,niveau) values(?,?)";
        $params = array($nomf,$niveau);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('location:filieres.php');
        
    }else{
        header('location:login.php');

    }

?>
