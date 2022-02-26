<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <title>L'Overcut</title>
        
        
    </head>
    <body id="accueil">
        <div class="mt-0 h-100 w-100 divblanc">
            <?php include 'Projet.php' ?>
            <div class="text-center col-12 align-item-end"><h1 class="mt-5 font-weight-bold titre"> L'Overcut </h1><img class="mb-5" src="f1n.png"/></div>
            <table class="col-12">
                <tbody>
                    <tr class="row-6">
                        <td class="col-6 border border-top-0">
                            <h1 class="text-center m-5 font-weight-bold"> Classement des pilotes </h1>
                            <table class="col-12 mx-auto mb-0 table table-striped border">
                                <thead class="rouge">
                                <tr>
                                    <th class="col-1">Position</th>
                                    <th>Ecurie</th>
                                    <th class='col-1'>N°</th>
                                    <th>Nom</th>
                                    <th class="col-1">Points</th>
                </tr>
            </thead><tbody>
                <?php 
                    $obja = file_get_contents('https://ergast.com/api/f1/current/driverStandings.json');
                    $parsedjsona = json_decode($obja);
                    
                    $i=0;
                    while($i<10){
                        echo "<tr><td>";
                        echo $i+1;
                        echo "</td><td>";
                        echo $parsedjsona->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Constructors'}[0]->{'name'};
                        echo"</td><td>";
                        echo $parsedjsona->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'permanentNumber'};
                        echo"</td><td>";
                        echo $parsedjsona->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'givenName'}." ".$parsedjsona->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'familyName'};
                        echo"</td><td>";
                        echo $parsedjsona->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'points'};
                        echo "</td></tr>";
                        $i=$i+1;
                    }
                ?>
            </tbody></table>
            <a href="Classement.php"> Voir plus > </a>
                        </td>
                        <td class="col-6 border border-top-0">
                            <?php include 'Resultat.php'; ?>
                        </td>
                    </tr>
                    <tr class="row-6">
                        <td class="col-6 border">
                            <h1 class="text-center my-5 font-weight-bold"> Classement des constructeurs </h1>
                            <table class="col-12 mx-auto mb-0 table table-striped border">
                                <thead class="rouge">
                                    <th class="col-1">Position</th>
                                    <th>Ecurie</th>
                                    <th class="col-1">Points</th>
                                </thead><tbody>
                                   <?php 
                                        $objb = file_get_contents('https://ergast.com/api/f1/current/constructorStandings.json');   
                                        $parsedjsonb = json_decode($objb);

                                        $j=0;
                        while($j<8){
                            echo "<tr><td>";
                            echo $j+1;
                            echo "</td><td>";
                            echo $parsedjsonb->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'ConstructorStandings'}[$j]->{'Constructor'}->{'name'};
                            echo "</td><td>";
                            echo $parsedjsonb->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'ConstructorStandings'}[$j]->{'points'};
                            $j=$j+1;
                        }
                                    ?>
                                </tbody>
                            </table>
                            <a href="Classement.php?Champ=Constructeurs&Year=2021"> Voir plus > </a>
                        </td><td class='col-6 border'>
                        <?php 
                            if(isset($_SESSION['on']) and $_SESSION['on']){
                                echo "<h1 class='text-center my-5 font-weight-bold'> Mes Forums </h1>";

                 include 'bdd.php';
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
               while(isset($forumfinal[$i]) and $i<15){
                    ?>
                    <li><a href="afficheforum.php?id=<?php print_r($forumfinal[$i]['idfo']); ?>"><?php print_r(htmlspecialchars($forumfinal[$i]['nom']))?></a></li>
                    <?php
                    $i=$i+1;
                    $rien = false;
                }
                echo "</ul>";
                if($rien){
                    echo "Vous n'avez pas encore créé de forum";
                }   
                            }
                            else{
                                ?><a href="nouveau.php"><img src="ad.png" style="max-width: 50vw;max-height: 675px;" class="rounded mx-auto d-block" alt="Pub du site"></a><?php
                            }
                        ?>
                    </td></tr>
                </tbody>
            </table>
        </div>
             
    </body>
    <?php include 'Footer.php' ?>
</html>

