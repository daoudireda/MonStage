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
<link rel="stylesheet" type="text/css" href="css/detail-profil-de-stagiaire-acceptee.css">
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
			
				<li><a href="fiche-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Fiche d'entreprise</span><i class="fas fa-file-alt"></i></a></li>
			

				 
				
				<li><a href="table-de-bord-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"> </i></a></li>

			
				<li><a href="profil-de-stagiaire-acceptee.php?id= <?php echo $_SESSION['id'] ?>"><span>Definir un  stagiaire</span> <i class="fas fa-check"></i></a></li>
			

				<li><a href="offres-de-stage-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Rediger un offre</span> <i class="fas fa-bullhorn"></i></a></li>
	
			
				<li><a href="suivi-des-stagiaires.php?id= <?php echo $_SESSION['id'] ?>"><span>Suivre mes stagiaires</span> <i class="fas fa-comments"></i></a></li>

				<li><a href="deconnexion.php"><span>Deconnexion</span> <i class="fas fa-sign-out-alt"></i></a></li>
			


				
			</ul>
		</div>

	</section>
	<div class="container1">
		<div class="in-etablissement">
			<form id="form-etablissement" method="POST" action="" enctype="multipart/form-data">

			<div class="formation">
					<p>Définir un profil de stagiaire permet de vous identifier auprès des élèves et des étudiants comme une entreprise ouverte à l'accueil de stagiaires. Cela consiste à choisir a minima une formation, un domaine d'activité et un diplôme. Ces informations peuvent être modifiées à tout moment.
						<br>
					Vous pouvez ajouter autant de profils de stagiaire que nécessaire.</p>
                <label for="type">Formation :</label>
                        <select name="places" value="">
                        	<option selected ="selected">DUT</option>
                        	<option>Liscence</option>

                        </select><br>

				 <label for="type">Diplome d'activite :</label>
                        <select name="places" value="">
                        	<option selected ="selected">la gestion</option>
                        	<option>finance et fisclite</option>
                        	<option>Logistique</option>
                        	<option>web marketing</option>
                        	<option>informatique</option>

                        </select><br>
                            <label for="type">Diplome :</label>
                        <select name="places" value="">
                        	<option selected ="selected">DUT gestion</option>
                        	<option>DUT web marketing</option>

                        </select><br>
                             <label for="type">Annee de formation :</label>
                        <select name="places" value="">
                        	<option selected ="selected">Peu importe</option>
                        	<option>1 ere annee</option>
							<option>2 eme annee</option>
                        </select><br>
                        <label for="nembre">Nembres de stagaires accepte(e)s :</label>
                        <input type="text" name="nbacceptes">
                      
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

 ?>