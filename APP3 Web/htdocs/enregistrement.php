<?php session_start();
		include "bdd.php";
		$req = $bdd->prepare('SELECT * FROM comptes WHERE pseudo = :pseudo');
		$req->execute(array(
    	'pseudo' => $_POST['pseudo']));
		$resultat = $req->fetch();
		
		if(!$resultat){
			if(isset($_SESSION['errenr']) and $_SESSION['errenr']){$_SESSION['errenr']=false;}
			$mdp = $_POST['mdp'];
			$pseudo= $_POST['pseudo'];
			$mdpp = password_hash($mdp, PASSWORD_DEFAULT);
			$req = $bdd->prepare('INSERT INTO comptes(pseudo,mdp,role) VALUES(:pseudo,:mdp,:role)');
			$req -> execute(array(
				'pseudo'=>$pseudo,
				'mdp'=>$mdpp,
				'role'=>1
			));
		header('Location: formconnexion.php');
		}
		else{
			$_SESSION['errenr']=true;
			header('Location: nouveau.php');
		}

	?>
	