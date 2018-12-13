<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');

    $idEncad = isset($_GET['idEncad'])?$_GET['idEncad']:0;
    $requeteEncad = "select * from encadrant where idEncadrant = $idEncad";
    $resultatEncad = $pdo->query($requeteEncad);
    $encadrant = $resultatEncad->fetch();
    $civilite =$encadrant['civilite'];
    $nom = $encadrant['nomEncadrant'];
    $prenom = $encadrant['prenom'];
    $grade =strtolower($encadrant['grade']);
    $email = $encadrant['email'];
    $nomPhoto = $encadrant['photo'];
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition d'un Encadrant</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition d'un encadrant</div>
                <div class="panel-body">
                    <form method="post" action="updateEncadrant.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="idEncad">Id de l'encadrant : <?php echo $idEncad ?> </label>
                                <input type="hidden" name="idEncad" class="form-control" 
                                value="<?php echo $idEncad ?>"/>
                        </div>

                         <div class="form-group">
                              <label for="civilite">Civilité : </label>
                              <div class="radio">

                                 <label><input type="radio" name="civilite" value="M"
                                    <?php if($civilite==="M") echo "checked" ?>/>M</label><br>

                                  <label><input type="radio" name="civilite" value="F"
                                    <?php if($civilite==="F") echo "checked" ?> />F</label>
                                  
                               </div>
                        </div>

                        <div class="form-group">
                              <label for="nomEncadrant">Nom : </label>
                                <input type="text" name="nomEncadrant" placeholder="Nom" class="form-control" value="<?php echo $nom ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="prenom">Prénom : </label>
                                <input type="text" name="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="grade">Grade : </label>
                                <input type="text" name="grade" placeholder="Grade" class="form-control" value="<?php echo $grade ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="email">Email : </label>
                                <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="photo">Photo : </label>
                                <input type="file" name="photo"/>
                        </div>
                        
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-save "></span> 
                               Enregistrer </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>