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
     $nomE = isset($_GET['nomE'])?$_GET['nomE']:"";
     $grade = isset($_GET['grade'])?$_GET['grade']:"all";

     $size = isset($_GET['size'])?$_GET['size']:6; 
     $page = isset($_GET['page'])?$_GET['page']:1;
     $offset = ($page - 1) * $size;

     if($grade == "all"){
          $requete = "select * from encadrant
                    where nomEncadrant like '%$nomE%'
                    limit $size
                    offset $offset";
          $requeteCount = "select count(*) countE from encadrant
                    where nomEncadrant like '%$nomE%'";
     }else{
          $requete = "select * from encadrant
                  where nomEncadrant like '%$nomE%'
                  and grade = '$grade'
                  limit $size
                  offset $offset";

          $requeteCount = "select count(*) countE from encadrant
                  where nomEncadrant like '%$nomE%'
                  and grade = '$grade'";
     }

     $resultatEncad = $pdo->query($requete);

     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbreEncadrant = $tabCount['countE']; //decompter le nbre de filiere

     $reste = $nbreEncadrant % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreEncadrant/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreEncadrant/$size) + 1; // permet de prendre que la partie entire de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des encadrants</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
     <?php include("menu.php");?>

        <div class="container">
            <div class="panel panel-success margetop60">
                    <div class="panel-heading">Recherche des encadrants...</div>
                    <div class="panel-body">
                         <form method="get" action="encadrants.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="nomE" 
                                 placeholder="Nom de l'encadrant" class="form-control"
                                 value="<?php echo $nomE ?>"/>
                            </div>
                            <label for="grade">Grade : </label>
                            <select name="grade" class="form-control" id="grade"
                                 onchange="this.form.submit()">
                               <option value="all" <?php if($grade === "all") echo "selected" ?>>Tous les niveaux</option>
                               <option value="professeur"   <?php if($grade === "professeur")   echo "selected" ?>>Professeur</option>
                               <option value="docteur"   <?php if($grade === "docteur")   echo "selected" ?>>Docteur</option>
                               <option value="consultant"   <?php if($grade === "consultant")   echo "selected" ?>>Consultant</option>
                               <option value="ingenieur"   <?php if($grade === "ingenieur")   echo "selected" ?>>Ingénieur</option>
                            </select>
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouveauEncadrant.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouveau encadrant</a>
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des encadrants(<?php echo $nbreEncadrant ?>)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID Encadrant</th><th>Civilité</th><th>Nom Encadrant</th><th>Prénom</th><th>Grade</th><th>Email</th><th>Photo</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php while($encadrant = $resultatEncad->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $encadrant['idEncadrant'] ?></td>
                                  <td><?php echo $encadrant['civilite'] ?></td>
                                  <td><?php echo $encadrant['nomEncadrant'] ?></td>
                                  <td><?php echo $encadrant['prenom'] ?></td>
                                  <td><?php echo $encadrant['grade'] ?></td>
                                  <td><?php echo $encadrant['email'] ?></td>
                                  <td>
                                     <img src="../images/encadrant/<?php echo $encadrant['photo'] ?>"
                                       width="50px" height="50px" class="img-circle">
                                   </td>
                                  
                                  <td>
                                     <a href="editerEncadrant.php?idEncad=<?php echo $encadrant['idEncadrant'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer la filière')"
                                         href="supprimerEncadrant.php?idEncad=<?php echo $encadrant['idEncadrant'] ?>">
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
          <a href="encadrants.php?page=<?php echo $i;?>&nomE=<?php echo $nomE ?>&grade=<?php echo $grade ?>">
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