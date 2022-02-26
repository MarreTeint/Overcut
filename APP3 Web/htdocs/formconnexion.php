<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/class" href="Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <link rel="stylesheet" href="Style_connexion.css">
        <title>L'Overcut - Connexion</title>
        <?php include 'Projet.php' ?>
    </head>
    <body id="connexion">
        <?php if(isset($_SESSION['on']) and $_SESSION['on']){header('Location: Compte.php');}?>
        <div class="container w-auto border col-6" id="form">
            <h2 class="text-center col-12">Connexion</h2><br/>
                <?php if(isset($_SESSION['errmdp']) and $_SESSION['errmdp']){?><p class="Erreur text-center row-6">Mauvais mot de passe</p><?php } ?>
                <?php if(isset($_SESSION['errpsd']) and $_SESSION['errpsd']){?><p class="Erreur text-center row-6">Pseudo non reconnu</p><?php } ?>
            <form class="text-center col-12" action="connexion.php" method="post">
                <label class="col-4">Pseudo : </label><input class="col-8"type="text" name="pseudo" required><br/>
                <label class="col-4">Mot de passe : </label><input class="col-8" type="password" name="mdp" required><br/>
                <button class="btn btn-dark btn-block"type="submit" name="Valider">Valider</button>
            </form> 
            <br/><h5 class="text-center"><a href="nouveau.php">Creer un compte</a></h5>
        </div>
    </body>