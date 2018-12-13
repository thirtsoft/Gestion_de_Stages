<?php
    require_once('identifier.php'); 
    require_once('connexiondb.php');

    $idUtilisateur = isset($_GET['idUtilisateur'])?$_GET['idUtilisateur']:0;

    $requeteUtilisateur = "select * from utilisateur where idUtilisateur = $idUtilisateur";
    $resultatUtilisateur = $pdo->query($requeteUtilisateur);

    $utilisateur = $resultatUtilisateur->fetch();

    $password = $utilisateur['password'];
    $password1 = $utilisateur['password1'];
    $password2 = $utilisateur['password2'];
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Changer mot de passe</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
            
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Changer mot de passe</div>
                <div class="panel-body">
                    <form method="post" action="confirmerPwd.php" class="form" enctype="multipart/form-data">
                     
                        <div class="form-group">
                              <label for="idUtilisateur">Id de l'utilisateur : <?php echo $idUtilisateur ?> </label>
                                <input type="hidden" name="idUtilisateur" class="form-control" 
                                value="<?php echo $idUtilisateur ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="password">Ancien mot de passe : </label>
                                <input type="text" name="password" placeholder="Password" class="form-control" value="<?php echo $password ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="password1">Nouveau mot de passe : </label>
                                <input type="text" name="password1" id="password1" placeholder="Nouveau mot de passe " class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="password2">Confirmez le nouveau mot de passe : </label>
                                <input type="text" name="password2" id="password2" placeholder="Retapper le nouveau mot de passe " class="form-control"/>
                        </div>

                    
                        
                        <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-valider "></span> 
                               Valider
                        </button>  
                            
                    </form>
                </div>
        </div>
</body>
</html>