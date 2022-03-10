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
        <title>L'Overcut - Resultats</title>
        
    </head>
    <body id="result">
        <div class="mt-0 h-100 w-100 divblanc">
            <?php include 'Projet.php'; 
            $urla = 'https://ergast.com/api/f1/'.$_GET['Year'].'/'.$_GET['id'].'/results.json';
            $urlb = 'https://ergast.com/api/f1/'.$_GET['Year'].'/'.$_GET['id'].'/qualifying.json';
            $obja = file_get_contents($urla);
            $objb = file_get_contents($urlb);
            $parsedjsona = json_decode($obja);
            $parsedjsonb = json_decode($objb);


            $sprint=false;
            //affichage en sprint
            if($_GET['Year']==2021 && ($_GET['id']==10 or $_GET['id']==14 or $_GET['id']==19)){$sprint=true;$sprint = fopen("sprint_".$_GET['id'].".txt", "r");}
            
            //numéros
            $num=false;
            if($_GET['Year']>=2014){$num=true;}
            
            echo "<h1 class='text-center m-3 font-weight-bold'>".$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'raceName'}." ".$_GET['Year']."</h1><a class='m-3' href=Courses.php?Year=".$_GET['Year'].">< Retour </a><div class='m-2'>";
            
            //Qualif
            if(isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'round'})){
                echo "
                    <h2>Qualifications</h2>
                    <table class='table table-striped border'>
                        <thead class='rouge'>
                            <tr>
                                <th class='col-1'>Pos.</th>";
                                if($num){echo "<th>N°</th>";}
                                echo "<th>Pilote</th>
                                <th>Ecurie</th>
                                <th>Q1</th>";
                                $q2=false;
                                $q3=false;
                if(isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[0]->{'Q2'} )){
                    echo "<th>Q2</th>";
                    $q2=true;
                }
                if(isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[0]->{'Q3'} )){
                    echo "<th>Q3</th>";
                    $q3=true;
                }
                echo "</tr></thead><tbody>";
                $i=0;
                while (isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i])) {
                    $c=$i+1;
                    echo "<tr>
                            <td>".$c."</td>";
                            if($num){echo "<td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Driver'}->{'permanentNumber'}."</td>";}
                            echo "
                            <td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Driver'}->{'givenName'}." ".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Driver'}->{'familyName'}."</td>
                            <td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Constructor'}->{'name'}."</td>
                            <td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Q1'}."</td>";
                            if($q2){if(isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Q2'} )){
                                echo "<td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Q2'}."</td>";
                            }
                            else{
                                echo "<td>-:--.---</td>";
                            }
                            if($q3){if(isset($parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Q3'} )){
                                echo "<td>".$parsedjsonb->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'QualifyingResults'}[$i]->{'Q3'}."</td>";
                            }
                            else{
                                echo "<td>-:--.---</td>";
                            }
                        }}
                    $i=$i+1;
                }
            }
            echo "</tbody></table></th><th>";

            //Sprint (2021 pas implémenté à faire à la main)
            if($sprint){
                echo "
                    <h2>Course Sprint</h2>
                    <table class='table table-striped border'>
                        <thead class='rouge'>
                            <tr>
                                <th class='col-1'>Pos.</th>
                                <th>N°</th>
                                <th>Pilote</th>
                                <th>Ecurie</th>
                                <th>Temps</th>
                                <th>Points</th></tr></thead><tbody><tr><th>";
                $data="";
                while(!feof($sprint)){
                    $data.=fgets($sprint);
                }
                $data =  str_replace(';', "</td><td>", $data);
                $data = str_replace('_',"</td></tr><tr><td>",$data);
                $data = str_replace('|','</td></tr>',$data);
                echo $data;
            fclose($sprint);



                echo "</tbody></table>";
            }
            //Course
            echo "
                    <h2>Course</h2>
                    <table class='table table-striped border'>
                        <thead class='rouge'>
                            <tr>
                                <th class='col-1'>Pos.</th>";
                                if($num){echo "<th>N°</th>";}
                                echo "
                                <th>Pilote</th>
                                <th>Ecurie</th>
                                <th>Temps</th>
                                <th>Points</th></tr></thead><tbody>";
                    $j=0;
                    while(isset($parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j])){
                        $d=$j+1;
                        echo "<td>".$d."</td>";
                            if($num){echo "<td>".$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Driver'}->{'permanentNumber'}."</td>";}
                            echo "
                            <td>".$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Driver'}->{'givenName'}." ".$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Driver'}->{'familyName'}." ";
                                //FL
                            if(isset($parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'FastestLap'}) && $parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'FastestLap'}->{'rank'}==1){echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
  <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
  <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
</svg>';}
                            echo "</td><td>".$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Constructor'}->{'name'}."</td><td>";
                            if($parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'status'}=="Finished"){
                                echo $parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Time'}->{'time'};
                            }
                            else if(substr($parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'status'},0,1)=="+"){
                                echo str_replace("Lap","Tour(s)",$parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'status'});
                            }
                            else{
                                echo "Abandon";
                            }
                            echo "</td><td>+";
                            echo $parsedjsona->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'points'};
                            echo " point(s)</td></tr>";
                            $j=$j+1;
                    }
            echo "</div></tbody></table>";
            
            
            
            echo '<br><div class="text-center"><h4>Comment lire les temps ?</h4>
            Le format du temps est représenté de la manière suivante : Heure : Minutes : Secondes . Milisecondes<br>Le nombre le plus à droite représente TOUJOURS les milisecondes<br>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
  <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
  <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
</svg> Représente le temps le plus rapide en course et rapporte 1 point en plus
        </div>';
        ?>
            </div>
        
    </body>
    <?php include 'Footer.php' ?>
    </html>