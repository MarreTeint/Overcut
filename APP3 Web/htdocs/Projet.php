<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <title>Projet</title>
    </head>
    
    <body>
        <header class="container-12 mb-0" id="menu">
            <nav class="row-12 navbar navbar-light align-item-center m-0">
                <a href="index.php"><img class="m-0" src="logo.png" alt="logo" id="logo" style="height: 55px; width: 55px;"/></a>
                <a href="Courses.php?Year=2021">Courses</a>
                <a href="Classement.php">Classement</a> 
                <a href="Actualite.php">Actus</a>
                <a href="forum.php">Forum</a> 
                <?php if(isset($_SESSION['on']) and $_SESSION['on']){ 
                        echo '<a href="Compte.php">Mon Compte</a>';
                    } 
                    else{
                        echo '<a href=formconnexion.php> Se Connecter</a>';
                    } ?> 
                </a>
            </nav>
        </header>
    </body>
</html>