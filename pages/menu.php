<?php 
    require_once('identifier.php');
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
       <div class="navbar-header">
          <a href="../index.php" class="navbar-brand">
           Gestion des stagiaires </a>
       </div>
       
        <ul class="nav navbar-nav">
            <li><a href="filieres.php">Les filières</a></li>
            <li><a href="stagiaires.php">Les stagiaires</a></li>
            <li><a href="projets.php">Les Projets</a></li>
            <li><a href="encadrants.php">Les encadrants</a></li>
            <li><a href="structures.php">Les structures</a></li>
            <li><a href="utilisateurs.php">Les utilisateurs</a></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li ><a href="logout.php"><span class="glyphicon glyphicon-log-in">Deconnexion</span></a></li>
         </ul>
      </div>
</nav>