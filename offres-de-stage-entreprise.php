<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{

$requser = $bdd->prepare("SELECT * FROM entreprise WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
 
 

$requser = $bdd->prepare("SELECT * FROM envoi_offre JOIN  entreprise WHERE envoi_offre.id_entreprise  = entreprise.id and entreprise.id=".$_SESSION['id']);
$requser->execute();





  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/offres-de-stage-entreprise.css">
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
	
			
				<li><a href="suivi-des-stagiaires.php?id= <?php echo $_SESSION['id'] ?>"><span>Suivre mes stagiaires</span> <i class="fas fa-comments"></i></a></li>

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
	<div class="container">
		<div class="suggestion">
			<h3>Mes offres</h3>
			<div class="entreprise">
					 
			<?php while ($offre=$requser->fetch(PDO::FETCH_ASSOC)) {
			extract($offre);	
			 ?>
			<a href="#" title=""><p><?php echo $offre['intitule'];  ?></p></a>
			<?php }?>
			
			<a href="envoi-offre.php"><button name="Ajouter" class="rounded1" type="submit">Rediger une offre de stage</button></a>
			<br>
			</div>
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

</body>
</html>
<?php 

     }

 ?>