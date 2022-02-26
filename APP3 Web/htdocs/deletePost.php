<?php
include 'bdd.php';
$precom = 'UPDATE postforum SET message="Message supprimé par un administrateur" WHERE idpost =:id';
$com = $bdd->prepare($precom);
$com->execute(array(
    'id'=>$_GET['id']
));
header("Location: afficheforum.php?id=".$_GET['forum']);
?>