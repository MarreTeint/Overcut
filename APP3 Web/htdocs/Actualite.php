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
        <title>L'Overcut - Actu</title>

    </head>
    <body id="actu">
        <div class="mt-0 h-100 w-100 text-center" style="background-color: rgba(255, 255, 255, 0.9); min-height: 1440px;">
            <?php include 'Projet.php' ?>
            <h1 class="text-center m-3 font-weight-bold">Actualités : </h1>
                <?php 
                    $obj = file_get_contents('https://newsapi.org/v2/everything?q=f1&domains=lequipe.fr&sortBy=publishedAt&apiKey=/*YOUR NEWS API KEY HERE*/');
                    $parsedjson = json_decode($obj);

                    $i=0;
                    $max=50;
                    $link = $parsedjson->{'articles'}[0]->{'url'};
                    echo "<div class='col-lg-6 col-10 m-auto text-align><br><a style='text-decoration: none;' target='_blank' href=".$parsedjson->{'articles'}[$i]->{'url'}."></a>"; //Lien pour annuler un bug : le 1er lien ne marche pas
                    while(isset($parsedjson->{'articles'}[$i]) && $i<=$max){ 

                        echo "<a style='text-decoration: none;' target='_blank' href=".$parsedjson->{'articles'}[$i]->{'url'}.">";
                        echo "<button class='btn btn-block rouge'><input type='image' class='img-fluid' style = 'max-width: 100%;' src='actu.jpg'/><br>";
                        echo "<h3>".$parsedjson->{'articles'}[$i]->{'title'}." - L'Equipe</h3>";
                        echo "</button></a><br>";
                        $i=$i+1;
                    }
                    echo "</div>";
                ?>
               <p class="m-0">Powered by <a href="https://newsapi.org/">NewsAPI</a></p>
        </div> 
    </body>
    <?php include 'Footer.php' ?>
</html>
