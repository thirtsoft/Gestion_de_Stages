<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
        require_once('connexiondb.php');

        $login = isset($_POST['login'])?$_POST['login']:"";
        $email = isset($_POST['email'])?$_POST['email']:"";
        $role = isset($_POST['role'])?$_POST['role']:"";
        $etat = isset($_POST['etat'])?$_POST['etat']:1;
        $password = isset($_POST['password'])?$_POST['password']:"";

        if($etat==1){
            $requete = "insert into utilisateur(login,email,role,etat,password) values(?,?,?,?,?)";
            $params = array($login,$email,$role,$etat,$password); 

        }else{
            $requete = "insert into utilisateur(login,email,role,etat,password) values(?,?,?,?,?)";
            $params = array($login,$email,$role,$etat,$password);

        }
    
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);  

        header('location:utilisateurs.php');
    }else{
        header('location:login.php');
    } 

?>
