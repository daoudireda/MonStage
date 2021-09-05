<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{

$requser = $bdd->prepare("SELECT * FROM administration_encadrant WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="css/detail-professeur.css">
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
					<p><span> <?php echo $user['nom']; ?></span>  <span>  <?php echo $user['prenom'];  ?></span> <br> <a href="etablissement.php?id= <?php echo $_SESSION['id'] ?>" title=""><span><?php echo $user['type']; ?></span> <span><?php echo $user['nometablissement']; ?></span></p> </a>
				</div>
		</div>
	<section class="aside-menu">
		
			<ul>
		
				<li><a href="fiche-d'etablissement.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'etablissement</span><i class="fas fa-file-alt"></i></a></li>
			

				<li><a href="tableau-de-bord-professeur.php?id=<?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>


				<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>"><span>Etudiants</span><i class="fas fa-user-graduate"></i></a></li>


				<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>"><span>Professeures</span><i class="fas fa-chalkboard-teacher"></i></a></li>
			




				<li><a href="#"><span>Mon compte</span><i class="fas fa-user"></i></a></li>
	

				
		
				<li><a href="stage-section.php?id=<?php echo $_SESSION['id'] ?>"><span>Gerer les stages</span><i class="fas fa-check"></i></a></li>




				<li><a href="deconnexion.php"><span>Deconnexion</span><i class="fas fa-sign-out-alt"></i></a></li>
			


				
			</ul>
		</div>
	</section>
	<div class="container1">
		<div class="in-etablissement">
			<form id="form-etablissement" method="POST" action="" enctype="multipart/form-data">

			<div class="Administrateur du compte établissement">
				<h3>Identite </h3>
				<label for="type">Civilite :</label>
                        <select name="civilite" value="<?php echo $user['civilite']; ?>">
                        	<option selected ="selected">M.</option>
                        	<option>Mme.</option>
                        </select><br>
                        <label for="Prenom">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>"/> <br>

                        <label for="Nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"/><br>
                        <label for="">Telephone mobile :</label>
                        <input type="text" name="mobile">
                        <label>Telephone fixe :</label>
                        <input type="text" name="fixe" value="">
			</div>
			<div class="identification">
				<h3>indentification de connexion</h3>
				<label for="email"> Email :</label>
				<input type="email" id="email" name="identifiant" value="<?php echo $user['identifiant']; ?>"> <br>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="motdepasse" ><br>
				
			</div>
			<div class="condition">
			
			<button class="rounded" type="submit" name="forminscription">Valider</button>
			</div>
			</form>
			
		</div>
	</div>
	<?php if(isset($erreur)) { echo $erreur; } ?>
	 <?php if(isset($msg)) { echo $msg; } ?>

		<footer>
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
                    <li><a href="#contact.html">Contact</a></li>
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

        <small>
            Copyright &copy; 2020 All rights reserved 
        </small>
    </footer>

	<script src="https://kit.fontawesome.com/37ca535aa3.js" crossorigin="anonymous"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>
<?php

}

?>