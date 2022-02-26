<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/class" href="Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <title>L'Overcut - Forum</title>
       
        
    </head>
    <script type="text/javascript">updateUrl()</script>
    <body id="forum">
        <div class="mt-0 h-100 w-100 divblanc">
            <?php include 'Projet.php' ?>
        <?php if(isset($_SESSION['on']) and $_SESSION['on']){ ?>
            <h1 class="text-center m-3 font-weight-bold">Forum</h1> 
            <div class="input-group">

            <?php
                include 'bdd.php';
                $preforum = 'SELECT * FROM forum ORDER BY idfo desc';
                if(isset($_GET['search']) and !empty($_GET['search'])){
                    $search = htmlspecialchars($_GET['search']);
                    $preforum=$preforum = 'SELECT * FROM forum WHERE nom LIKE "%'.$search.'%" ORDER BY idfo desc';
                }
                $forum = $bdd->prepare($preforum);
                $forum->execute();
                $forumfinal = $forum->fetchAll();
        
            ?>
            <div class="col-12 m-auto"><form id="Recherche" method="get" action="forum.php" class="col-10 col-xl-4 m-auto">
                <div class="input-group col-12">
        <div class="input-group-prepend col-10 m-0">
                <input type="text" name="search" placeholder="Recherche" class="col-12 m-0"></div>
                <button class="col-2 btn rouge btn-block bi bi-search" type="submit" class="m-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>
            </form><br/></div>
            <div class="col-10 col-xl-7 m-auto">
            <table class="table table-striped border">
                <thead class="rouge">
                    <tr>
                        <th scope="col" class="col-8">Titre</th>
                        <th scope="col" class="col-4">Auteur</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    while(isset($forumfinal[$i])){
                        ?>
                        <tr>
                            <td><a href="afficheforum.php?id=<?php print_r($forumfinal[$i]['idfo']);?>"><?php print_r(htmlspecialchars($forumfinal[$i]['nom'])) ;?></a></td>
                            <td><?php print_r(htmlspecialchars($forumfinal[$i]['auteur']));?></td>
                        </tr>
                        <?php
                        $i=$i+1;
                    }
                ?>
                </tbody>
            </table>
            <form action="ajoutforum.php"><button class="btn rouge btn-block">Ajouter un nouveau forum</button></form>
          
        <?php 
        }
        else{
            header('Location: formconnexion.php');
        }?>
        </div><br>
    </form></div></div></div>
    </body>
    <?php include 'Footer.php' ?>
</html>