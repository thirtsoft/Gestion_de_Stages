<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idP = isset($_GET['idP'])?$_GET['idP']:0;

    $requeteProjet = "select * from projet where idProjet = $idP";
    $resultatProjet = $pdo->query($requeteProjet);
    //Permet de filtrer les projets et de mettre dans un tableau
    $projet = $resultatProjet->fetch();

    $intitule     = $projet['intitule'];
    $description  = $projet['description'];
    $idStagiaire  = $projet['idStagiaire'];
    $idEncadrant  = $projet['idEncadrant'];
    $renumeration = $projet['renumeration'];
    $date_debut   = $projet['date_debut'];
    $date_fin     = $projet['date_fin'];


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
    <title>Edition d'un Stagiaire</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition d'un projet</div>
                <div class="panel-body">
                    <form method="post" action="updateProjet.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="idP">Id du projet : <?php echo $idP ?> </label>
                                <input type="hidden" name="idP" class="form-control" 
                                value="<?php echo $idP ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="intitule">Intitule : </label>
                                <input type="text" name="intitule" placeholder="intitule" class="form-control" value="<?php echo $intitule ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="description">Description : </label>
                                <input type="text" name="description" placeholder="description" class="form-control" value="<?php echo $description ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="idStagiaire">Stagiaire : </label>
                            <select name="idStagiaire" class="form-control" id="idStagiaire">
                               <?php while($stagiaire=$resultatStagiaire->fetch()){?>
                                 <option value="<?php echo $stagiaire['idStagiaire'] ?> "
                                 <?php if($idStagiaire===$stagiaire['idStagiaire']) echo "selected" ?> >
                                    <?php echo $stagiaire['prenomStagiaire'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="idEncadrant">Encadrant : </label>
                            <select name="idEncadrant" class="form-control" id="idEncadrant">
                               <?php while($encadrant=$resultatEncadrant->fetch()){?>
                                 <option value="<?php echo $encadrant['idEncadrant'] ?> "
                                 <?php if($idEncadrant===$encadrant['idEncadrant']) echo "selected" ?> >
                                    <?php echo $encadrant['nomEncadrant'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                         <div class="form-group">
                              <label for="renumeration">Rénumeration : </label>
                                <input type="text" name="renumeration" placeholder="renumeration" class="form-control" value="<?php echo $renumeration ?>"/>
                        </div>

                         <div class="form-group">
                              <label for="date_debut">Date Début : </label>
                                <input type="text" name="date_debut" placeholder="date début" class="form-control" value="<?php echo $date_debut ?>"/>
                        </div>

                         <div class="form-group">
                              <label for="date_fin">Date Fin : </label>
                                <input type="text" name="date_fin" placeholder="date fin" class="form-control" value="<?php echo $date_fin ?>"/>
                        </div>

                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-save "></span> 
                               Enregistrer </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>