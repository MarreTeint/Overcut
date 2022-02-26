<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <title>L'Overcut - Mon Compte</title>
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function sure(){
                if (window.confirm("Voulez vous vraiment supprimer votre compte (cette action est irréversible)")) {
                    window.location.replace("AuRevoir.php");
                }
            }
        </script>
    </head>
    <body id="compte" class="mb-0">
    
         <div class="my-0 h-100 w-100 divblanc">

        <?php include 'Projet.php' ?>
        <?php 
    		if(isset($_SESSION['on']) and $_SESSION['on']){
                ?>
               

                <h1>Bonjour <?php echo(htmlspecialchars($_SESSION["pseudo"]));?> </h1> <br/>
                <h4>Mes Forums :</h4> <br>
                 <?php 
                 include "bdd.php";
                $pseudo=$_SESSION['pseudo'];
                $preforum = 'SELECT * FROM forum WHERE auteur=:pseudo';                
                $forum = $bdd->prepare($preforum);
                $forum->execute(array(
                    'pseudo'=>$pseudo
                ));
                $forumfinal = $forum->fetchAll();
                $i=0;
                $rien =true;
                echo "<ul>";
               while(isset($forumfinal[$i])){
                    ?>
                    <li><h5><a href="afficheforum.php?id=<?php print_r($forumfinal[$i]['idfo']); ?>"><?php print_r(htmlspecialchars($forumfinal[$i]['nom']))?></a></h5></li>
                    <?php
                    $i=$i+1;
                    $rien = false;
                }
                echo "</ul>";
                if($rien){
                    echo "Vous n'avez pas encore créé de forum";
                }   
                ?>
                <br>
                <a href="deconnexion.php">Se deconnecter</a> - <a href="javascript:sure()">Suprimer mon compte</a>
                <?php
    		}
            else{
                header('Location: formconnexion.php');
            }

    	?>
        
        </div>
        
       
         
    </body>
    <?php include 'Footer.php' ?>
   
</html>
