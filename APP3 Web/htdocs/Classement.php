<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style_basic.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>       
        <title>L'Overcut - Classement</title>
        <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
        
    </head>
    <body id="pos">
        <div class="mt-0 h-100 w-100 divblanc">
            <?php include 'Projet.php';
            $obj = file_get_contents('https://ergast.com/api/f1/current/driverStandings.json');
                    if(isset($_GET['Champ']) && isset($_GET['Year'])){
                        $link = 'https://ergast.com/api/f1/'.$_GET['Year'];
                        if($_GET['Champ']=="Pilotes"){
                            $link .= '/driverStandings.json';
                        }
                        else{
                            $link .= '/constructorStandings.json';
                        }
                        $obj = file_get_contents($link);
                    }
                    $parsedjson = json_decode($obj);?>
        <h1 class="text-center m-3 font-weight-bold">Classement des <?php if(isset($_GET['Champ']))
        {echo $_GET['Champ']." en ".$_GET['Year'];} 
        else{echo "Pilotes en ".$parsedjson->{'MRData'}->{'StandingsTable'}->{'season'};} 
    ?></h1>  
        <form class="col-10 col-xl-6 m-auto" action="Classement.php" method="GET">
            <select class="form-select" name="Champ" required>
                <option selected disabled value="">Championnat</option>
                <option>Pilotes</option>
                <option>Constructeurs</option> 
            </select>
            <select class="form-select" name="Year" required>
                <option selected disabled value="">Année</option>
                <?php
                $i=2021;
                while($i>=1950){
                    echo "<option>".$i."</option>";
                    $i=$i-1;
                }
                ?>
            </select> 
            <button class=" btn rouge bi bi-search" type="submit" class="m-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>    
        </form> 

        <table class="col-11 col-xl-6 mx-auto mb-0 table table-striped border">
            <thead class="rouge">
                <tr>
                    
                    <?php if(!isset($_GET['Champ']) || isset($_GET['Champ']) && $_GET['Champ']=="Pilotes") { ?>
                    <th class="col-1">Position</th>
                    <th>Ecurie</th>
                    <?php if(!isset($_GET['Year']) || isset($_GET['Year']) && $_GET['Year']>=2014) {echo "<th class='col-1'>N°</th>";} ?>
                    <th>Nom</th>
                    <th class="col-1">Points</th>
                <?php } else if(isset($_GET['Champ']) && $_GET['Champ']=="Constructeurs" && isset($_GET['Year']) && $_GET['Year']>=1958){ ?>
                    <th class="col-1">Position</th>
                    <th>Ecurie</th>
                    <th class="col-1">Points</th>
                <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php         
                    
                    if(isset($_GET['Champ']) && $_GET['Champ']=="Constructeurs" && isset($_GET['Year']) && $_GET['Year']>=1958){
                        $i=0;
                        while(isset($parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'ConstructorStandings'}[$i])){
                            echo "<tr><td>";
                            echo $i+1;
                            echo "</td><td>";
                            echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'ConstructorStandings'}[$i]->{'Constructor'}->{'name'};
                            echo "</td><td>";
                            echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'ConstructorStandings'}[$i]->{'points'};
                            $i=$i+1;
                        }
                    }
                    if(isset($_GET['Champ']) && $_GET['Champ']=="Constructeurs" && isset($_GET['Year']) && $_GET['Year']<1958){
                        echo "<h3 class='text-center m-3 font-weight-bold'>Il n'y a pas de championnat constructeur avant 1958</h3>";
                    }

                    else{
                    $i=0;
                    while(isset($parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i])){
                        echo "<tr><td>";
                        echo $i+1;
                        echo "</td><td>";
                        echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Constructors'}[0]->{'name'};
                        echo"</td><td>";
                        if(!isset($_GET['Year']) || isset($_GET['Year']) && $_GET['Year']>=2014){
                        echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'permanentNumber'};
                        echo"</td><td>";}
                        echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'givenName'}." ".$parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'Driver'}->{'familyName'};
                        echo"</td><td>";
                        echo $parsedjson->{'MRData'}->{'StandingsTable'}->{'StandingsLists'}[0]->{'DriverStandings'}[$i]->{'points'};
                        echo "</td></tr>";
                        $i=$i+1;
                    }
                    }
                    

                ?>
            </tbody>
        </table>
   <br>
          </div>
          <?php include 'Footer.php' ?>
    </body>
   
    </html>