<?php 
	session_start();

    include "bdd.php";
    
    $name = $_POST['name'];
	$req = $bdd->prepare('INSERT INTO postforum(idcompte,idforum,message) VALUES(:idpseudo, :idforum, :message)');
	$req -> execute(array(
		'idpseudo'=>$_SESSION['id'],
		'idforum'=>$_GET['id'],
		'message'=>$_POST['comment']
	));
	header("Location: afficheforum.php?id=".$_GET['id']) ?>