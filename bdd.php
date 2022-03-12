<?php

		try{
            $bdd = new PDO('mysql:host=localhost;dbname=app3;charset=utf8', 'root', 'root');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }

?>