<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    
    $requeteStagiaire = "select * from stagiaire";
    $resultatStagiaire = $pdo->query($requeteStagiaire);

    $requeteEncadrant = "select * from encadrant";
    $resultatEncadrant = $pdo->query($requeteEncadrant);
   
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
                <div class="panel-heading">Renseignez les informations du projet</div>
                <div class="panel-body">
                    <form method="post" action="insertProjet.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="intitule">Intitule : </label>
                                <input type="text" name="intitule" placeholder="intitule" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="description">Description : </label>
                                <input type="text" name="description" placeholder="description" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="idStagiaire">Stagiaire : </label>
                            <select name="idStagiaire" class="form-control" id="idStagiaire">
                               <?php while($stagiaire=$resultatStagiaire->fetch()){?>
                                 <option value="<?php echo $stagiaire['idStagiaire'] ?>">
                                    <?php echo $stagiaire['prenomStagiaire'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idEncadrant">Encadrant : </label>
                            <select name="idEncadrant" class="form-control" id="idEncadrant">
                               <?php while($encadrant=$resultatEncadrant->fetch()){?>
                                 <option value="<?php echo $encadrant['idEncadrant'] ?>">
                                    <?php echo $encadrant['nomEncadrant'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                         <div class="form-group">
                              <label for="renumeration">Rénumération : </label>
                                <input type="text" name="renumeration" placeholder="renumeration" class="form-control"/>
                        </div>

                         <div class="form-group">
                              <label for="date_debut">Date Début : </label>
                                <input type="text" name="date_debut" placeholder="date_debut" class="form-control"/>
                        </div>

                         <div class="form-group">
                              <label for="date_fin">Date Fin : </label>
                                <input type="text" name="date_fin" placeholder="date_fin" class="form-control"/>
                        </div>

            
                        
                            <button type="submit"  class="btn btn-success"> 
                                 <span class="glyphicon glyphicon-save "></span> 
                                  Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-success"> 
                                <a href="projets.php"><span class="glyphicon glyphicon-retour "></span> </a>
                                  Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>