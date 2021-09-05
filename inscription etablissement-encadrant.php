<?php 

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['forminscription'])) 
{
		$nometablissement = htmlspecialchars($_POST['nometablissement']);
		$RNE = htmlspecialchars($_POST['RNE']);
		$photo = $_FILES['photo']['name'];
		$type = htmlspecialchars($_POST['type']);
		$presentation = htmlspecialchars($_POST['presentation']);
		$adresse = htmlspecialchars($_POST['adresse']);
		$adressesuite = htmlspecialchars($_POST['adressesuite']);
		$codepostale = htmlspecialchars($_POST['codepostale']);
		$ville = htmlspecialchars($_POST['ville']);
		$telephone = htmlspecialchars($_POST['telephone']);
		$fax = htmlspecialchars($_POST['fax']);
		$email = htmlspecialchars($_POST['email']);
		$civilite = htmlspecialchars($_POST['civilite']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$nom = htmlspecialchars($_POST['nom']);
		$identifiant = htmlspecialchars($_POST['identifiant']);
		$motdepasse = sha1($_POST['motdepasse']);
		$motdepasse2 = sha1($_POST['motdepasse2']);
		
		


	# code...
	if (!empty($_POST['nometablissement']) AND !empty($_POST['RNE']) AND !empty($_POST['type']) AND !empty($_POST['adresse']) AND !empty($_POST['codepostale']) AND !empty($_POST['ville']) AND !empty($_POST['telephone']) AND !empty($_POST['email']) AND !empty($_POST['civilite']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['identifiant']) AND !empty($_POST['motdepasse']) AND !empty($_POST['motdepasse2']))
	{
		 

 


		$prenomlenght = strlen($prenom);
		if ($prenomlenght <= 255) 
		{
			if (filter_var($identifiant,FILTER_VALIDATE_EMAIL)) 
			{
				$reqmail = $bdd ->prepare("SELECT *FROM administration_encadrant WHERE identifiant = ?");
            	$reqmail->execute(array($identifiant));
            	$mailexist = $reqmail -> rowCount();
            	if ($mailexist == 0)
            {

				if ($motdepasse == $motdepasse2)

				 {  

				 	$target = "membres/etablissementlogo/".basename($_FILES['photo']['name']);
					  $temp = explode (".", $_FILES["photo"]["name"]);
					  $nomimg = $_FILES['photo']['name'];
					 
					 
					  if(move_uploaded_file($_FILES["photo"]["tmp_name"],$target)){
					    $valide = 'Ok';

				 	}
				 $insertmbr = $bdd ->prepare("INSERT INTO administration_encadrant (nometablissement, RNE, photo, type, presentation, adresse, adressesuite, codepostale, ville, telephone, fax, email, civilite, prenom, nom, identifiant, motdepasse) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insertmbr -> execute(array($nometablissement, $RNE, $photo, $type, $presentation, $adresse, $adressesuite, $codepostale, $ville, $telephone, $fax, $email, $civilite, $prenom, $nom, $identifiant, $motdepasse,));
				
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
    	if(($type=='FES')||($type=='IUT')){
        $e='e';
    }
    $e='';
    	if(($civilite=='M')||($civilite=='MME')){
        $e='e';
    }
  


    
	

    

   

	
}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/inscription-etablissement-encadrant.css">
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
                <h1 class="h-slogan-title">Inscription etablissement/encadrant</h1>
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
			<input type="checkbox" name="condition">J'accepte les
			<a href="#">Conditions Generales de Vente et d'Utilisation</a>
			<p>Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé permettant la mise en relation entre élèves/étudiants, entreprises et personnels d'établissements de formation à propos de stages ou de contrats en alternance.<br>
				<br>
			Elles sont conservées pendant un délai raisonnable et sont destinées aux utilisateurs de la plate-forme (élèves/étudiants, entreprises, personnels des établissements de formation dans le cas d'une inscription de l'élève/étudiant par son établissement de formation).</p>
			<button class="rounded" type="submit" name="forminscription">Poursuivre mon inscription</button>
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