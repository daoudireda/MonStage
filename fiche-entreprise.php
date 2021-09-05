<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{
$requser = $bdd->prepare("SELECT * FROM entreprise WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/fiche-entreprise.css">
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
					<p><span> <?php echo $user['nom']; ?></span>  <span>  <?php echo $user['prenom'];  ?></span> <br> <a href="table-de-bord-entreprise.php?id= <?php echo $_SESSION['id'] ?>" title=""><span><?php echo $user['formelegale']; ?></span> <span><?php echo $user['nomentreprise']; ?></span></p> </a>
				</div>
		</div>
		<section class="aside-menu">
		
			<ul>
			
				<li><a href="fiche-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'entreprise</span><i class="fas fa-file-alt"></i></a></li>
			

				 
				
				<li><a href="table-de-bord-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"> </i></a></li>

			
				<li><a href="profil-de-stagiaire-acceptee.php?id= <?php echo $_SESSION['id'] ?>"><span>Definir un  stagiaire</span> <i class="fas fa-check"></i></a></li>
			

				<li><a href="offres-de-stage-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Rediger un offre</span> <i class="fas fa-bullhorn"></i></a></li>
	
			
				<li><a href="gestion-stages.php?id= <?php echo $_SESSION['id'] ?>"><span>Suivre mes stagiaires</span> <i class="fas fa-comments"></i></a></li>

				<li><a href="deconnexion.php"><span>Deconnexion</span> <i class="fas fa-sign-out-alt"></i></a></li>
			


				
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
					<li><a href="#">Définir les utilisateurs de la plate-forme <i class="fas fa-check"></i></a></li>
					<li><a href="profil-de-stagiaire-acceptee.php?id= <?php echo $_SESSION['id'] ?>">Définir un profil </a></li>
				</ol>
				</div>
			</div>
</div>
<div class="container1">
		<div class="in-entreprise">
			<form id="form-entreprise" method="POST" action="" enctype="multipart/form-data">
				<div class="Indentite-entreprise">
					<h3>Identification de l'entreprise</h3>
					<label for="SIRET">SIRET :</label>
                        <input name="siret" type="text" id="siret" value="<?php if(isset($siret)){echo $siret;} ?>" /> <br>
                         <label for="type">forme legale :</label>
                        <select name="formelegale" value="<?php if(isset($formelegale)){echo $formelegale;} ?>">
                        	<option selected ="selected" value="sa">SA</option>
                        	<option value="sarl">SARL</option>
                        	
                        </select><br>
                        <label for="Nom">Nom de l'entreprise :</label>
                        <input name="nomentreprise" type="text" id="nom" value="<?php if(isset($nomentreprise)){echo $nomentreprise;} ?>"/><br>
						 <label for="Nom">Code APE :</label>
                        <input name="ape" type="text" id="APE" value="<?php if(isset($ape)){echo $ape;} ?>"/><br>
						<label for="Logo">Logo :</label>
                        	<input name="logo" type="file" name="ajouter"> <br>
     
				</div>
			<div class="situation geographique">
				<h3>Emplacement</h3>
				<label for="adresse">Adresse :</label>
				<input name="adresse" type="text" id="adresse" value="<?php if(isset($adresse)){echo $adresse;} ?>"><br>
				<label for="adresse(suite)">Adresse(suite) :</label>
				<input name="adressesuite" type="text" id="adresse(suite)"><br>

				<label for="code-postal">Code postale :</label>
				<input name="codepostale" type="text" id="code-postal" value="<?php if(isset($codepostale)){echo $codepostale;} ?>"><br>
				<label for="ville">Ville :</label>
				<input name="ville" type="text" id="ville" value="<?php if(isset($ville)){echo $ville;} ?>"><br>
				 
			
			</div>
			<div class="Coordonnees">
				<h3>Coordonnees de l'entreprise</h3>
				<label for="tel">telephone :</label>
				<input name="telephone" type="text" id="tel" value="<?php if(isset($telephone)){echo $telephone;} ?>"> <br>
				
				<label for="email">email :</label>
				<input name="email" type="email" id="email" value="<?php if(isset($email)){echo $email;} ?>">

			</div>
			<div class="Administrateur du compte entreprise">
				<h3>Administrateur du compte </h3>
				<label for="type">Civilites:</label>
                        <select name="civilite" value="<?php if(isset($civilite)){echo $civilite;} ?>">
                        	<option selected ="selected" value="M">M.</option>
                        	<option value="MME">Mme.</option>
                        </select><br>
                        <label for="Prenom">Prenom :</label>
                        <input name="prenom" type="text" id="prenom" value="<?php if(isset($prenom)){echo $prenom;} ?>"/> <br>

                        <label for="Nom">Nom :</label>
                        <input name="nom" type="text" id="nom" value="<?php if(isset($nom)){echo $nom;} ?>"/><br>
                        <label for="Nom">telephone fixe:</label>
                        <input name="fixe" type="text" id="fixe" value="<?php if(isset($fixe)){echo $fixe;} ?>"/><br>
                        <label for="Nom">telephone mobile:</label>
                        <input name="mobile" type="text" id="mobile" value="<?php if(isset($mobile)){echo $mobile;} ?>"/><br>
                        <label for="type">Role :</label>
                        <select name="role" value="<?php if(isset($role)){echo $role;} ?>">
                        	<option selected ="selected" value="tuteur">tuteur</option>
                        	<option value="Responsable de l'entreprise">Responsable de l'entreprise</option>
                        	<option value="Signataire de convention du stage">Signataire de convention du stage</option>
                        </select><br>
			</div>
			<div class="identification">
				<h3>indentification de connexion</h3>
				<label for="email"> Email :</label>
				<input name="identifiant" type="email" id="email" value="<?php if(isset($identifiant)){echo $identifiant;} ?>"> <br>
				<label for="password">Mot de passe :</label>
				<input name="motdepasse" type="password" id="password"><br>
				<label for="password"> Confirmation du mot de passe :</label>
				<input name="motdepasse2" type="password" id="password">

			</div>
			<div class="condition">
			
		
			<button name="forminscription" class="rounded" type="submit">Valider</button>
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
