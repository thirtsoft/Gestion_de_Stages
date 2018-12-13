<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $requeteFiliere = "select * from filiere";
    $resultatFiliere = $pdo->query($requeteFiliere);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Stagiaire</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Renseignez les informations du stagiaire</div>
                <div class="panel-body">
                    <form method="post" action="insertStagiaire.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="nom">Nom : </label>
                                <input type="text" name="nom" placeholder="Nom" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="prenom">Prénom : </label>
                                <input type="text" name="prenom" placeholder="Prénom" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="civilite">Civilité : </label>
                              <div class="radio">
                                  <label><input type="radio" name="civilite" value="F" checked/>F</label><br>
                                  <label><input type="radio" name="civilite" value="M"/>M</label>
                               </div>
                        </div>

                        <div class="form-group">
                            <label for="idFiliere">Filiere : </label>
                            <select name="idFiliere" class="form-control" id="idFiliere">
                               <?php while($filiere=$resultatFiliere->fetch()){?>
                                 <option value="<?php echo $filiere['idFiliere'] ?>">
                                    <?php echo $filiere['nomFiliere'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                              <label for="photo">Photo : </label>
                                <input type="file" name="photo"/>
                        </div>
                        
                            <button type="submit"  class="btn btn-success"> 
                                 <span class="glyphicon glyphicon-save "></span> 
                                  Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-success"> 
                                <a href="stagiaires.php"><span class="glyphicon glyphicon-retour "></span> </a>
                                  Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>