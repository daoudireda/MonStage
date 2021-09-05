<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['formconnexion']))
 {
    # code...
    $identifiant =htmlspecialchars($_POST['identifiant']);
    $motdepasse = sha1($_POST['motdepasse']);

    if (!empty($identifiant) AND !empty($motdepasse))
    {
        # code...
        $requser =$bdd ->prepare("SELECT * FROM entreprise WHERE identifiant = ? AND motdepasse = ?");
        $requser->execute(array($identifiant,$motdepasse));
        $userexist = $requser -> rowCount();
        if ($userexist== 1)
        {
            $userinfo = $requser ->fetch();
            $_SESSION ['id'] = $userinfo['id'];
            $_SESSION['prenom']= $userinfo['prenom'];
            $_SESSION['nom']= $userinfo['nom'];
            $_SESSION['identifiant'] = $userinfo['identifiant'];
            header("Location: table-de-bord-entreprise.php?id=".$_SESSION['id']);
        }
        else {
            $erreur = "Mauvais email ou mot de passe !";

        }

    }
    else 
    {
        $erreur= "tous les champs doivent etre connectes !";

    }

}

 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/connexion.css">
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
				<a href="connexion.php" class="header-navbar-menu-link">Se connecter</a>
				<a href="connexion.php" class="header-navbar-menu-link">S'inscrire</a>
				</div>
			</div>
				<div class="header-slogan">
                <h1 class="h-slogan-title">Connexion</h1>
            </div>

		</div>	
	</div>
	
<div class="container1">
	<div class="inscription">
		<h3>Creez votre compte MonStage.</h3>
	<a href="inscription-entreprise.php" class="sub-btn">Entreprise</a>
	<a href="inscription etablissement-encadrant.php" class="sub-btn">Etablissement/Encadrant</a>
	<a href="inscription-etudiant.php" class="sub-btn">Etudiant</a>
</div>
<div class="connexion">
<h3>Identifiez-vous</h3>
<form id="form-con" method="POST" action="">
	 					<label for="email">Email</label>
                        <input type="email" id="email" name="identifiant" />

                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="motdepasse" />
						<button class="rounded" type="submit" name="formconnexion">Me connecter</button>
	
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
                    <li><a href="contact.php">Contact</a></li>
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
</body>
</html>