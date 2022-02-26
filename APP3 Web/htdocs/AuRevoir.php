<?php session_start();
include "bdd.php";
//Change id comment
$precom = 'UPDATE postforum SET idcompte = 0 WHERE idcompte =:id';
$com = $bdd->prepare($precom);
$com->execute(array(
    'id'=>$_SESSION['id']
));
//Change Forum creator
$pseudo=$_SESSION['pseudo'];
$preauth = 'UPDATE forum SET auteur="Pseudo Supprimé" WHERE auteur ="'.$pseudo.'"';
$auth = $bdd->prepare($preauth);
$auth->execute();
//Suppr Compte
$preforum = 'DELETE FROM comptes WHERE pseudo=:pseudo';                
                $forum = $bdd->prepare($preforum);
                $forum->execute(array(
                    'pseudo'=>''.$_SESSION['pseudo'].''
                ));
header("Location: deconnexion.php");
?>