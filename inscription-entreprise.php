<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['forminscription'])) 
{
		$siret = htmlspecialchars($_POST['siret']);
		$formelegale = htmlspecialchars($_POST['formelegale']);
		$nomentreprise = htmlspecialchars($_POST['nomentreprise']);
		$ape = htmlspecialchars($_POST['ape']);
		$logo = $_FILES['logo']['name'];
		$adresse = htmlspecialchars($_POST['adresse']);
		$adressesuite = htmlspecialchars($_POST['adressesuite']);
		$codepostale = htmlspecialchars($_POST['codepostale']);
		$ville = htmlspecialchars($_POST['ville']);
		$telephone = htmlspecialchars($_POST['telephone']);
		$email = htmlspecialchars($_POST['email']);
		$civilite = htmlspecialchars($_POST['civilite']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$nom = htmlspecialchars($_POST['nom']);
		$fixe = htmlspecialchars($_POST['fixe']);
		$mobile = htmlspecialchars($_POST['mobile']);
		$role = htmlspecialchars($_POST['role']);
		$identifiant = htmlspecialchars($_POST['identifiant']);
		$motdepasse = sha1($_POST['motdepasse']);
		$motdepasse2 = sha1($_POST['motdepasse2']);
		

		

	


	# code...
	if (!empty($_POST['siret']) AND !empty($_POST['formelegale']) AND !empty($_POST['nomentreprise']) AND !empty($_POST['ape']) AND !empty($_POST['adresse']) AND !empty($_POST['telephone']) AND !empty($_POST['email']) AND !empty($_POST['civilite']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['role']) AND !empty($_POST['identifiant']) AND !empty($_POST['motdepasse']) AND !empty($_POST['motdepasse2']))
	{
		 

 


		$prenomlenght = strlen($prenom);
		if ($prenomlenght <= 255) 
		{
			if (filter_var($identifiant,FILTER_VALIDATE_EMAIL)) 
			{
				$reqmail = $bdd ->prepare("SELECT * FROM entreprise WHERE identifiant = ?");
            	$reqmail->execute(array($identifiant));
            	$mailexist = $reqmail -> rowCount();
            	if ($mailexist == 0)
            {

				if ($motdepasse == $motdepasse2)

				 {  
				 	$target = "membres/entrepriselogo/".basename($_FILES['logo']['name']);
					  $temp = explode (".", $_FILES["logo"]["name"]);
					  $nomimg = $_FILES['logo']['name'];
					 
					 
					  if(move_uploaded_file($_FILES["logo"]["tmp_name"],$target)){
					    $valide = 'Ok';

				 	}

				 	
					$insertmbr = $bdd ->prepare("INSERT INTO entreprise (siret, formelegale, nomentreprise, ape, logo, adresse, adressesuite, codepostale, ville, telephone, email, civilite, prenom, nom, fixe, mobile, role, identifiant, motdepasse) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insertmbr -> execute(array($siret, $formelegale, $nomentreprise, $ape, $logo, $adresse, $adressesuite, $codepostale, $ville, $telephone, $email, $civilite, $prenom, $nom, $fixe, $mobile, $role, $identifiant, $motdepasse));
				
				header("Location: connexion.php");
				
				
				
				}
				else
				{
					$erreur = "Vos mots de passes ne correspondent pas !";
				}

			}
            else
                {
                    $erreur = "Adresse mail deja utilisee !";
                }
					
				
			}
			else
			{
				$erreur = "Votre adresse email n'est pas valide !";
			}
			
			}
			else
			{
				$erreur= "Votre prenom ne foit pas deppasser 255 caracteres !";
			}

		
     }

	else 
	{
		$erreur = "Tous les champs doivent etre completes !";
	}
	$e='';
    	if(($formelegale=='sa')||($formelegale=='sarl')){
        $e='e';
    }
    $e='';
    	if(($civilite=='M')||($civilite=='MME')){
        $e='e';
    }
    $e='';
    	if(($role=='Responsable de l\'\entreprise')||($role=='tuteur')||($role=='Signataire de convention du stage')){
        $e='e';
    }


    
	

    

   

	
}





?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/inscription-entreprise.css">
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
				<div class="header-navbar-menu">
				<a href="index.html" class="header-navbar-menu-link">Acceuil</a>
				<a href="A propos.html" class="header-navbar-menu-link">A propos</a>
				<a href="#" class="header-navbar-menu-link">Blog</a>
				<a href="#" class="header-navbar-menu-link">Contact</a>
				<a href="connexion.php" class="header-navbar-menu-link">Se connecter</a>
				<a href="connexion.php" class="header-navbar-menu-link">S'inscrire</a>
				</div>
			</div>
				<div class="header-slogan">
                <h1 class="h-slogan-title">Inscription entreprise</h1>
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
                        	<input name="logo" type="file"  value="<?php if(isset($logo)){echo $logo;} ?>"> <br>
     
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
			<input type="checkbox" name="condition">J'accepte les
			<a href="#">Conditions Generales de Vente et d'Utilisation</a>
			<p>Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé permettant la mise en relation entre élèves/étudiants, entreprises et personnels d'établissements de formation à propos de stages ou de contrats en alternance.<br>
				<br>
			Elles sont conservées pendant un délai raisonnable et sont destinées aux utilisateurs de la plate-forme (élèves/étudiants, entreprises, personnels des établissements de formation dans le cas d'une inscription de l'élève/étudiant par son établissement de formation).</p>
			<button name="forminscription" class="rounded" type="submit">Poursuivre mon inscription</button>
			</div>
			</form>
			<?php
				if (isset($erreur))
				 {
					# code...
					echo'<font color="red">' .$erreur."</font>";
				}
			  ?>
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