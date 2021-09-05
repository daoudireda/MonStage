
<!DOCTYPE html>
<html>
<head>
	<title>MonStage</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/contact.css">
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
				<a href="#" class="header-navbar-menu-link">Contact</a>
				<a href="connexion.php" class="header-navbar-menu-link">Se connecter</a>
				<a href="connexion.php" class="header-navbar-menu-link">S'inscrire</a>
				</div>
			</div>
				<div class="header-slogan">
                <h1 class="h-slogan-title">Contact</h1>
            </div>

		</div>
	</div>
	 <section id="contact">
        <div class="container">

            <div class="flex">
                <div id="form-container">
                    <h3>Contact Form</h3>
                    <form method="POST" action="">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="" />
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="" />

                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="" />

                        <label for="message">Message</label>
                        <textarea id="message" name="message">Write your message here.. </textarea>

                        <button class="rounded" name="emailform">Send Message</button>

                    </form>
				     
                </div>

                <div id="address-container">
                    <label>Address</label>
                    <address>
                        20377 Evergreen Terrace Mountain View, California, USA 
                    </address>

                    <label>Phone</label>
                    <a  href="#">232-232-2323</a>

                    <label>Email Address</label>
                    <a href="#">ouremail@domain.com</a>
                </div>
            </div>
        </div>
    </section>
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
                    <li><a href="#">Contact</a></li>
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