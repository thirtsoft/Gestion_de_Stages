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
     $nomProjet = isset($_GET['intituleProjet'])?$_GET['intituleProjet']:"";
     $idstagiaire = isset($_GET['idstagiaire'])?$_GET['idstagiaire']:0;
     $idencadrant = isset($_GET['idencadrant'])?$_GET['idencadrant']:0;

     $size = isset($_GET['size'])?$_GET['size']:6; 
     $page = isset($_GET['page'])?$_GET['page']:1;
     $offset = ($page - 1) * $size;

     $requeteStagiaire = "select * from stagiaire";
     $requeteEncadrant = "select * from encadrant";

     if(($idstagiaire == 0)&&($idencadrant == 0)){
          $requeteProjet = "select idProjet, intitule, description,prenomStagiaire,nomEncadrant, renumeration, date_debut, date_fin 
                 from stagiaire as s, encadrant as e, projet as p
                 where s.idStagiaire = p.idStagiaire
                 and   e.idEncadrant = p.idEncadrant
                 and (intitule like '%$nomProjet%')
                 order by idProjet
                 limit $size
                 offset $offset";
          $requeteCount = "select count(*) countP from projet
                    where intitule like '%$nomProjet%'";
     }else{
        $requeteProjet = "select idProjet, intitule, description,prenomStagiaire, nomEncadrant, renumeration, date_debut, date_fin
                 from stagiaire as s, encadrant as e, projet as p
                 where s.idStagiaire = p.idStagiaire
                 and   e.idEncadrant = p.idEncadrant
                 and (intitule like '%$nomProjet%')
                 and s.idStagiaire = $idstagiaire
                 and e.idEncadrant = $idencadrant
                 order by idProjet
                 limit $size
                 offset $offset";
        $requeteCount = "select count(*) countP from projet
                       where (intitule like '%$nomProjet%')
                         and idStagiaire = $idstagiaire
                         and idEncadrant = $idencadrant";
     }

     $resultatStagiaire = $pdo->query($requeteStagiaire);
     $resultatEncadrant = $pdo->query($requeteEncadrant);
     $resultatProjet    = $pdo->query($requeteProjet);
     $resultatCount = $pdo->query($requeteCount);

     $tabCount = $resultatCount->fetch();
     $nbreProjet = $tabCount['countP']; //decompter le nbre de filiere

     $reste = $nbreProjet % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreProjet/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreProjet/$size) + 1; // permet de prendre que la partie entiere de la division

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
                    <div class="panel-heading">Recherche des projets...</div>
                    <div class="panel-body">
                         <form method="get" action="projets.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="intituleProjet" 
                                 placeholder="intitule du Projet" class="form-control"
                                 value="<?php echo $nomProjet ?>"/>
                            </div>

                            <label for="idstagiaire">Stagiaires : </label>
                            <select name="idstagiaire" class="form-control" id="idstagiaire"
                                 onchange="this.form.submit()">
                                 <option value=0>Toutes les stagiaires</option>
                              <?php while ($stagiaire=$resultatStagiaire->fetch()){ ?>
                                   <option value="<?php echo $stagiaire['idStagiaire'] ?>"
                                        <?php if($stagiaire['idStagiaire']===$idstagiaire) echo "selected" ?>>
                                        <?php echo $stagiaire['prenomStagiaire']?>
                                    </option>
                                <?php }?>
                            </select>

                    

                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouveauProjet.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouveau projet</a>
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des projets(<?php echo $nbreProjet ?> projets)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID Projet</th><th>Intitule</th><th>Description</th><th>Stagiaire</th><th>Encadrant</th>
                               <th>Rénumération</th><th>Date début</th><th>Date fin</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php while($projet = $resultatProjet->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $projet['idProjet'] ?></td>
                                  <td><?php echo $projet['intitule'] ?></td>
                                  <td><?php echo $projet['description'] ?></td>
                                  <td><?php echo $projet['prenomStagiaire'] ?></td>
                                  <td><?php echo $projet['nomEncadrant'] ?></td>
                                  <td><?php echo $projet['renumeration'] ?></td>
                                  <td><?php echo $projet['date_debut'] ?></td>
                                  <td><?php echo $projet['date_fin'] ?></td>
                                  
                                
                                  <td>
                                     <a href="editerProjet.php?idP=<?php echo $projet['idProjet'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer le projet')"
                                         href="supprimerProjet.php?idP=<?php echo $projet['idProjet'] ?>">
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
          <a href="projets.php?page=<?php echo $i;?>&intituleProjet=<?php echo $nomProjet ?>&idstagiaire=<?php echo $idstagiaire ?>">
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