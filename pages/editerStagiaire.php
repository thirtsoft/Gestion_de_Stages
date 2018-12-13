<?php 
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idS = isset($_GET['idS'])?$_GET['idS']:0;
    $requeteStagiaire = "select * from stagiaire where idStagiaire = $idS";
    $resultatStagiaire = $pdo->query($requeteStagiaire);
    $stagiaire = $resultatStagiaire->fetch();
    $nom = $stagiaire['nomStagiaire'];
    $prenom = $stagiaire['prenomStagiaire'];
    $civilite = strtoupper($stagiaire['civilite']);
    $idFiliere  = $stagiaire['idFiliere'];
    $nomPhoto = $stagiaire['photo'];


    $requeteFiliere = "select * from filiere";
    $resultatFiliere = $pdo->query($requeteFiliere);
   
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
                <div class="panel-heading">Edition d'un stagiaire</div>
                <div class="panel-body">
                    <form method="post" action="updateStagiaire.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                              <label for="idS">Id du stagiaire : <?php echo $idS ?> </label>
                                <input type="hidden" name="idS" class="form-control" 
                                value="<?php echo $idS ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="nomStagiaire">Nom : </label>
                                <input type="text" name="nomStagiaire" placeholder="Nom" class="form-control" value="<?php echo $nom ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="prenomStagiaire">Prénom : </label>
                                <input type="text" name="prenomStagiaire" placeholder="Prénom" class="form-control" value="<?php echo $prenom ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="civilite">Civilité : </label>
                              <div class="radio">
                                  <label><input type="radio" name="civilite" value="F"
                                    <?php if($civilite==="F") echo "checked" ?> />F</label><br>
                                  <label><input type="radio" name="civilite" value="M"
                                    <?php if($civilite==="M") echo "checked" ?>/>M</label>
                               </div>
                        </div>

                        <div class="form-group">
                            <label for="idFiliere">Filiere : </label>
                            <select name="idFiliere" class="form-control" id="idFiliere">
                               <?php while($filiere=$resultatFiliere->fetch()){?>
                                 <option value="<?php echo $filiere['idFiliere'] ?> "
                                 <?php if($idFiliere===$filiere['idFiliere']) echo "selected" ?> >
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
                               Enregistrer </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>