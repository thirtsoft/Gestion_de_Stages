<?php
    session_start();
    if(isset($_SESSION['erreurLogin'])){
        $erreurLogin = $_SESSION['erreurLogin']; 
    }else{
        $erreurLogin = "";
    }
    session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentification</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Authentification</div>
                <div class="panel-body">
                    <form method="post" action="seConnecter.php" class="form">
                       <?php if(!empty($erreurLogin)){?>
                            <div class="alert alert-danger">
                                <?php echo $erreurLogin ?>
                            </div>
                       <?php }?>
                        <div class="form-group">
                              <label for="login">Login : </label>
                                <input type="text" name="login" placeholder="Login" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="password">Password : </label>
                                <input type="password" name="password" placeholder="Password" class="form-control"/>
                        </div>
                        
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-log-in "></span> 
                               Se Connecter
                             </button>
                    </form>
                </div>
        </div>

        <p class="line-1 anim-typewriter ">GESTION <span class="col">DE STAGES </span> EN 3 CLICS !</p>
</body>
</html>