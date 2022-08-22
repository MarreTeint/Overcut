<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <title>L'Overcut - Resultats</title>
        
    </head>
    <body>
            <div class="col-12 m-2">
                <h1 class="text-center m-3 font-weight-bold">Derniers résultats</h1>
            <?php 
                    $i=22;
                    $nb=0;
                    while($nb<3){
                    $url='https://ergast.com/api/f1/2022/'.$i.'/results.json';
                    
                    $obj = file_get_contents($url);
                    $parsedjson = json_decode($obj);

                    if(isset($parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'raceName'})){
                        $nb=$nb+1;
                        echo "<a class='m-1' style='text-decoration: none;' href='fullresult.php?id=".$i."&Year=2022'><button class='btn btn-block rouge'><h4>Podium : 1-";
                        echo strtoupper($parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[0]->{'Driver'}->{'familyName'});
                        echo " 2-";
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[1]->{'Driver'}->{'code'};
                        echo " 3-";
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[2]->{'Driver'}->{'code'};
                        
                        
                        for($j=0;$j<20;$j++){
                            if( isset($parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'FastestLap'}->{'rank'}) && $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'FastestLap'}->{'rank'}==1){
                                echo " <br> Tour le plus rapide : ".$parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'Results'}[$j]->{'Driver'}->{'code'};
                            }
                        }
                        echo "</h4><br><h2>";
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[0]->{'raceName'};
                        echo "</h2></button></a>";
                    }
                    $i=$i-1;
                }
                ?>
        </div>
    </body>
</html>
