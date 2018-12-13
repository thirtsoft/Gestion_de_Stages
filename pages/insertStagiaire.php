<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $nom = isset($_POST['nomStagiaire'])?$_POST['nomStagiaire']:"";
        $prenom = isset($_POST['prenomStagiaire'])?$_POST['prenomStagiaire']:"";
        $civilite = isset($_POST['civilite'])?$_POST['civilite']:"F";
        $idFiliere = isset($_POST['idFiliere'])?$_POST['idFiliere']:1;

        $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
        $imageTemp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($imageTemp,"../images/stagiaire/".$nomPhoto);

        $requete = "insert into stagiaire(nomStagiaire,prenomStagiaire,civilite,idFiliere,photo) values(?,?,?,?,?)";
        $params = array($nom,$prenom,$civilite,$idFiliere,$nomPhoto); 
    
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);  

        header('location:stagiaires.php');
    }else{
        header('location:login.php');
    } 

?>
