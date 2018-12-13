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
     $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
     $idfiliere = isset($_GET['idfiliere'])?$_GET['idfiliere']:0;

     $size = isset($_GET['size'])?$_GET['size']:6; 
     $page = isset($_GET['page'])?$_GET['page']:1;
     $offset = ($page - 1) * $size;

     $requeteFiliere = "select * from filiere";

     if($idfiliere == 0){
          $requeteStagiaire = "select idStagiaire, nomStagiaire, prenomStagiaire, civilite, nomFiliere, photo 
                 from filiere as f, stagiaire as s
                 where f.idFiliere = s.idFiliere
                 and (nomStagiaire like '%$nomPrenom%' or prenomStagiaire like '%$nomPrenom%')
                 order by idStagiaire
                 limit $size
                 offset $offset";
          $requeteCount = "select count(*) countS from stagiaire
                    where nomStagiaire like '%$nomPrenom%' or 
                          prenomStagiaire like '%$nomPrenom%'";
     }else{
        $requeteStagiaire = "select idStagiaire, nomStagiaire, prenomStagiaire, civilite, nomFiliere, photo 
                 from filiere as f, stagiaire as s
                 where f.idFiliere = s.idFiliere
                 and (nomStagiaire like '%$nomPrenom%' or prenomStagiaire like '%$nomPrenom%')
                 and f.idFiliere = $idfiliere
                 order by idStagiaire
                 limit $size
                 offset $offset";
        $requeteCount = "select count(*) countS from stagiaire
                       where (nomStagiaire like '%$nomPrenom%' or prenomStagiaire like '%$nomPrenom%')
                         and idFiliere = $idfiliere";
     }

     $resultatFiliere = $pdo->query($requeteFiliere);
     $resultatStagiaire = $pdo->query($requeteStagiaire);
     
     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbreStagiaire = $tabCount['countS']; //decompter le nbre de filiere

     $reste = $nbreStagiaire % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreStagiaire/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreStagiaire/$size) + 1; // permet de prendre que la partie entiere de la division

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
                    <div class="panel-heading">Recherche des stagiaires...</div>
                    <div class="panel-body">
                         <form method="get" action="stagiaires.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="nomPrenom" 
                                 placeholder="Nom et Prénom du stagiaire" class="form-control"
                                 value="<?php echo $nomPrenom ?>"/>
                            </div>
                            <label for="idfiliere">Filiere : </label>
                            <select name="idfiliere" class="form-control" id="idfiliere"
                                 onchange="this.form.submit()">
                                 <option value=0>Toutes les filieres</option>
                              <?php while ($filiere=$resultatFiliere->fetch()){ ?>
                                   <option value="<?php echo $filiere['idFiliere'] ?>"
                                        <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                                        <?php echo $filiere['nomFiliere']?>
                                    </option>
                                <?php }?>
                           
                            </select>
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouveauStagiaire.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouveau stagiaire</a>
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des stagiaires(<?php echo $nbreStagiaire ?> stagiaires)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID stagiaire</th><th>Nom</th><th>Prénom</th><th>Civilité</th>
                               <th>Filière</th><th>Photo</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php while($stagiaire = $resultatStagiaire->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $stagiaire['idStagiaire'] ?></td>
                                  <td><?php echo $stagiaire['nomStagiaire'] ?></td>
                                  <td><?php echo $stagiaire['prenomStagiaire'] ?></td>
                                  <td><?php echo $stagiaire['civilite'] ?></td>
                                  <td><?php echo $stagiaire['nomFiliere'] ?></td>
                                  <td>
                                     <img src="../images/stagiaire/<?php echo $stagiaire['photo'] ?>"
                                       width="50px" height="50px" class="img-circle">
                                   </td>
                                
                                  <td>
                                     <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer le stagiaire')"
                                         href="supprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
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
          <a href="stagiaires.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
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