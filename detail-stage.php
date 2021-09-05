<?php 


session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{
$requser = $bdd->prepare("SELECT * FROM etudiant WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();


if (isset($_POST['Ajouter'])) 
{
		$intitule = htmlspecialchars($_POST['intitule']);
		$annee = htmlspecialchars($_POST['annee']);
		$ville = htmlspecialchars($_POST['ville']);
		$etablissement = htmlspecialchars($_POST['etablissement']);
		$niveau = htmlspecialchars($_POST['niveau']);
		$domaine = htmlspecialchars($_POST['domaine']);
		$diplome = htmlspecialchars($_POST['diplome']);

		$durree = htmlspecialchars($_POST['durree']);
		$fonction = htmlspecialchars($_POST['fonction']);
		$attendus = htmlspecialchars($_POST['attendus']);
		$activites = htmlspecialchars($_POST['activites']);
		$competences = htmlspecialchars($_POST['competences']);
		$handicap = htmlspecialchars($_POST['handicap']);
		$description = htmlspecialchars($_POST['description']);


		if (!empty($_POST['intitule']) AND !empty($_POST['ville']) AND !empty($_POST['etablissement']) AND !empty($_POST['niveau']) AND !empty($_POST['domaine']) AND !empty($_POST['durree']) AND !empty($_POST['fonction'])) {
			# code...
				$insertmbr = $bdd ->prepare("INSERT INTO stage_recherche (id_etudiant, intitule, annee, ville, etablissement, niveau, domaine, diplome, durree, fonction, attendus, activites, competences, handicap, description) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insertmbr -> execute(array( $_SESSION['id'], $intitule, $annee, $ville, $etablissement, $niveau, $domaine, $diplome, $durree, $fonction, $attendus, $activites, $competences, $handicap, $description));
					header("Location: gestion-stages.php?id=".$_SESSION['id']);


		 }

	else 
	{
		$erreur = "Tous les champs doivent etre completes !";
	}
	$e='';
    	if(($handicap=='O')||($handicap=='N')){
        $e='e';
    }
}





 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title></title>
<link rel="stylesheet" type="text/css" href="css/detail-stage.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="header">
		<div class="header-texture"></div>
		<div class="container">
			<div class="header-navbar">
				<div class="header-navbar-logo">
					<h1 class="header-navbar-logo-title">MonStage.</h1>
				</div>		
			</div>
		</div>	
	</div>
	<div id="table-de-bord">
		<div class="profile-texture"></div>
		<div class="container">
		<div class="avatar-picture">
			<div class="picture"><i class="fas fa-user"></i></div>
				<div class="indentifiant">
					<p><span> <?php echo $user['nom']; ?></span>  <span>  <?php echo $user['prenom'];  ?></span> </p>
				</div>
		</div>
	

	<section class="aside-menu">
		
			<ul>
				
				<li><a href="compte-stagiaire.php?id= <?php echo $_SESSION['id'] ?>"><span>Mon compte</span> <i class="fas fa-user"></i></a></li>
			
					<?php

			if (isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) 
			{
			?>	
				<li><a href="table-de-bord-stagiaire.php?id= <?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>
			<?php 

				}
			 ?>
				
				<li><a href="rechercher-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Recherche une entreprise</span><i class="fas fa-search"></i></a></li>
				<li><a href="gestion-stages.php?id= <?php echo $_SESSION['id'] ?>"><span>Gestion du stage</span><i class="fas fa-check"></i></a></li>
			
				<li><a href="deconnexion.php"><span>Deconnexion</span><i class="fas fa-sign-out-alt"></i></a></li>
			
			</ul>
		</div>
	</section>

<div class="container">
			<div class="progression">
				<h3>Votre Progression : 50%</h3>
				<div class="progression-bar">
				<div id ="level" style="width: 50%"></div>
				</div>
				<div class="un">
					<ol>
					<li><a href="#">Mon compte<i class="fas fa-check"></i></a></li>
					<li><a href="#">Vos demandes de stage</a></li>
				</ol>
				</div>
			</div>
</div>
<div class="container1">
		<div class="in-etudiant">
			
			<form id="form-etudiant" method="POST" action="" enctype="multipart/form-data">
				<div class="Indentite-etudiant">
					<h3>Indentification</h3>
					<label for="intitule">Intitule du stage <sup>*</sup> :</label>
                        <input type="text" id="intitule" name="intitule" value="" /> <br>

                        <label for="annee">Annee  :</label>
                        <select name="annee"value="">
                        	<option value="2019-2020" selected ="selected">2019/2020</option>
                        	<option value="2020-2021">2020/2021</option>
                        </select><br>
                      
                       
				</div>
			<div class="Mon-etablissement-scolaire">
				<h3>Mon etablissement scolaire </h3>
				<label for="ville">Ville <sup>*</sup> :</label>
                        <input type="text" name="ville">
                <label for="etablissement">Etablissement <sup>*</sup> :</label>
                       <input type="text" name="etablissement">
                       
			</div>
			<div class="Ma-formation-actuelle">
				<h3>Ma formation actuelle </h3>
			<label for="niveau">Niveau d'etude <sup>*</sup> :</label>
                        <select name="niveau"value="">
                        	<option value="bac+1" selected ="selected">Bac+1</option>
                        	<option value="Bac+2">Bac+2</option>
                        </select><br>
                        
            <label for="domaine">Domaine d'activite  :</label>
                        <select name="domaine"value="">
                        	<option value="Gestion" selected ="selected">Gestion</option>
                        	<option value="Comptabilite">Comptabilte</option>
                        	<option value="Commerce">Commerce</option>
                        </select><br>
            <label for="diplomme">Diplome  :</label>
                        <select name="diplome"value="">
                        	<option value="Licence-de-gesion" selected ="selected">Licence de gestion</option>
                        	<option value="Licence-de-commerce">Licence de commerce</option>
                        </select><br>

			</div>
			<div class="Stage-recherche">
				<h3>Stage recherche</h3>
				 <label for="durree">Durree <sup>*</sup> :</label>
                        <select name="durree"value="">
                        	<option value="mois" selected ="selected">1 mois</option>
                        	<option value="2-mois">2 mois</option>
                        	<option value="3-mois">3 mois</option>
                        </select><br>
				<label for="fonction">Fonction(s) / Domaine(s) d'activité <sup>*</sup> :</label>
                        <select name="fonction"value="">
                        	<option value="production" selected ="selected">production</option>
                        	<option value="controle-de-gesion">controle de gesion</option>
                        	<option value="marketing">marketing</option>
                        </select><br>

			</div>
			<div class="criteres">
				<h3>Criteres</h3>
			<label for="intitule">Attendus globaux en matière de stage :</label>
                        <textarea name="attendus"></textarea>
            <label for="intitule">Activités à réaliser :</label>
                        <textarea name="activites"></textarea>
            <label for="intitule">Compétence(s) à développer :</label>
                        <textarea name="competences"></textarea>     
			
			<div class="handicap">
				<h3>Handicap</h3>
				<label for="handicap">Facilités liées au handicap :</label>
                        <select name="handicap"value="">
                        	<option value="Oui" selected ="selected">Oui</option>
                        	<option value="Non">Nom</option>
                        </select><br>
                 <label for="facilites">Description des facilités demandées : </label>
                          <textarea name="description"></textarea> 
				
			</div>
				
				<button  name="Ajouter" class="rounded" type="submit">Valider</button>
			</div>

			</form>

</div>
</div>
 <footer>
		  	<div class="container2">
        <div class="flex container">
            <div class="footer-about">
                <h5>A propos de MonStage.</h5>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
            </div>

            <div class="footer-quick-links">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="index.html">Acceuil</a></li>
                    <li><a href="A propos.html">A propos</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#contact.php">Contact</a></li>
                </ul>
            </div>

            <div class="footer-subscribe">
                <h5>Subscribe to our Newsletter</h5>
                <div id="subscribe-container">
                    <input type="text" placeholder="Enter Email" />
                    <button class="right-rounded">Send</button>
                </div>

                <h5 class="follow-us">Follow Us</h5>
                <ul>
                    <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                </ul>
            </div>
        </div>
        </div>

        <small>
            Copyright &copy; 2020 All rights reserved 
        </small>
    </footer>
		

	<script src="https://kit.fontawesome.com/37ca535aa3.js" crossorigin="anonymous"></script>
</body>
</html>
<?php 

}
	else {
   header("Location: connexion.php");
}


 ?>