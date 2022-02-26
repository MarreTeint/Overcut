<?php session_start();
        include "bdd.php";
		
$req = $bdd->prepare('SELECT id,mdp,role,pseudo FROM comptes WHERE pseudo = :pseudor');
$req->execute(array(
    'pseudor' => $_POST['pseudo']));
$resultat = $req->fetch();

$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

if (!$resultat)
{
    $_SESSION['errpsd']=true;
}
else
{
    if(isset($_SESSION['errpsd']) and $_SESSION['errpsd']){$_SESSION['errpsd']=false;}
    if ($isPasswordCorrect) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $resultat['pseudo'];
        $_SESSION['role'] = $resultat['role'];
        $_SESSION['on']=true;
        if(isset($_SESSION['errmdp']) and $_SESSION['errmdp']){$_SESSION['errmdp']=false;}
        header('Location: Compte.php');
    }
    else {
        $_SESSION['errmdp']=true;
    }
}
    if($_SESSION['errpsd']==true or $_SESSION['errmdp']==true){
        header('Location: formconnexion.php');
    }
?>
