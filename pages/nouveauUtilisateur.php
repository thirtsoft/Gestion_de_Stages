<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Renseignez les informations de l'utilisateur</div>
                <div class="panel-body">
                    <form method="post" action="insertUtilisateur.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="login">Login : </label>
                                <input type="text" name="login" placeholder="Login" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="email">Email : </label>
                                <input type="email" name="email" placeholder="Email" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="role">Role : </label>
                                <input type="text" name="role" placeholder="Role" class="form-control"/>
                        </div>

                        <div class="form-group">
                        <label for="etat">Etat : </label>
                           <select>
                               <option value=1 name="etat" selected>1</option>
                               <option value=0 name="etat">0</option>
                            </select>
                        </div>

                        <div class="form-group">
                              <label for="password">Password : </label>
                                <input type="text" name="password" placeholder="Password" class="form-control"/>
                        </div>

                        
                            <button type="submit"  class="btn btn-success"> 
                                 <span class="glyphicon glyphicon-save "></span> 
                                  Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-success"> 
                                <a href="utilisateurs.php"><span class="glyphicon glyphicon-retour "></span> </a>
                                  Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>