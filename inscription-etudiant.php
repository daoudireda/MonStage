<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['forminscription'])) 
{
		$prenom = htmlspecialchars($_POST['prenom']);
		$nom = htmlspecialchars($_POST['nom']);
		$sexe = htmlspecialchars($_POST['sexe']);
		$datedenaissance = htmlspecialchars($_POST['datedenaissance']);
		$photo = $_FILES['photo']['name'];
		
		$email = htmlspecialchars($_POST['email']);
		$motdepasse = sha1($_POST['motdepasse']);
		$motdepasse2 = sha1($_POST['motdepasse2']);
		$adresse = htmlspecialchars($_POST['adresse']);
		$adressesuite = htmlspecialchars($_POST['adressesuite']);
		$codepostal = htmlspecialchars($_POST['codepostal']);
		$ville = htmlspecialchars($_POST['ville']);
		$mobile = htmlspecialchars($_POST['mobile']);
		$permis = htmlspecialchars($_POST['permis']);
		$vehicule = htmlspecialchars($_POST['vehicule']);

		

	


	# code...
	if (!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['sexe']) AND !empty($_POST['datedenaissance'])  AND !empty($_POST['email']) AND !empty($_POST['motdepasse']) AND !empty($_POST['motdepasse2']) AND !empty($_POST['adresse']) AND !empty($_POST['codepostal']) AND !empty($_POST['ville']) AND !empty($_POST['mobile']))
	{
		 

 


		$prenomlenght = strlen($prenom);
		if ($prenomlenght <= 255) 
		{
			if (filter_var($email,FILTER_VALIDATE_EMAIL)) 
			{
				$reqmail = $bdd ->prepare("SELECT *FROM etudiant WHERE email = ?");
            	$reqmail->execute(array($email));
            	$mailexist = $reqmail -> rowCount();
            	if ($mailexist == 0)
            {

				if ($motdepasse == $motdepasse2)

				 {  
				 	  $target = "membres/etudiantimg/".basename($_FILES['photo']['name']);
					  $temp = explode (".", $_FILES["photo"]["name"]);
					  $nomimg = $_FILES['photo']['name'];
					 
					 
					  if(move_uploaded_file($_FILES["photo"]["tmp_name"],$target)){
					    $valide = 'Ok';

				 	}
					$insertmbr = $bdd ->prepare("INSERT INTO etudiant (prenom, nom, sexe, datedenaissance, photo, email, motdepasse, adresse, adressesuite, codepostal, ville, cv, mobile, permis, vehicule) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$insertmbr -> execute(array($prenom, $nom, $sexe, $datedenaissance, $photo, $email, $motdepasse, $adresse, $adressesuite, $codepostal, $ville, 'none', $mobile, $permis, $vehicule));
				
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
    	if(($sexe=='H')||($sexe=='F')){
        $e='e';
    }
    $e='';
    	if(($permis=='O')||($permis=='N')){
        $e='e';
    }
    $e='';
    	if(($vehicule=='O')||($vehicule=='N')){
        $e='e';
    }


    
	

    

   

	
}
 ?>

 
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/inscription-etudiant.css">
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
				<a href="contact.php" class="header-navbar-menu-link">Contact</a>
				<a href="connexion.html" class="header-navbar-menu-link">Se connecter</a>
				<a href="connexion.html" class="header-navbar-menu-link">S'inscrire</a>
				</div>
			</div>
				<div class="header-slogan">
                <h1 class="h-slogan-title">Inscription etudiant</h1>
            </div>

		</div>	
	</div>

	<div class="container1">
		<div class="in-etudiant">
			
			<form id="form-etudiant" method="POST" action=""  enctype="multipart/form-data">
				<div class="Indentite-etudiant">
					<h3>Indentite</h3>
					<label for="Prenom">Prenom <sup>*</sup> :</label>
                        <input type="text" id="prenom" name="prenom" value="<?php if(isset($prenom)){echo $prenom;} ?>" /> <br>

                        <label for="Nom">Nom <sup>*</sup>:</label>
                        <input type="text" id="nom" name="nom" value="<?php if(isset($nom)){echo $nom;} ?>"/><br>

                        <label for="sexe">Sexe <sup>*</sup> :</label>
                        <select name="sexe" name="sexe"value="<?php if(isset($sexe)){echo $sexe;} ?>">
                        	<option value="H" selected ="selected">Homme</option>
                        	<option value="F">Femme</option>
                        </select><br>
                        <label for="Datedenaissance">Date de naissance <sup>*</sup> :</label>
                        <input type="date" id="date" name="datedenaissance" value="<?php if(isset($datedenaissance)){echo $datedenaissance;} ?>"datedenaissance><br>
                        <label for="photo">Photo <sup>*</sup> :</label>
                    
                        	<input type="file" name="photo" value=""> <br> 
                        	
				</div>
			<div class="identification">
				<h3>indentification de connexion</h3>
				<label for="email"> Email <sup>*</sup> :</label>
				<input type="email" id="email" name="email" value="<?php if(isset($email)){echo $email;} ?>"> <br>
				<label for="password">Mot de passe <sup>*</sup> :</label>
				<input type="password" id="password" name="motdepasse" >
				<label for="password"> Confirmation du mot de passe <sup>*</sup> :</label>
				<input type="password" id="password" name="motdepasse2">
			</div>
			<div class="coordonnees">
				<h3>Coordonnees</h3>
				<label for="adresse">Adresse <sup>*</sup> :</label>
				<input type="text" id="adresse" name="adresse" value="<?php if(isset($adresse)){echo $adresse;} ?>"><br>
				<label for="adresse(suite)">Adresse(suite) :</label>
				<input type="text" id="adresse(suite)" name="adressesuite"><br>

				<label for="code-postal">Code postale <sup>*</sup> :</label>
				<input type="text" id="code-postal" name="codepostal" value="<?php if(isset($codepostal)){echo $codepostal;} ?>"><br>
				<label for="ville">Ville <sup>*</sup>:</label>
				<input type="text" id="ville" name="ville" value="<?php if(isset($ville)){echo $ville;} ?>"><br>
				<label for="Mobile">Mobile <sup>*</sup>:</label>
				<input type="text" id="mobile" name="mobile" value="<?php if(isset($mobile)){echo $mobile;} ?>"><br>

			</div>
			
			<div class="Mobilite">
				<h3>Mobilite</h3>
				<label for="Permis">Permis de conduire :</label>
				<select name="permis" value="<?php if(isset($permis)){echo $permis;} ?>">
                        	<option selected ="selected">Non renseigne</option>
                        	<option value="O">Oui</option>
                        	<option value="N">Non</option>
                </select><br>
                <label for="Permis">dispose d'un vehicule :</label>
                        	<select name="vehicule" value="<?php if(isset($vehicule)){echo $vehicule;} ?>">
                        	<option selected ="selected">Non renseigne</option>
                        	<option value="O">Oui</option>
                        	<option value="N">Non</option>
                        	</select>

			</div>
			<div class="condition">
			<input type="checkbox" name="condition" >J'accepte les
			<a href="#">Conditions Generales de Vente et d'Utilisation </a><sup>*</sup>
			<p>Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé permettant la mise en relation entre élèves/étudiants, entreprises et personnels d'établissements de formation à propos de stages ou de contrats en alternance.<br>
				<br>
			Elles sont conservées pendant un délai raisonnable et sont destinées aux utilisateurs de la plate-forme (élèves/étudiants, entreprises, personnels des établissements de formation dans le cas d'une inscription de l'élève/étudiant par son établissement de formation).<br>
			<br>
			Astérisque * : Champ obligatoire </p>
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