<?php
    // include("connexiondb.php");
    // require("connexion.php"); 

     require_once('identifier.php');
     require_once("connexiondb.php");
     

    /* if(isset($_GET['nomF']))
         $nomf = $_GET['nomF'];
     else
         $nomf = "";
      */
     $nomf = isset($_GET['nomF'])?$_GET['nomF']:"";
     $niveau = isset($_GET['niveau'])?$_GET['niveau']:"all";

     $size = isset($_GET['size'])?$_GET['size']:6; 
     $page = isset($_GET['page'])?$_GET['page']:1;
     $offset = ($page - 1) * $size;

     if($niveau == "all"){
          $requete = "select * from filiere
                    where nomFiliere like '%$nomf%'
                    limit $size
                    offset $offset";
          $requeteCount = "select count(*) countF from filiere
                    where nomFiliere like '%$nomf%'";
     }else{
          $requete = "select * from filiere
                  where nomFiliere like '%$nomf%'
                  and niveau = '$niveau'
                  limit $size
                  offset $offset";


          $requeteCount = "select count(*) countF from filiere
                  where nomFiliere like '%$nomf%'
                  and niveau = '$niveau'";
     }

     $resultatFil = $pdo->query($requete);

     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbreFiliere = $tabCount['countF']; //decompter le nbre de filiere

     $reste = $nbreFiliere % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreFiliere/$size);
     else
          $nbrePage = floor($nbreFiliere/$size) + 1;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des filières</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
     <?php include("menu.php");?>

        <div class="container">
            <div class="panel panel-success margetop60">
                    <div class="panel-heading">Recherche des filieres...</div>
                    <div class="panel-body">
                         <form method="get" action="filieres.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="nomF" 
                                 placeholder="Nom de la Filière" class="form-control"
                                 value="<?php echo $nomf ?>"/>
                            </div>
                            <label for="niveau">Niveau : </label>
                            <select name="niveau" class="form-control" id="niveau"
                                 onchange="this.form.submit()">
                               <option value="all" <?php if($niveau === "all") echo "selected" ?>>Tous les niveaux</option>
                               <option value="m"   <?php if($niveau === "m")   echo "selected" ?>>Master</option>
                               <option value="l"   <?php if($niveau === "l")   echo "selected" ?>>Licence</option>
                               <option value="ts"  <?php if($niveau === "ts")  echo "selected" ?>>Techniciens spécialisés</option>
                               <option value="t"   <?php if($niveau === "t")   echo "selected" ?>>Techniciens</option>
                               <option value="q"   <?php if($niveau === "q")   echo "selected" ?>>Qualification</option>
                            </select>
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouvelleFiliere.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouvelle filière</a>
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des filieres(<?php echo $nbreFiliere ?>)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID filière</th><th>Nom Filière</th><th>Niveau Filière</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php while($filiere = $resultatFil->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $filiere['idFiliere'] ?></td>
                                  <td><?php echo $filiere['nomFiliere'] ?></td>
                                  <td><?php echo $filiere['niveau'] ?></td>
                                  
                                  <td>
                                     <a href="editerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer la filière')"
                                         href="supprimerFiliere.php?idF=<?php echo $filiere['idFiliere'] ?>">
                                         <span class="glyphicon glyphicon-trash "></span> </td>
                                    </a>
                                </tr>
                             <?php }?>   
                         
                        </tbody>

                     </table>

                     <div>
                        <ul class="pagination">
                              <?php for($i=1; $i<=$nbrePage; $i++){ ?>
                                   <li class="<?php if($i==$page) echo 'active'?>">
          <a href="filieres.php?page=<?php echo $i;?>&nomF=<?php echo $nomf ?>&niveau=<?php echo $niveau ?>">
                                          <?php echo $i; ?>
                                        </a>
                                   </li>
                               <?php } ?>
                         </ul>
                     </div>


                </div>
        </div>
</body>
</html>