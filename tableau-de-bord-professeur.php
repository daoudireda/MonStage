<?php 

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['id']) AND $_GET['id'] > 0)
 {
	# code...
	$getid = intval($_GET['id']);
	$requser = $bdd -> prepare( 'SELECT * FROM administration_encadrant WHERE id = ?');
	$requser-> execute(array($getid));
	$userinfo = $requser ->fetch();






 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/tableau-de-bord-professeur.css">
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

			<a href="#"><span class="number1">0</span> <br>nembres de stages</a>
			<a href="#"><span class="number1">0</span> <br>nembres de stage actuel</a>
			<a href="#"><span class="number2">0</span><br>nembres de profs</a>
			<a href="#"><span class="number2">0</span><br>nembres de etudiants</a>
			
		</div>
		<div class="avatar-picture">
			<div class="picture"><i class="fas fa-user"></i></div>
				<div class="indentifiant">
					<p><span> <?php echo $userinfo['nom']; ?></span>  <span><?php echo $userinfo['prenom'];?> </span> <br> <a href="etablissement.php?id= <?php echo $_SESSION['id'] ?>" title=""><span><?php echo $userinfo['type']; ?></span> <span><?php echo $userinfo['nometablissement']; ?></span></p> </a>

				</div>
		</div>
		<section class="aside-menu">
		
			<ul>
				<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="fiche-d'etablissement.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'etablissement</span><i class="fas fa-file-alt"></i></a></li>
			
					<?php 
}
				 ?>

				 
					<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="tableau-de-bord-professeur?id=<?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>

							<?php 
}
				 ?>
				 <?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>
				<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>"><span>Etudiants</span><i class="fas fa-user-graduate"></i></a></li>
							<?php 
}
				 ?>


		<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>

				<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>"><span>Professeurs</span><i class="fas fa-chalkboard-teacher"></i></a></li>
			
						<?php 
}
				 ?>


		<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>



				<li><a href="compte-professeur.php?id=<?php echo $_SESSION['id'] ?>"><span>Mon compte</span><i class="fas fa-user"></i></a></li>
	
						<?php 
}
				 ?>


				<?php 
				if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) 
			{	
				?>

				<li><a href="stage-section.php?id=<?php echo $_SESSION['id'] ?>"><span>Gerer les stages</span><i class="fas fa-check"></i></a></li>


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
				<label for="etat">Section :</label>
				<select name="sexe">
                        	<option value="tous" selected ="selected">Section</option>
                        	<option value="acceptes">offres acceptes</option>
                        	<option value="refuses">offres refuses</option>
                        	<option value="realises">offres realises</option>
                </select>
                <label for="">Groupe :</label>
             	<select >
             		<option value="tg" selected="selected"> tous la classe </option>
             		<option value="mg"> mon groupe </option>
             		
             	</select>
             	<label for="">Periode :</label>
             	
                <select name="domaine">
                	<option value="tous"  selected="selected">Tous les periodes</option>
					<option value="1"  >Periode 1</option>
					<option value="2"  >Periode 2</option>
					<option value="3"  >Periode 3</option>

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
					<li><a href="professeurs.php?id=<?php echo $_SESSION['id'] ?>">Inscrire des professeurs <i class="fas fa-check"></i> </a></li>
					<li><a href="ajout-etudiant.php?id=<?php echo $_SESSION['id'] ?>" title="">Inscrire des élèves/étudiants</a></li>
				</ol>
				</div>
			</div>


		<div class="empty">
			<p>Aucune offre ne correspond à ces critères</p>
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