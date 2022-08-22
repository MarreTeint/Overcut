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
                
        <title>L'Overcut - Courses</title>
    </head>
    <body id="result">
        <div class="mt-0 h-100 w-100 divblanc">
            <?php include 'Projet.php' ?>  
            <?php echo "<h1 class='text-center m-3 font-weight-bold'>";
                    if(isset($_GET['Year'])){echo "Toutes les courses en ".$_GET['Year'];}
                    else{echo "Toutes les courses en 2022";}
                    echo "</h1>";
            ?>
            <form class="col-10 col-xl-6 m-2" action="Courses.php" method="GET">
            <select class="form-select" name="Year" required>
                <option selected disabled value="">Année</option>
                <?php
                $i=2022;
                while($i>1950){
                    echo "<option>".$i."</option>";
                    $i=$i-1;
                }
                ?>
            </select> 
            <button class=" btn rouge bi bi-search" type="submit" class="m-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>    
        </form> 
        <div class='col-9'>
        <?php 
                    
                    $obj = file_get_contents('https://ergast.com/api/f1/current.json');
                    if(isset($_GET['Year'])){
                        $link = 'https://ergast.com/api/f1/'.$_GET['Year'].'.json';
                        $obj = file_get_contents($link);
                    }
                    $parsedjson = json_decode($obj);


                    $i=0;
                    while(isset($parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i])){
                        echo "<a style='text-decoration: none;' href='fullresult.php?id=".$parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i]->{'round'}."&Year=".$_GET['Year']."'><button class='btn btn-block rouge text-right'><h2>";
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i]->{'raceName'};
                        echo ' | ';
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i]->{'Circuit'}->{'circuitName'};
                        echo ' <br> ';
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i]->{'Circuit'}->{'Location'}->{'country'};
                        echo ' - ';
                        echo $parsedjson->{'MRData'}->{'RaceTable'}->{'Races'}[$i]->{'Circuit'}->{'Location'}->{'locality'};
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671z"/>
</svg>';
                        echo "</h2></button></a><br>";
                        $i=$i+1;
                    }
                    ?>
        </div></div>
    </body>
    <?php include 'Footer.php' ?>
</html>
