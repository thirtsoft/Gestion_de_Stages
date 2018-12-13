<?php 
    session_start();//permet de démarrer la session pour pouvoir utiliser les sessions
    require_once('connexiondb.php');
    $login = isset($_POST['login'])?$_POST['login']:"";
    $password = isset($_POST['password'])?$_POST['password']:"";

    $requete = "select * from utilisateur where login='$login' and password=MD5('$password')";
    $resultat = $pdo->query($requete);

    if($utilisateur=$resultat->fetch()){
        if($utilisateur['etat']==1){
            $_SESSION['utilisateur']=$utilisateur;
            header('location:../index.php');
        }else{
            $_SESSION['erreurLogin']="<strong>Erreur!!</strong>Votre compte est désactiver.<br> Veuillez contacter l'administrateur";
            header('location:login.php');
        }

    }else{
        $_SESSION['erreurLogin']="<strong>Erreur!!</strong> Login ou mot de passe incorrect";
        header('location:login.php');
    }
?>