<?php 

session_start();


if (isset($_SESSION['mail'])) {
?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
  <link rel="stylesheet" href="css/profil.css">
  <link rel="icon" type="image/x-icon" href="logotrans whitebg.ico">  
</head>
  <body>
  <!-- body code goes here -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light"><img src="logo1tran.png" class="img-fluid" alt="Placeholder image" height="auto" width="300" > <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
      <ul class="navbar-nav mr-auto" style="margin-left: 50px;  gap:50px">
        <li class="nav-item"> <a class="nav-link" href="#">Profil</a> </li>
        <li class="nav-item"> <a class="nav-link" href="creer-petition.php">Créer une pétition</a> </li>
        <li class="nav-item"> <a class="nav-link" href="consulter-petition.php">Consulter les pétitions</a> </li>
      </ul>
      <button type="button" class="btn btn-info" style="margin-right: 20px" onclick="location.href='logout.php'">Déconnecter</button>
      
    </div>
  </nav>
  <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
      <div class="border-right col-md-4">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
          <?php
            if (!isset($_SESSION['imgName'])) {
              echo '<img class="rounded-circle mt-5" width="150px" src="images/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.webp" alt="Photo didentité">';
            }
            else {
              include "db_conn_img.php";
              $mail=$_SESSION['mail'];
              $result = $db->query("SELECT imgBin from membre where mail='$mail'");
              if ($row = $result->fetch_assoc()) {
                ?>
                <img class="rounded-circle mt-5" width="150px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['imgBin']); ?>" /> 
                <?php
              }
              
              }
          ?>  
          <span class="font-weight-bold"><?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?> </span><span class="text-black-50"><?php echo $_SESSION['mail'] ?></span><span class="font-weight-bold"><?php echo $_SESSION['type'] ?></span>
        </div>
            
      
      
      </div>
      <div class="border-right col-md-8">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right">Votre Profil</h4>
          </div>
          <?php if (isset($_GET['error'])) { ?> 
			      <p style="color:red; font-size: 20px"><?php echo $_GET['error']; ?></p>
		        <?php } 
          ?> 
          <?php if (isset($_GET['success'])) { ?> 
            <p style="color:green; font-size: 20px"><?php echo $_GET['success']; ?></p>
            <?php } 
		      ?>

        <form name="FormProfil" method="post" action="profilp.php">
           
          <div class="row mt-2">
            <div class="col-md-5">
              <label class="labels">Nom</label>
              <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $_SESSION['nom'] ?>" >
            </div>
            <div class="col-md-5 offset-md-1">
              <label class="labels">Prénom</label>
              <input type="text" class="form-control" name="prenom" value="<?php echo $_SESSION['prenom'] ?>" placeholder="Prénom">
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-10">
              <label class="labels">Email</label>
              <input type="email" class="form-control" name="mail" placeholder="Entrer votre email" value="<?php echo $_SESSION['mail'] ?>">
            </div>
            <div class="col-md-10">
              <label class="labels">Mot de Passe</label>
              <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe" value="<?php echo $_SESSION['password'] ?>">
            </div>
            <div class="col-md-10">
              <label class="labels">Vérifier votre mot de passe</label>
              <input type="password" class="form-control" name="vpassword" placeholder="Vérifier votre mot de passe" value="<?php echo $_SESSION['password'] ?>">
            </div>
            
          </div>
          <div class="mt-5 text-center">
            <button class="btn btn-info" value="submit" type="submit" >Enregistrer profil</button>
          </div>
        </form>  
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  <script src="js/jquery-3.3.1.min.js"></script> 

  <!-- Include all compiled plugins (below), or include individual files as needed --> 
  <script src="js/popper.min.js"></script> 
  <script src="js/bootstrap-4.3.1.js"></script>
  </body>
  </html>
}
<?php 

  }else{

      header("Location: login.php");

      exit();

  }

?>  