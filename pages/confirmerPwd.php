<?php
    session_start(); 
    if(isset($_SESSION['utilisateur'])){
            require_once('connexiondb.php');

            $idUtilisateur = isset($_POST['idUtilisateur'])?$_POST['idUtilisateur']:0;
           // $password = isset($_POST['password'])?$_POST['password']:"";
            $nemPwd = isset($_POST['password1'])?$_POST['password1']:"";
            $nemPwd1 = isset($_POST['password2'])?$_POST['password2']:"";

            if($_POST['$nemPwd']==$_POST['$nemPwd1']){
                $pass_md5 = md5($_POST['password']);
                $requete = "update utilisateur set password=? where idUtilisateur=?";
                $params = array($pass_md5,$idUtilisateur); 
                echo '<p>La modification de mot de passe a été prise en compte ! Déconnectez-vous et reconnectez-vous afin de valider ce changement.</p><br/>'

                header('location:utilisateurs.php');

            }else{
                echo'Vous n\'avez pas tapé deux fois le même mot de passe';
                header('location:modifierPwd.php');
            }
                   
            
    }else{
        header('location:login.php');
    }

?>
