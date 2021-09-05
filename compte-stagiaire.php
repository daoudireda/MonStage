<?php 

session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['id'])) 
{
$requser = $bdd->prepare("SELECT * FROM etudiant WHERE id=?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) 
{
	# code...
	$newprenom = htmlspecialchars($_POST['newprenom']);
	$insertprenom = $bdd->prepare("UPDATE etudiant SET prenom = ? WHERE id = ? ");
	$insertprenom ->execute(array($newprenom, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) 
{
	# code...
	$newnom = htmlspecialchars($_POST['newnom']);
	$insertnom = $bdd->prepare("UPDATE etudiant SET nom = ? WHERE id = ? ");
	$insertnom ->execute(array($newnom, $_SESSION['id']));
	header ('Location: compte-stagiaire.php?id='.$_SESSION['id']);
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
}

if (isset($_POST['newemail']) AND !empty($_POST['newemail']) AND $_POST['newemail'] != $user['email']) 
{
	# code...
	$newemail = htmlspecialchars($_POST['newemail']);
	$insertemail = $bdd->prepare("UPDATE etudiant SET email = ? WHERE id = ? ");
	$insertemail ->execute(array($newemail, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newsexe']) AND !empty($_POST['newsexe']) AND $_POST['newsexe'] != $user['sexe']) 
{
	# code...
	$newsexe = htmlspecialchars($_POST['newsexe']);
	$insertsexe = $bdd->prepare("UPDATE etudiant SET sexe = ? WHERE id = ? ");
	$insertsexe ->execute(array($newsexe, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newdatedenaissance']) AND !empty($_POST['newdatedenaissance']) AND $_POST['newdatedenaissance'] != $user['datedenaissance']) 
{
	# code...
	$newdatedenaissance = htmlspecialchars($_POST['newdatedenaissance']);
	$insertdatedenaissance = $bdd->prepare("UPDATE etudiant SET datedenaissance = ? WHERE id = ? ");
	$insertdatedenaissance ->execute(array($newdatedenaissance, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
} 

if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name']))

    {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');
        if($_FILES['photo']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "membres/etudiantimg/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateavatar = $bdd->prepare('UPDATE etudiant SET photo = :photo WHERE id = :id');
                    $updateavatar->execute(array(
                        'photo' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                        ));
                   header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
                }
                else
                {
                    $erreur = "Erreur durant l'importation de votre photo de profile";
                }
            }
            else
            {
                $erreur = "Votre photo de profil doit être au format jpg, jpeg, png et gif";
            }
        }
        else
        {
            $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
        }
    }




if (isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse']) 
{
	# code...
	$newadresse = htmlspecialchars($_POST['newadresse']);
	$insertadresse = $bdd->prepare("UPDATE etudiant SET adresse = ? WHERE id = ? ");
	$insertadresse ->execute(array($newadresse, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newadressesuite']) AND !empty($_POST['newadressesuite']) AND $_POST['newadressesuite'] != $user['adressesuite']) 
{
	# code...
	$newadressesuite = htmlspecialchars($_POST['newadressesuite']);
	$insertadressesuite = $bdd->prepare("UPDATE etudiant SET adressesuite = ? WHERE id = ? ");
	$insertadressesuite ->execute(array($newadressesuite, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);

}

if (isset($_POST['newcodepostal']) AND !empty($_POST['newcodepostal']) AND $_POST['newcodepostal'] != $user['codepostal']) 
{
	# code...
	$newcodepostal = htmlspecialchars($_POST['newcodepostal']);
	$insertcodepostal = $bdd->prepare("UPDATE etudiant SET codepostal = ? WHERE id = ? ");
	$insertcodepostal ->execute(array($newcodepostal, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newville']) AND !empty($_POST['newville']) AND $_POST['newville'] != $user['ville']) 
{
	# code...
	$newville = htmlspecialchars($_POST['newville']);
	$insertville = $bdd->prepare("UPDATE etudiant SET ville = ? WHERE id = ? ");
	$insertville ->execute(array($newville, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}

if (isset($_POST['newamobile']) AND !empty($_POST['newmobile']) AND $_POST['newmobile'] != $user['mobile']) 
{
	# code...
	$newmobile = htmlspecialchars($_POST['newmobile']);
	$insertmobile = $bdd->prepare("UPDATE etudiant SET mobile = ? WHERE id = ? ");
	$insertmobile ->execute(array($newmobile, $_SESSION['id']));
	header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
	
}




if(isset($_POST['newmotdepasse']) AND !empty($_POST['newmotdepasse']) AND isset($_POST['newmotdepasse1']) AND !empty($_POST['newmotdepasse1'])) {
      $motdepasse = sha1($_POST['newmotdepasse']);
      $motdepasse1 = sha1($_POST['newmotdepasse1']);
      if($motdepasse == $motdepasse1) {
         $insertmotdepasse = $bdd->prepare("UPDATE etudiant SET motdepasse = ? WHERE id = ?");
         $insertmotdepasse->execute(array($motdepasse, $_SESSION['id']));
         header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
      } else 
      {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
 if(isset($_FILES['cv']) AND !empty($_FILES['cv']['name']))

    {
        $tailleMax = 2097152;
        $extensionsValides = array('pdf','docx');
        if($_FILES['cv']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['cv']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "membres/etudiantcv/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['cv']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateavatar = $bdd->prepare('UPDATE etudiant SET cv = :cv WHERE id = :id');
                    $updateavatar->execute(array(
                        'cv' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                        ));
                   header('Location: table-de-bord-stagiaire.php?id='.$_SESSION['id']);
                }
                else
                {
                    $erreur = "Erreur durant l'importation de votre cv";
                }
            }
            else
            {
                $erreur = "Votre photo de profil doit être au format pdf";
            }
        }
        else
        {
            $erreur = "Votre photo de profil ne doit pas dépasser 2Mo";
        }
    }
   
  

 
    
  
?>
 
<!DOCTYPE html>
<html>
<head>
	<title></title>
		<link rel="stylesheet" type="text/css" href="css/compte-stagiaire.css">
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
				
				<li><a href="compte-stagiaire.php?id= <?php echo $_SESSION['id'] ?>"><span>Mon compte</span> <i class="fas fa-user"></i></a></li>
			
					<?php

			if (isset($_SESSION['id']) AND $user['id'] == $_SESSION['id']) 
			{
			?>	
				<li><a href="table-de-bord-stagiaire.php?id= <?php echo $_SESSION['id'] ?>"><span>Tableau de bord</span><i class="fas fa-calendar-alt"></i></a></li>
			<?php 

				}
			 ?>
				
				<li><a href="rechercher-entreprise.php?id= <?php echo $_SESSION['id'] ?>"><span>Recherche une entreprise</span><i class="fas fa-search"></i></a></li>
				<li><a href="gestion-stages.php?id= <?php echo $_SESSION['id'] ?>"><span>Gestion du stage</span><i class="fas fa-check"></i></a></li>
			
				<li><a href="deconnexion.php"><span>Deconnexion</span><i class="fas fa-sign-out-alt"></i></a></li>
			
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
					<li><a href="#">Mon compte<i class="fas fa-check"></i></a></li>
					<li><a href="gestion-stages.php?id= <?php echo $_SESSION['id'] ?>">Vos demandes de stage</a></li>
				</ol>
				</div>
			</div>
</div>
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
				<label for="password">Mot de passe <sup>*</sup> :</label>
				<input type="password" id="password" name="newmotdepasse" >
				<label for="password">Confirmation du mot de passe <sup>*</sup> :</label>
				<input type="password" id="password" name="newmotdepasse1" >
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
			<div class="suprimer">
				<a href="delete.php?id= <?php echo $_SESSION['id'] ?>" name="supprimer">Suprimer mon compte</a>
			</div>
			
			
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
	else {
   header("Location: connexion.php");
}


 ?>
 