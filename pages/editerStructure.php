<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');

    $idStruct = isset($_GET['idStruct'])?$_GET['idStruct']:0;
    $requeteStructure = "select * from structure where idStructure = $idStruct";
    $resultatStructure = $pdo->query($requeteStructure);
    $structure = $resultatStructure->fetch();

    $nomStructure = $structure['nomStructure'];
    $effectif = $structure['effectif'];
    $idStagiaire  = $structure['idStagiaire'];
    $adresse = $structure['adresse'];
    $siteWeb = $structure['siteWeb'];
    $telephone = $structure['telephone'];
    


    $requeteStagiaire = "select * from stagiaire";
    $resultatStagiaire= $pdo->query($requeteStagiaire);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition d'une structure</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition d'une Structure</div>
                <div class="panel-body">
                    <form method="post" action="updateStructure.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="idStruct">Id du structure : <?php echo $idStruct ?> </label>
                                <input type="hidden" name="idStruct" class="form-control" 
                                value="<?php echo $idStruct ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="nomStructure">Nom Structure : </label>
                                <input type="text" name="nomStructure" placeholder="Nom" class="form-control" value="<?php echo $nomStructure ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="effectif">Effectif : </label>
                                <input type="text" name="effectif" placeholder="effectif" class="form-control" value="<?php echo $effectif ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="idStagiaire">Stagiaire : </label>
                            <select name="idStagiaire" class="form-control" id="idStagiaire">
                               <?php while($stagiaire=$resultatStagiaire->fetch()){?>
                                 <option value="<?php echo $stagiaire['idStagiaire'] ?> "
                                 <?php if($idStagiaire===$stagiaire['idStagiaire']) echo "selected" ?> >
                                    <?php echo $stagiaire['nomStagiaire'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                              <label for="adresse">Adresse : </label>
                                <input type="text" name="adresse" placeholder="adresse" class="form-control" value="<?php echo $adresse ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="siteWeb">Site Web : </label>
                                <input type="text" name="siteWeb" placeholder="siteWeb" class="form-control" value="<?php echo $siteWeb ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="telephone">Telephone : </label>
                                <input type="text" name="telephone" placeholder="telephone" class="form-control" value="<?php echo $telephone ?>"/>
                        </div>

                        
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-save "></span> 
                               Enregistrer </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>