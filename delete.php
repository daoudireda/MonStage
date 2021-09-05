<?php 

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id']))
 {
 	$id = $_GET['id'];
 	$requser = $bdd -> prepare('DELETE FROM etudiant WHERE id = ?');
 	$requser -> execute(array($id));
 	header('Location: connexion.php');
}
	
	
	


 ?>