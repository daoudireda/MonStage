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
	<link rel="stylesheet" type="text/css" href="css/fiche-d'etablissement.css">
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
			

				<li><a href="tableau-de-bord-professeur?id=<?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>


				<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>"><span>Etudiants</span><i class="fas fa-user-graduate"></i></a></li>


				<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>"><span>Professeurs</span><i class="fas fa-chalkboard-teacher"></i></a></li>
			




				<li><a href="compte-professeur.php?id=<?php echo $_SESSION['id'] ?>"><span>Mon compte</span><i class="fas fa-user"></i></a></li>
	

				
		
				<li><a href="stage-section.php?id=<?php echo $_SESSION['id'] ?>"><span>Gerer les stages</span><i class="fas fa-check"></i></a></li>




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
					<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>">Inscrire des professeurs <i class="fas fa-check"></i> </a></li>
					<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>" title="">Inscrire des élèves/étudiants</a></li>
				</ol>
				</div>
			</div>


	</div>
	<div class="container1">
		<div class="in-etablissement">
			<form id="form-etablissement" method="POST" action="" enctype="multipart/form-data">
				<div class="Indentite-etablissement">
					<h3>Identification de l'établissement de formation</h3>
					<label for="Nom">nom d'etablissement :</label>
                        <input type="text" id="nom" name="nometablissement" value="<?php if(isset($nometablissement)){echo $nometablissement;} ?>"/> <br>

                        <label for="code">Code d'eablissement(RNE) :</label>
                        <input type="text" id="code" name="RNE" value="<?php if(isset($RNE)){echo $RNE;} ?>" /><br>
						<label for="Logo">Logo:</label>
                    
                        	<input type="file" name="photo" > <br>


                        <label for="type">type d'etablissement :</label>
                        <select name="type">
                        	<option value="FES"  selected ="selected" value="<?php if(isset($type)){echo $type;} ?>" >Facultes ou  etablissemnent superieur</option>
                        	<option value="IUT">IUT</option>
                        </select><br>
                        <label for="presentation">Presentation :</label>
                        <textarea name="presentation" value="<?php if(isset($presentation)){echo $presentation;} ?>"></textarea>
                         
				</div>
			<div class="Emplacement">
				<h3>Emplacement</h3>
				<label for="adresse">Adresse :</label>
				<input type="text" id="adresse" name="adresse" value="<?php if(isset($adresse)){echo $adresse;} ?>"><br>
				<label for="adresse(suite)">Adresse(suite) :</label>
				<input type="text" id="adresse(suite)" name="adressesuite" value="<?php if(isset($adressesuite)){echo $adressesuite;} ?>"><br>

				<label for="code-postal">Code postale :</label>
				<input type="text" id="code-postal" name="codepostale" value="<?php if(isset($codepostale)){echo $codepostale;} ?>"><br>
				<label for="ville">Ville :</label>
				<input type="text" id="ville" name="ville" value="<?php if(isset($ville)){echo $ville;} ?>"><br>
			
			</div>
			<div class="Coordonnees">
				<h3>Coordonnees</h3>
				<label for="tel">telephone :</label>
				<input type="text" id="tel" name="telephone" value="<?php if(isset($telephone)){echo $telephone;} ?>"> <br>
				<label for="fax">fax :</label>
				<input type="text" id="fax" name="fax" value="<?php if(isset($fax)){echo $fax;} ?>">
				<label for="email">email :</label>
				<input type="email" id="email" name="email" value="<?php if(isset($email)){echo $email;} ?>">

			</div>
			<div class="Administrateur du compte établissement">
				<h3>Administrateur du compte établissement</h3>
				<label for="type">Civilites:</label>
                        <select name="civilite" value="<?php if(isset($civilite)){echo $civilite;} ?>">
                        	<option selected ="selected">M.</option>
                        	<option>Mme.</option>
                        </select><br>
                        <label for="Prenom">Prenom :</label>
                        <input type="text" id="prenom" name="prenom" value="<?php if(isset($prenom)){echo $prenom;} ?>"/> <br>

                        <label for="Nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value="<?php if(isset($nom)){echo $nom;} ?>"/><br>
			</div>
			<div class="identification">
				<h3>indentification de connexion</h3>
				<label for="email"> Email :</label>
				<input type="email" id="email" name="identifiant" value="<?php if(isset($identifiant)){echo $identifiant;} ?>"> <br>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="motdepasse" ><br>
				<label for="password"> Confirmation du mot de passe :</label>
				<input type="password" id="password" name="motdepasse2">
			</div>
			<div class="condition">
			
			<button class="rounded" type="submit" name="forminscription">Valider</button>
			</div>
			</form>
			
		</div>
	</div>
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
	else {
   header("Location: connexion.php");
}

?>