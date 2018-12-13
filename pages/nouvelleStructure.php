<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $requeteStagiaire = "select * from stagiaire";
    $resultatStagiaire = $pdo->query($requeteStagiaire);
   
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
                <div class="panel-heading">Renseignez les informations de la structure</div>
                <div class="panel-body">
                    <form method="post" action="insertStructure.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="nomStructure">Nom Structure : </label>
                                <input type="text" name="nomStructure" placeholder="nomStructure" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="effectif">Effectif : </label>
                                <input type="text" name="effectif" placeholder="nomStructure" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="idStagiaire">Stagiaire : </label>
                            <select name="idStagiaire" class="form-control" id="idStagiaire">
                               <?php while($stagiaire=$resultatStagiaire->fetch()){?>
                                 <option value="<?php echo $stagiaire['idStagiaire'] ?>">
                                    <?php echo $stagiaire['nomStagiaire'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                              <label for="adresse">Adresse : </label>
                                <input type="text" name="adresse" placeholder="adresse" class="form-control"/>
                        </div>

                         <div class="form-group">
                              <label for="siteWeb">Site Web : </label>
                              <input type="text" name="siteWeb" placeholder="telephone" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="telephone">Telephone : </label>
                              <input type="text" name="telephone" placeholder="telephone" class="form-control"/>
                        </div>

                        
                            <button type="submit"  class="btn btn-success"> 
                                 <span class="glyphicon glyphicon-save "></span> 
                                  Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-success"> 
                                <a href="structures.php"><span class="glyphicon glyphicon-retour "></span> </a>
                                  Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>