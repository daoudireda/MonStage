<?php 

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id']) AND $_GET['id'] > 0)
 {
	# code...
	$getid = intval($_GET['id']);
	$requser = $bdd -> prepare( 'SELECT * FROM entreprise WHERE id = ?');
	$requser-> execute(array($getid));
	$userinfo = $requser ->fetch();






 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/table-de-bord-entreprise.css">
</head>
<body>
	<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/table-de-bord-stagiaire.css">
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
		<div class="stat">

			<a href="#"><span class="number1">0</span> <br>condiadature realisee</a>
			<a href="#"><span class="number1">0</span> <br>condidature realisee</a>
			<a href="#"><span class="number2">0</span><br>conditature refusee</a>
			<a href="#"><span class="number2">0</span><br>conditature acceptee</a>
			
		</div>
		<div class="avatar-picture">
			<div class="picture"><i class="fas fa-user"></i></div>
				<div class="indentifiant">
					<p><span> <?php echo $userinfo['nom']; ?></span>  <span><?php echo $userinfo['prenom'];?> </span> <br> <a href="table-de-bord-entreprise.php?id= <?php echo $_SESSION['id'] ?>" title=""><span><?php echo $userinfo['formelegale']; ?></span> <span><?php echo $userinfo['nomentreprise']; ?></span></p> </a>

				</div>
		</div>
		<section class="aside-menu">
		
			<ul>
				<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="fiche-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'entreprise</span><i class="fas fa-file-alt"></i></a></li>
			
				<?php 
}
				 ?>

				 
				
				<li><a href="#"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>

			<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="profil-de-stagiaire-acceptee.php?id= <?php echo $_SESSION['id'] ?>"><span>Definir un  stagiaire</span><i class="fas fa-check"></i></a></li>
			
				<?php 
}
				 ?>
				
					<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="offres-de-stage-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Rediger un offre</span><i class="fas fa-bullhorn"></i></a></li>
			
				<?php 
}
				 ?>
				 <?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="suivi-des-stagiaires.php?id= <?php echo $_SESSION['id'] ?>"><span>Suivre mes stagiaires</span><i class="fas fa-comments"></i></a></li>
<?php 
}
				 ?>



				<?php

			if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{
			?>	
				<li><a href="deconnexion.php"><span>Deconnexion</span><i class="fas fa-sign-out-alt"></i></a></li>
			<?php 

				}
			 ?>


				
			</ul>
		</div>
		
	</section>
	<section class="zone-filter">
		<div class="container1">
			<form class="form-filter">
				<label for="etat">Etats :</label>
				<select name="sexe">
                        	<option value="tous" selected ="selected">Tous les offres</option>
                        	<option value="acceptes">offres acceptes</option>
                        	<option value="refuses">offres refuses</option>
                        	<option value="realises">offres realises</option>
                </select>
                <label for="du">Du :</label>
                <input type="date" name="date-du">
                <label for="au">Au :</label>
                <input type="date" name="date-au">
                <label for="domaine">Diplome :</label>
                <select name="domaine">
                	<option value="tous"  selected="selected">Tous</option>
					<option value="1"  >Diplome1</option>
					<option value="2"  >Diplome2</option>
					<option value="3"  >Diplome3</option>

                </select>
			</form>
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


		<div class="empty">
			<p>Aucune candidature ne correspond à ces critères</p>
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
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
 
	

</body>
</html>
<?php 

}
else 
{

}


 ?>