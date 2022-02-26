<?php 
	session_start();
	include "bdd.php";
	$req = $bdd->prepare('SELECT * FROM forum WHERE nom = :name');
		$req->execute(array(
    	'name' => $_POST['name']));
		$resultat = $req->fetch();
		
		if(!$resultat){
			if(isset($_SESSION['errfor']) and $_SESSION['errfor']){$_SESSION['errfor']=false;}
			
			
			$name = $_POST['name'];
			$req = $bdd->prepare('INSERT INTO forum(nom,auteur) VALUES(:name, :auth)');
			$req -> execute(array(
				'name'=>$name,
				'auth'=> $_SESSION['pseudo']
			));
			
			header('Location: forum.php');

			
		}
		else{
			$_SESSION['errfor']=true;
			header('Location: ajoutforum.php');
		}

	?>