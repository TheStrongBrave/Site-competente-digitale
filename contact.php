<?php
session_start();
$page ='contact';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	//die("Connection failed: " . mysqli_connect_error());
}
include '_header.php';
?>
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
			   	<li style="background-image: url(images/galaxie.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">Contact</h2>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2848.2504000514878!2d26.090266576776724!3d44.448536471075606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1ff53841c9cb1%3A0x858fd573ba6b5309!2sBulevardul%20Lasc%C4%83r%20Catargiu%2021%2C%20Bucure%C8%99ti%20010662!5e0!3m2!1sro!2sro!4v1682933070885!5m2!1sro!2sro" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		<span id="formular"></span>
		<div id="fh5co-contact-section">
			<div class="container">
				<?php
				if(isset($_POST['nume']) && isset($_POST['email']) && isset($_POST['text']))
				{
					if($_POST['nume']!='' && $_POST['email']!='' && $_POST['text'])
					{
						$allow = 1;
						if(isset($_SESSION['mesaj']))
						{
							if($_POST['text'] == $_SESSION['mesaj'])
							{
								$allow = 0;
							}
						}
						if($allow != 0)
						{
							$sql ='INSERT INTO `comentarii`
								(nume , email, text)
								VALUES ("'.$_POST['nume'].'","'.$_POST['email'].'","'.$_POST['text'].'");';
							$result = mysqli_query($conn, $sql);
							if ($result)
							{
								echo '<div class="alert alert-success">
										<strong>Succes!</strong> Mesajul tău a fost transmis!
									</div>';
								$_SESSION['mesaj'] = $_POST['text'];
							}
						}
						
					}else{
						echo '<div class="alert alert-danger">
									<strong>Invalid!</strong> Completează toate câmpurile!
								</div>';
					}
					
				}
				?>
				<form action="contact.php#formular" method="post">
					<div class="row">
						<div class="col-md-6 col-md-push-6">
							<h3 class="section-title">Fii curios! Explorează!</h3>
							<p>Știm că iubești Astronomia. Hai să vorbim!</p>
							<ul class="contact-info">
								<li><i class="icon-location-pin"></i>Bulevardul Lasc</li>
								<li><i class="icon-phone2"></i><a href="tel:+40 0744919371" </a>+ 40 0744919371</li>
								<li><i class="icon-mail"></i><a href="mailto:leucadavidtraian@gmail.com">leucadavidtraian@gmail.com</a></li>
								<li><i class="icon-globe2"></i><a href="https://www.google.com/maps/dir//Bulevardul+Lasc%C4%83r+Catargiu+21,+Bucure%C8%99ti/@44.4485196,26.0227264,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x40b1ff53841a2257:0x5e8f39a5afcf89aa!2m2!1d26.0928486!2d44.4486236">Observatorul Astronomic Amiral Vasile Urseanu</a></li>
							</ul>
						</div>
						<div class="col-md-6 col-md-pull-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="nume" class="form-control" placeholder="Nume">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="text" class="form-control" id="" cols="30" rows="7" placeholder="Mesaj"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" value="Transmite Mesaj" class="btn btn-primary">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<hr>
				<?php
					$sql ='SELECT * FROM `comentarii` ORDER BY `data` DESC;';
					$result = mysqli_query($conn, $sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							?>
							<div class="row">
								<div class="col-md-3">
									<h3><?=$row['nume']?></h3>
									<sm><?=$row['email']?><br><?=$row['data']?><sm>
								</div>
								<div class="col-md-9">
									<p><?=$row['text']?></p>
								</div>
							</div>
							<br>
							<hr>
							<?php
						}
					} else {
						echo "0 results";
					}
				?>
			</div>
		</div>
		<!-- END fh5co-contact -->
	</div>
<?php
include '_footer.php';
?>
