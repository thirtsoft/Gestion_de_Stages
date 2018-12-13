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
    $login = isset($_GET['login'])?$_GET['login']:"";
    

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteUtilisateur = "select * from utilisateur where login like '%$login%'";
    $requeteCount = "select count(*) countUser from utilisateur";

    $resultatUtilisateur = $pdo->query($requeteUtilisateur);
    $resultatCount = $pdo->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbreUtilisateur = $tabCount['countUser']; //decompter le nbre de filiere

    $reste = $nbreUtilisateur % $size;     
    if(($reste) === 0)
          $nbrePage = floor($nbreUtilisateur/$size);
    else
          $nbrePage = floor($nbreUtilisateur/$size) + 1;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
     <?php include("menu.php");?>

        <div class="container">
            <div class="panel panel-success margetop60">
                    <div class="panel-heading">Recherche des utilisateurs...</div>
                    <div class="panel-body">
                         <form method="get" action="utilisateurs.php" class="form-inline">
                             <div class="form-group">
                                 <input type="text" name="login" 
                                 placeholder="Login" class="form-control"
                                 value="<?php echo $login ?>"/>
                            </div>
            
                            <button type="submit"  class="btn btn-success"> 
                               <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... </button>
                               &nbsp; &nbsp; 

                               <a href="nouveauUtilisateur.php"><span class="glyphicon glyphicon-plus "></span> 
                               Nouveau utilisateur</a>
                              
                         </form>
                    </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">Liste des utilisateurs(<?php echo $nbreUtilisateur ?> utilisateurs)</div>
                <div class="panel-body">
                     <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>Login</th><th>Email</th><th>Role</th><th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                             <?php while($utilisateur = $resultatUtilisateur->fetch()){ ?> 
                                <tr class="<?php echo $utilisateur['etat']==1?'success':'danger'?>">
                                  <td><?php echo $utilisateur['login'] ?></td>
                                  <td><?php echo $utilisateur['email'] ?></td>
                                  <td><?php echo $utilisateur['role'] ?></td>
                                  
                                  <td>
                                     <a href="editerUtilisateur.php?idUtilisateur=<?php echo $utilisateur['idUtilisateur'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                     </a>
                                     &nbsp;&nbsp;
                                     <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')"
                                         href="supprimerUtilisateur.php?idUtilisateur=<?php echo $utilisateur['idUtilisateur'] ?>">
                                         <span class="glyphicon glyphicon-trash "></span>
                                    </a> 
                                    &nbsp;&nbsp;
            <a href="activerUtilisateur.php?idUtilisateur=<?php echo $utilisateur['idUtilisateur']?>&etat=<?php echo $utilisateur['etat']?>">
                                      <?php 
                                            if($utilisateur['etat']==1)
                                                echo '<span class="glyphicon glyphicon-remove"></span>';
                                            else
                                                echo '<span class="glyphicon glyphicon-ok"></span>';
                                      ?> 
                                    </a> 
                                  </td>
                                </tr>
                             <?php }?>   
                         
                        </tbody>

                     </table>

                     <div>
                        <ul class="pagination">
                              <?php for($i=1; $i<=$nbrePage; $i++){ ?>
                                   <li class="<?php if($i==$page) echo 'active'?>">
          <a href="utilisateurs.php?page=<?php echo $i;?>&login=<?php echo $login ?>">
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