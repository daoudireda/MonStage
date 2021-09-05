<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=epace_utilisateur','root','');
$bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (isset($_SESSION['id'])) 
{

$sql = "SELECT * FROM  entreprise ";
$requser = $bdd->prepare($sql);
$requser->execute();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/rechercher-entreprise.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

	<section class="section-padding">
        <div class="container">
            <div class="row">
                <div id="form-container" class="col-xs-12 col-sm-4">
                    
                    <form name="searchform"  method="POST" action="">
                       <h3>Rechercher</h3>
				<label for="activite">Secteur d'activite :</label><br>
                        <select name="activite"value="">
                        	<option value="boisson" selected ="selected">acivite1</option>
                        	<option value="agriculture">activite2</option>
                        </select><br>
                <label for="activite">Secteur geographique :</label> <br>
                        <select name="geographique"value="">
                        	<?php 
                        	$sql1 = "SELECT distinct ville FROM entreprise";
                        	try {
                        		$resultat = $bdd->query($sql1); // on exécute la requête qui renvoie un curseur
       						 	$ville = $_POST["ville"];
						        $resultat->execute(array(":ville" => $ville )); 
						         // lecture du curseur $résultat  dans un tableau associatif 
						        $tabloResultat=$resultat->fetchAll(PDO::FETCH_ASSOC);                   
						        foreach($tabloResultat as $ligne)   
						          {
						            echo "<option value='".$ligne["ville"]."'>".$ligne["ville"]."</option>";
						          }
                        		
                        	} catch (Exception $e) {
                        		echo"ERREUR PDO  " . $e->getMessage();
                        	}


                        	 ?>
               
                        </select><br>
				<label for="libre">Recherche libre :</label><br>
                        <input type="text" name="libre" value="" style="" /> <br>
                        <br>
                 <button class="btn btn-primary" id="btn-send" name="search">Rechercher</button>

                    </form>
				     
                </div>

                <div id="entreprise-container" class="col-xs-12 col-sm-8">
                 
                	<p>Nos suggestions selon votre profil de candidat :</p>
				<div class="col-sm-12">
				<article>
				<?php 
				try {
					 $resultat = $bdd->query($sql); // on exécute la requête qui renvoie un curseur
          
           			// lecture du curseur $résultat  dans un tableau associatif 
          			$tabloResultat=$resultat->fetchAll(PDO::FETCH_ASSOC);                   
          			foreach($tabloResultat as $ligne){
          				echo '<div class="card">';
          				echo '<h5 class="card-header">'.$ligne["nomentreprise"].'</h5>';
          				echo'<div class="card-body">';
          				echo'<h5 class="card-title">Special title treatment</h5>';
          				echo'<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>';
          				
          				echo'<button class="btn btn-primary">Postuler</button>';
          				echo'<button id="ajouter" class="btn btn-primary">Sauvegarder</button>';
          				echo "</div>  </div>";
          				echo "<br>";
          			}

					
				} catch (Exception $e) {
					echo"ERREUR PDO" . $e->getMessage();
				}




				 ?>
				
				  </article>

			</div>
                    
                </div>

            </div>
        </div>
    </section>


           <!--      <?php while ($offre=$requser->fetch(PDO::FETCH_ASSOC)) {
            extract($offre);    
             ?>
			<a href="Entreprise-inscription.php?id= <?php echo $_SESSION['id'] ?>"><h3><?php echo $offre['nomentreprise'];  ?></h3></a>
			<p><?php echo $offre['adresse'];  ?> </p>
          
			<a href="#" title=""><button name="Ajouter" class="rounded1" type="submit">Ajouter l'entreprise a mon classeur</button> </a> 
			<br>
			<a href="#" title=""><button name="postuler" class="rounded2" type="submit">Proposer ma condidature</button></a>
  <?php }?> -->

            

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
	<script src="js/script.js"></script>
</body>
</html>
<?php 

     }

 ?>