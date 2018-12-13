<?php 
    require_once('identifier.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle Filière</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
    <?php include("menu.php");?>
    <div class="container">
            

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Veuillez saisir les données de la nouvelle filière</div>
                <div class="panel-body">
                    <form method="post" action="insertFiliere.php" class="form">

                        <div class="form-group">
                              <label for="niveau">Nom de la filière : </label>
                                <input type="text" name="nomF" 
                                   placeholder="Nom de la Filière" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="niveau">Niveau : </label>
                            <select name="niveau" class="form-control" id="niveau">
                               <option value="m">Master</option>
                               <option value="l">Licence</option>
                               <option value="ts" selected>Techniciens spécialisés</option>
                               <option value="t">Techniciens</option>
                               <option value="q">Qualification</option>
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