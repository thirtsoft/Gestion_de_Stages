<?php
    // include("connexiondb.php");
    // require("connexion.php");
     require_once('identifier.php');
     require_once("connexiondb.php");

    /* if(isset($_GET['nomPrenom']))
         $nomf = $_GET['nomPrenom'];
     else
         $nomf = "";
      */
     $nomStruct = isset($_GET['nomstrucutre'])?$_GET['nomstrucutre']:"";
     $idstagiaire = isset($_GET['idstagiaire'])?$_GET['idstagiaire']:0;

     $size = isset($_GET['size'])?$_GET['size']:6; 
     $page = isset($_GET['page'])?$_GET['page']:1;
     $offset = ($page - 1) * $size;

     $requeteStagiaire = "select * from stagiaire";

     if($idstagiaire == 0){
          $requeteStructure = "select idStructure,nomStructure,adresse,telephone,siteWeb,effectif,nomStagiaire  
                 from stagiaire as s, structure as struct
                 where s.idStagiaire = struct.idStagiaire
                 and (nomStructure like '%$nomStruct%')
                 order by idStructure
                 limit $size
                 offset $offset";
          $requeteCount = "select count(*) countStruct from structure
                    where nomStructure like '%$nomStruct%'";
     }else{
        $requeteStructure = "select idStructure,nomStructure,adresse,telephone,siteWeb,effectif,nomStagiaire 
                 from stagaire as s, structure as struct
                 where s.idStagiaire = struct.idStagiaire
                 and nomStructure like '%$nomStruct%'
                 and s.idStagiaire = $idstagiaire
                 order by idStructure
                 limit $size
                 offset $offset";
        $requeteCount = "select count(*) countStruct from structure
                 where nomStructure like '%$nomStruct%'
                 and idStagiaire = $idstagiaire";
     }
     
     $resultatStagiaire = $pdo->query($requeteStagiaire);
     $resultatStructure = $pdo->query($requeteStructure);
     $resultatCount = $pdo->query($requeteCount);

     $tabCount = $resultatCount->fetch();
     $nbreStructure = $tabCount['countStruct']; //decompter le nbre de filiere

     $reste = $nbreStructure % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreStructure/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreStructure/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des stagiaires</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
     <?php include("menu.php");?>

        <div class="container">
            <div class="panel panel-success margetop60">
                    <div class="panel-heading">Recherche des structures...</div>
                    <div class="panel-body">
                         <form method="get" action="structures.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="nomstrucutre" 
                                 placeholder="Nom de la structure" class="form-control"
                                 value="<?php echo $nomStruct ?>"/>
                            </div>
                            <label for="idstagiaire">Stagiaire : </label>
                            <select name="idstagiaire" class="form-control" id="idstagiaire"
                                 onchange="this.form.submit()">
                                 <option value=0>Toutes les filieres</option>
                              <?php while ($stagiaire=$resultatStagiaire->fetch()){ ?>
                                   <option value="<?php echo $stagiaire['idStagiaire'] ?>"
                                        <?php if($stagiaire['idStagiaire']===$idstagiaire) echo "selected" ?>>
                                        <?php echo $stagiaire['nomStagiaire']?>
                                    </option>
                                <?php }?>
                           
                            </select>
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouvelleStructure.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouvelle structure</a>
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des structure(<?php echo $nbreStructure ?> structures)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID structure</th><th>Nom</th><th>Effectif</th><th>Stagiaire</th>
                               <th>Adresse</th><th>SiteWeb</th><th>Téléphone</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while($structure = $resultatStructure->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $structure['idStructure'] ?></td>
                                  <td><?php echo $structure['nomStructure'] ?></td>
                                  <td><?php echo $structure['effectif'] ?></td>
                                  <td><?php echo $structure['nomStagiaire'] ?></td>
                                  <td><?php echo $structure['adresse'] ?></td>
                                  <td><?php echo $structure['siteWeb'] ?></td>
                                  <td><?php echo $structure['telephone'] ?></td>
                                
                                  <td>
                                     <a href="editerStructure.php?idStruct=<?php echo $structure['idStructure'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')"
                                         href="supprimerStructure.php?idStruct=<?php echo $structure['idStructure'] ?>">
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
          <a href="structures.php?page=<?php echo $i;?>&nomstrucutre=<?php echo $nomStruct ?>&idstagiaire=<?php echo $stagiaire ?>">
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