<?php

		try{
            $bdd = new PDO('mysql:host=sql312.epizy.com;dbname=epiz_30843661_app3;charset=utf8', 'epiz_30843661', 'zMJCjOR2LnGT');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }

?>