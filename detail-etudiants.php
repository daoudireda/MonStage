<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{

$requser = $bdd->prepare("SELECT * FROM etudiant WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

if (isset($_POST['formvalidation'])) 
{


        # code...
        $requser =$bdd ->prepare("SELECT * FROM administration_encadrant");
       $requser->execute(array($_SESSION['id']));
		$user = $requser->fetch();
      
         header("Location: nouvel-etudiant.php?id=".$_SESSION['id']);

      
     

    
  


    }

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="css/detail-etudiant.css">
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
		
				<li><a href="fiche-d'etablissement.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'etablissement</span><i class="fas fa-file-alt"></i></a></li>
			

				<li><a href="tableau-de-bord-professeur.php?id=<?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>


				<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>"><span>Etudiants</span><i class="fas fa-user-graduate"></i></a></li>


				<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>"><span>Professeurs</span><i class="fas fa-chalkboard-teacher"></i></a></li>
			




				<li><a href="compte-professeur.php?id=<?php echo $_SESSION['id'] ?>"><span>Mon compte</span><i class="fas fa-user"></i></a></li>
	

				
		
				<li><a href="stage-section.php?id=<?php echo $_SESSION['id'] ?>"><span>Gerer les stages</span><i class="fas fa-check"></i></a></li>




				<li><a href="deconnexion.php"><span>Deconnexion</span><i class="fas fa-sign-out-alt"></i></a></li>
			


				
			</ul>
		</div>
	</section>
	<div class="container1">
		<div class="in-etudiant">
			
			<form id="form-etudiant" method="POST" action="" enctype="multipart/form-data">
				<div class="Indentite-etudiant">
					<h3>Indentite</h3>
					<label for="Prenom">Prenom <sup>*</sup> :</label>
                        <input type="text" id="prenom" name="newprenom" value="<?php echo $user['prenom'];  ?>" /> <br>

                        <label for="Nom">Nom <sup>*</sup>:</label>
                        <input type="text" id="nom" name="newnom" value="<?php echo $user['nom']; ?>"/><br>

                        <label for="sexe">Sexe <sup>*</sup> :</label>
                        <select name="newsexe"value="<?php echo $user['sexe']; ?>">
                        	<option value="H" selected ="selected">Homme</option>
                        	<option value="F">Femme</option>
                        </select><br>
                        <label for="Datedenaissance">Date de naissance <sup>*</sup> :</label>
                        <input type="date" id="date" name="newdatedenaissance" value="<?php echo $user['datedenaissance']; ?>"datedenaissance><br>
                        <label for="photo">Photo <sup>*</sup> :</label>
                    
                        	<input type="file" name="newphoto" value="<?php echo $user['photo']; ?>"> <br> 
				</div>
			<div class="identification">
				<h3>indentification de connexion</h3>
				<label for="email"> Email <sup>*</sup> :</label>
				<input type="email" id="email" name="newemail" value="<?php echo $user['email'];?>"><br>
				
			</div>
			<div class="coordonnees">
				<h3>Coordonnees</h3>
				<label for="adresse">Adresse <sup>*</sup> :</label>
				<input type="text" id="adresse" name="newadresse" value="<?php echo $user['adresse']; ?>"><br>
				<label for="adresse(suite)">Adresse(suite) :</label>
				<input type="text" id="adresse(suite)" value="<?php echo $user['adressesuite'];?>" name="newadressesuite"><br>

				<label for="code-postal">Code postale <sup>*</sup> :</label>
				<input type="text" id="code-postal" name="newcodepostal" value="<?php echo $user['codepostal']; ?>"><br>
				<label for="ville">Ville <sup>*</sup>:</label>
				<input type="text" id="ville" name="newville" value="<?php echo $user['ville']; ?>"><br>
				<label for="Mobile">Mobile <sup>*</sup>:</label>
				<input type="text" id="mobile" name="newmobile" value="<?php echo $user ['mobile']; ?>"><br>

			</div>
			<div class="document">
				<h3>Documents</h3>
				<label for="cv">CV :</label>
				<input type="file" name="cv" value="<?php echo $user ['cv']; ?>">
			</div>
			<div class="Mobilite">
				<h3>Mobilite</h3>
				<label for="Permis">Permis de conduire :</label>
				<select name="newpermis" value="<?php echo $user['permis']; ?>">
                        	<option selected ="selected">Non renseigne</option>
                        	<option value="O">Oui</option>
                        	<option value="N">Non</option>
                        </select><br>
                <label for="Permis">dispose d un vehicule :</label>
                        	<select name="newvehicule" value="<?php echo $user['vehicule'] ?>">
                        	<option selected ="selected">Non renseigne</option>
                        	<option value="O">Oui</option>
                        	<option value="N">Non</option>
                        </select>
				<button  name="formvalidation" class="rounded" type="submit">Valider</button>
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