<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/class" href="Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <title>L'Overcut - Inscription</title>
        <?php include 'Projet.php' ?>
    </head>
    <body id="connexion">
        <?php if(isset($_SESSION['on']) and $_SESSION['on']){header('Location: Compte.php');}?>
    	<div class="container w-auto border col-6" id="form">
        <h2 class="text-center col-12">Creer un nouveau compte</h2><br/>
        <?php if(isset($_SESSION['errenr']) and $_SESSION['errenr']){?><p class="Erreur text-center row-6">Ce pseudo est deja utilise</p><?php } ?>
        <form action="enregistrement.php" method="post" class="text-center col-12">
    		<label class="col-4">Pseudo :</label><input class="col-8" type="text" name="pseudo" required><br/>
    		<label class="col-4">Mot de passe</label><input class="col-8" type="password" name="mdp" required><br>
    		<button class="btn btn-dark btn-block"type="submit" name="Valider">Valider</button>
    	</form> 
         <br/><h5 class="text-center"><a href="formconnexion.php">Se Connecter</a></h5>
        </div>
    </body>
