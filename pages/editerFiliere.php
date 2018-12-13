<?php
    require_once('identifier.php'); 
    require_once('connexiondb.php');
    $idf = isset($_GET['idF'])?$_GET['idF']:0;
    $requete = "select * from filiere where idFiliere = $idf";
    $resultat = $pdo->query($requete);
    $filiere = $resultat->fetch();
    $nomf = $filiere['nomFiliere'];
    $niveau = strtolower($filiere['niveau']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edition d'une Filière</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition d'une filière</div>
                <div class="panel-body">
                    <form method="post" action="updateFiliere.php" class="form">
                       
                        <div class="form-group">
                              <label for="niveau">Id de la filière : <?php echo $idf ?> </label>
                                <input type="hidden" name="idF" class="form-control" 
                                value="<?php echo $idf ?>"/>
                        </div>

                        <div class="form-group">
                              <label for="niveau">Nom de la filière : </label>
                                <input type="text" name="nomF" 
                                   placeholder="Nom de la Filière" class="form-control" 
                                   value="<?php echo $nomf ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="niveau">Niveau : </label>
                            <select name="niveau" class="form-control" id="niveau">
                               <option value="m" <?php if($niveau === "m") echo "selected" ?>>Master</option>
                               <option value="l" <?php if($niveau === "l") echo "selected" ?>>Licence</option>
                               <option value="ts" <?php if($niveau === "ts") echo "selected" ?>>Techniciens spécialisés</option>
                               <option value="t" <?php if($niveau === "t") echo "selected" ?>>Techniciens</option>
                               <option value="q" <?php if($niveau === "q") echo "selected" ?>>Qualification</option>
                            </select>
                        </div>
                        
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-save "></span> 
                               Enregistrer </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>