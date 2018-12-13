<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
            require_once('connexiondb.php');

            $idEncad = isset($_POST['idEncad'])?$_POST['idEncad']:0;
            $civilite = isset($_POST['civilite'])?$_POST['civilite']:"M";
            $nom = isset($_POST['nomEncadrant'])?$_POST['nomEncadrant']:"";
            $prenom = isset($_POST['prenom'])?$_POST['prenom']:"";
            $grade = isset($_POST['grade'])?$_POST['grade']:"";
            $email = isset($_POST['email'])?$_POST['email']:"";

            $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
            $imageTemp = $_FILES['photo']['tmp_name'];
            move_uploaded_file($imageTemp,"../images/encadrant/".$nomPhoto);

        if(!empty($nomPhoto)){ 
                $requete = "update encadrant set civilite=?,nomEncadrant=?,prenom=?,grade=?,email=?,photo=? where idEncadrant=?";
                $params = array($civilite,$nom,$prenom,$grade,$email,$nomPhoto,$idEncad);

        }else{
                $requete = "update encadrant set civilite=?,nomEncadrant=?,prenom=?,grade=?,email=?,photo=? where idEncadrant=?";
                $params = array($civilite,$nom,$prenom,$grade,$email,$nomPhoto,$idEncad);

            } 
        
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);  

            header('location:encadrants.php'); 
   }else{
       header('location:login.php');
   }

?>
