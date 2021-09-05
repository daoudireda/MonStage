<?php 

session_start();


$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{

$requser = $bdd->prepare("SELECT * FROM entreprise WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();


if (isset($_POST['offrevalide'])) 
{
		
		$intitule = htmlspecialchars($_POST['intitule']);
		$nembre = htmlspecialchars($_POST['nembre']);
		$mission = htmlspecialchars($_POST['mission']);
		$lieu = htmlspecialchars($_POST['lieu']);
		$permis = htmlspecialchars($_POST['permis']);


		if (!empty($_POST['intitule']) AND !empty($_POST['mission'])) {
			# code...
				$insertmbr = $bdd ->prepare("INSERT INTO envoi_offre ( id_entreprise, intitule, nembre, mission, lieu, permis) VALUES( ?, ?, ?, ?, ?, ?)");
					$insertmbr -> execute(array( $_SESSION['id'], $intitule, $nembre, $mission, $lieu, $permis));
					header("Location: offres-de-stage-entreprise.php?id=".$_SESSION['id']);


		 }

	else 
	{
		$erreur = "Tous les champs doivent etre completes !";
	}
	$e='';
    	if(($permis=='O')||($permis=='N')){
        $e='e';
    }
}
  


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="css/envoi-offre.css">
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
	<div class="container1">
		<div class="in-etablissement">
			<form id="form-etablissement" method="POST" action="" enctype="multipart/form-data">

			<div class="Modalites">
				<h3>Modalite </h3>
				
				<label for="type">Intitule :</label>
                       <textarea name="intitule" ></textarea>
                <label for="type">Nembre de places disponibles :</label>
                        <select name="nembre" value="">
                        	<option selected ="selected" value="1">1</option>
                        	<option value="2">2</option>
                        	<option value="3">3</option>
                        	<option value="4">4</option>
                        	<option value="5">5</option>
                        	<option value="6">6</option>

                        </select><br>

                        <label for="mission"> Mission a effectuer :</label>
                       <textarea name="mission"></textarea>
                       <label for="lieu"> Lieu du déroulement (si différent de l'adresse principale) :</label>
                       <textarea name="lieu"></textarea>
				 <label for="type">Permis de conduire exige :</label>
                        <select name="permis" value="">
                        	<option selected ="selected" value="O">Oui</option>
                        	<option value="N">Non</option>
                        	

                        </select><br>
                      
			</div>
			
			<div class="condition">
			
			<button class="rounded" type="submit" name="offrevalide">Valider</button>
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


?>
