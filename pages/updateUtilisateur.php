<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
            require_once('connexiondb.php');

            $idUtilisateur = isset($_POST['idUtilisateur'])?$_POST['idUtilisateur']:0;
            $login = isset($_POST['login'])?$_POST['login']:"";
            $email = isset($_POST['email'])?$_POST['email']:"";
            $role = isset($_POST['role'])?$_POST['role']:"";
            
            $requete = "update utilisateur set login=?,email=?,role=? where idUtilisateur=?";
            $params = array($login,$email,$role,$idUtilisateur); 
        
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);  

            header('location:utilisateurs.php'); 
    }else{
        header('location:login.php');
    }

?>
