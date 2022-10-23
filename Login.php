<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Go Petition</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap-4.3.1.css" rel="stylesheet">
	<link href="css/login.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="logotrans whitebg.ico">
	
  </head>
  <body>
  	<!-- body code goes here -->
    <div class="row">
      <div class="col-xl-6">
	  <a href="login.php">
		  <img src="logotrans.png" id="logoindex" class="img-fluid" alt="Placeholder image" height=auto width="350">
	  </a>		 
	  <p style="font-family: 'Times New Roman', Times, serif; font-size: 20px" id="presentation">Go Petition est une plateforme de pétitions en ligne.  Il regroupe les utilisateurs des universités, et permet à tout étudiant, enseignant ou personnel administratif de lancer une pétition sur un sujet de son choix, afin de collecter le plus grand nombre de signatures possibles pour attirer l’attention sur une demande particulière.</p>
	  </div>
      <div class="col-xl-4 offset-xl-1">
        <h1 id="signin">Login</h1>
		<?php if (isset($_GET['error'])) { ?> 
			<p style="color:red; font-size: 20px"><?php echo $_GET['error']; ?></p>
		<?php } 
		?> 
		<?php if (isset($_GET['success'])) { ?> 
			<p style="color:green; font-size: 20px"><?php echo $_GET['success']; ?></p>
			<?php } 
		?>

        <form name="formCV" method="post" action="loginp.php">
			
			

		    <div class="form-group">
		      <label for="exampleInputEmail1">Email address</label>
		      <input type="email" class="form-control" name="mail" id="exampleInputEmail1" placeholder="Enter email">
	      </div>
	      <div class="form-group">
		      <label for="exampleInputPassword1">Password</label>
		      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">&nbsp;
          </div>
			
			<button type="submit" class="btn btn-primary" >Login</button>
			</form>
			
			<button type="button" id="myBtn" class="btn btn-link">Not having an account? Sign Up</button>
			
			<div id="myModal" class="modal">
			  <!-- Modal content -->
			  <div class="modal-content">
				<span class="close">&times;</span>
				<h1 id="signup">Sign Up</h1>
		<form name="formCV" method="post" action="signup.php" enctype="multipart/form-data">
					<div class="form-group">
		      			<input type="text" name="nom" class="form-control" id="exampleInputLastname" placeholder="Nom">
	     			</div>
					<div class="form-group">
		      			<input type="text" name="prenom"class="form-control" id="exampleInputFirstname" placeholder="Prénom">
	     			</div>
					
					<div class="form-group">
		      			<input type="email" name="mail" class="form-control" id="exampleInputEmail1" placeholder="Email">
	     			</div>
					<div class="form-group">
		      			<input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Mot de passe">
	     			</div>
		 			 <div class="form-group">
		      			<input type="password" name="vpassword" class="form-control" id="exampleInputCPassword" placeholder="Confirmez Mot de passe">
	     			</div>
				  <table id="type" width="200">
							   <tr>
								 <td><label>
								   <input type="radio" name="RadioGroup1" value="Enseignant" id="RadioGroup1_0">
								   Enseignant(e)</label></td>
					</tr>
							   <tr>
								 <td><label>
								   <input type="radio" name="RadioGroup1" value="Etudiant" id="RadioGroup1_1">
								   Étudiant(e)</label></td>
					</tr>
							   <tr>
								 <td><label>
								   <input type="radio" name="RadioGroup1" value="Personnel Administratif" id="RadioGroup1_2">
								   Personnel Administratif</label></td>
					</tr>
				  </table>
				  <label for="avatar">Choisir une Photo de profil:</label>
				  <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"><br><br>				
				  <button type="submit" value="submit" class="btn btn-primary" >SignUp</button>
        </form>
			  </div>
			</div>
			
	    
      </div>
		
    </div>
  	
	  
	<script>
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
		btn.onclick = function() {
		  modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
			modal.style.display = "none";
		  }
		}
	</script>
	  
	  
	<script src="js/jquery-3.3.1.min.js"></script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/popper.min.js"></script> 
  <script src="js/bootstrap-4.3.1.js"></script>
  </body>
</html>