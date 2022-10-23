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
<title>Créer une Pétition</title>
<!-- Bootstrap -->
<link href="css/bootstrap-4.3.1.css" rel="stylesheet">
<link rel="stylesheet" href="css/creer-petition.css">
<link rel="icon" type="image/x-icon" href="logotrans whitebg.ico">
</head>
<body>
<!-- body code goes here -->
<nav class="navbar navbar-expand-lg navbar-light bg-light"><a href="profil.php"><img src="logo1tran.png" class="img-fluid" alt="Placeholder image" height="auto" width="300" ></a> <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent1">
    <ul class="navbar-nav mr-auto" style="margin-left: 50px;  gap:50px">
      <li class="nav-item"> <a class="nav-link" href="profil.php">Profil</a> </li>
      <li class="nav-item"> <a class="nav-link" href="creer-petition.php">Créer une pétition</a> </li>
      <li class="nav-item"> <a class="nav-link" href="consulter-petition.php">Consulter les pétitions</a> </li>
    </ul>
    <button type="button" class="btn btn-info" style="margin-right: 20px" onclick="location.href='logout.php'">Déconnecter</button>
  </div>
</nav>
<div class="container rounded bg-white mt-5 mb-5">
  <div class="row">
    <div class="border-right col-md-12">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-right">Créer une pétition</h4>
          
        </div>
        <?php if (isset($_GET['error'])) { ?>
        <p style="color:red;font-size: 20px"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
        <p style="color:green; font-size: 20px"><?php echo $_GET['success']; ?></p>
        <?php } ?>

		  <form name="createPetition" method="post" action="insert-petition.php">
        <div class="row mt-2">
          <div class="col-md-12">
            <label class="labels">Titre</label>
            <input type="text" class="form-control" name="titre" placeholder="Entrer le titre du pétition" value="">
          </div>

        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <label class="labels">Description</label>
            <textarea class="form-control" rows="5" name="description" placeholder="Expliquer votre pétition içi" value=""></textarea>
          </div>
          
          
        </div>
        <div class="mt-5 text-center">
          <button class="btn btn-info " type="submit">Créer Pétition</button>
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
<?php 

  }else{

      header("Location: login.php");

      exit();

  }

?>  