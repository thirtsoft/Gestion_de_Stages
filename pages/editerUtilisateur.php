<?php
    require_once('identifier.php'); 
    require_once('connexiondb.php');

    $idUtilisateur = isset($_GET['idUtilisateur'])?$_GET['idUtilisateur']:0;
    $requeteUtilisateur = "select * from utilisateur where idUtilisateur = $idUtilisateur";
    $resultatUtilisateur = $pdo->query($requeteUtilisateur);

    $utilisateur = $resultatUtilisateur->fetch();

    $login = $utilisateur['login'];
    $email = $utilisateur['email'];
    $role = strtoupper($utilisateur['role']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition d'un Utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition d'un utilisateur</div>
                <div class="panel-body">
                    <form method="post" action="updateUtilisateur.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="idUtilisateur">Id de l'utilisateur : <?php echo $idUtilisateur ?> </label>
                                <input type="hidden" name="idUtilisateur" class="form-control" 
                                value="<?php echo $idUtilisateur ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="login">Login : </label>
                                <input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="email">Email : </label>
                                <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
                        </div>

                        <div class="form-group">
                           <select name="role" class="form-control" id="role">
                              <option value="ADMIN"<?php if($role=="ADMIN") echo "selected"?>>Administrateur</option>
                              <option value="VISITEUR"<?php if($role=="VISITEUR") echo "selected"?>>Visiteur</option>
                           </select>
                        </div>
                        
                        <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-save "></span> 
                               Enregistrer 
                        </button>
                          &nbsp;&nbsp;
                        <a href="modifierPwd.php?idUtilisateur=<?php echo $idUtilisateur ?>">Changer Mot de Passe</a>
                            
                    </form>
                </div>
        </div>
</body>
</html>