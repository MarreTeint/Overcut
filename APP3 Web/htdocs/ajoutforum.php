<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/class" href="Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <title>L'Overcut - Ajouter un forum</title>
        <?php include 'Projet.php' ?>
    </head>
    <body id="creaforum">

        <div class="container w-auto border col-6" id="form">
            <h1 class="text-center col-12">Ajouter un nouveau forum</h1><br/>
            <?php if (isset($_SESSION['errfor']) and $_SESSION['errfor']){echo '<span class="Erreur text-center row-6">Ce forum existe déjà</span>';}?>
            <form class="text-center col-12" action="bddajoutforum.php" method="post">
                <label class="col-4">Titre : </label><input class="col-8" type="text" name="name">
                <button class="btn btn-dark btn-block" type="submit" name="Valider">Valider</button>
            </form>
        </div>
    </body>