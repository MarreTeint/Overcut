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
        <script type="text/javascript">
            function comment(){
                document.getElementById("comment1").style.display = "none";
                document.getElementById("comment2").style.display = "block";
                document.getElementById("comment3").style.display = "block";
            }
        </script>
    </head>
    <body id="forum">
        <div class="mt-0 mb-0 h-100 w-100 divblanc">
            <?php include 'Projet.php' ?>
            <?php if(isset($_SESSION['on']) and $_SESSION['on']){ 
                //Connexion BDD
                include 'bdd.php';
                //résultats Com
                $precom = 'SELECT * FROM postforum WHERE idforum = '.$_GET['id'];
                $com = $bdd->prepare($precom);
                $com->execute();
                $comfinal = $com->fetchAll();
                //résultats Forum
                $preforum = 'SELECT nom FROM forum WHERE idfo = '.$_GET['id'];
                $forum = $bdd->prepare($preforum);
                $forum->execute();
                $forumfinal = $forum->fetchAll();
                
            ?>
            <br/>
            <div class="col-10 col-xl-7 m-auto">
            <h1 class="m-3 font-weight-bold"><?php print_r ($forumfinal[0]['nom']);?></h1>
            <table class="table table-striped mb-0" id="espace">
                <tbody>
                <?php
                    $i=0;
                    while(isset($comfinal[$i])){
                        $preaut = 'SELECT pseudo FROM comptes WHERE id = '.$comfinal[$i]['idcompte'];
                        $aut = $bdd->prepare($preaut);
                        $aut->execute();
                        $autfinal = $aut->fetchAll();
                        ?>
                        <tr class="border border-solid">
                            <td class="border col-4"><span <?php if($comfinal[$i]['idcompte']==0){ ?> class="font-italic" <?php } ?>><?php print_r(htmlspecialchars($autfinal[0]['pseudo']));echo "</span><br>"; print_r($comfinal[$i]['heure']) ;?></td>
                            <td><?php print_r(htmlspecialchars($comfinal[$i]['message']));?>
                            <?php if($_SESSION['role']==2){
                                echo '<br><a href="deletePost.php?id='.$comfinal[$i]['idpost'].'&forum='.$_GET['id'].'"><button class="btn rouge">Supprimer le message</button></a>';
                            }
                            ?>
                            </td>
                        </tr>
                        <?php
                        $i=$i+1;
                    }
                ?>
                </tbody>
            </table>
          <button id="comment1" class="btn btn-block rouge" onclick="comment()">Ecrire un Commentaire</button>
          <form class="mb-1" id="comment2" style="display: none;" action="ajoutcomment.php?id=<?php echo $_GET['id'];?>" method="post">
                <textarea name="comment" rows="5" class="col-12"></textarea>
                <button class="btn btn-block rouge" onclick="comment()">Ajouter un Commentaire</button>
          </form>
        <?php 
        }
        else{
            header('Location: formconnexion.php');
        }?>
        </div>
    </form></div></div></div>
    </body>
    <?php include 'Footer.php' ?>
</html>