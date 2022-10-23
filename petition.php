<?php 

session_start();


if (isset($_SESSION['mail'])) {
	include "db_conn.php";
	$id=$_GET['id'];
	$participer=true; $sopposer=true;
	$query1="select p.titre, p.texte, p.date, m.nom, m.prenom, p.mail from petition p, membre m where p.mail=m.mail and p.id=$id";
	$result1=mysqli_query($conn,$query1);
	if ($row1=mysqli_fetch_array($result1)){
		$titre=$row1[0];
		$texte=$row1[1];
		$date=$row1[2];
		$nom=$row1[3];
		$prenom=$row1[4];
		$mail=$row1[5];
	}
	$query2="select m.nom, m.prenom, r.commentaire, r.mail from participation r, membre m, petition p where r.mail=m.mail and r.id=p.id and r.id=$id and vote='pour'";
	$result2=mysqli_query($conn,$query2);
	$dataRow2="";
	while ($row2=mysqli_fetch_array($result2)) {
		$dataRow2= $dataRow2."<tr><td>".$row2[0]."</td><td>".$row2[1]."</td><td>".$row2[2]."</td></tr>";
		if ($row2[3]==$_SESSION['mail']){
			$participer=false;
		}
	}
	$query3="select m.nom, m.prenom, r.commentaire, r.mail from participation r, membre m, petition p where r.mail=m.mail and r.id=p.id and r.id=$id and vote='contre'";
	$result3=mysqli_query($conn,$query3);
	$dataRow3="";
	while ($row3=mysqli_fetch_array($result3)) {
		$dataRow3= $dataRow3."<tr><td>".$row3[0]."</td><td>".$row3[1]."</td><td>".$row3[2]."</td></tr>";
		if ($row3[3]==$_SESSION['mail']){
			$sopposer=false;
		}
	}
	if ($mail==$_SESSION['mail'])
	{
		$participer=false; $sopposer=false;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editer une pétition</title>
<!-- Bootstrap -->
<link href="css/bootstrap-4.3.1.css" rel="stylesheet">
<link rel="stylesheet" href="css/petition.css">
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
	  <?php if (isset($_GET['error'])) { ?> 
			<p style="color:red; font-size: 24px"><?php echo $_GET['error']; ?></p>
		<?php } 
		?> 
		<?php if (isset($_GET['success'])) { ?> 
			<p style="color:green; font-size: 24px"><?php echo $_GET['success']; ?></p>
		<?php } 
		?>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-left">Pétition N°<?php echo $id;?></h4>
          <h6 class="text-right">Créée le <?php echo $date;?> par <?php echo $prenom." ".$nom?></h6>
        </div>
        <div class="mt-5 text-center">
          <h2><?php echo $titre;?></h2>
        </div>
        <div class="mt-5 text-left">
          <p style="font-size: 20px; margin-left: 100px; margin-right: 100px; margin-bottom: 70px; text-align: center;"><?php echo $texte;?></p>

		<div class="mt-5 text-center">
		<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-info" <?php if ($participer==false) {?> disabled <?php } ?> >Participer</button>
		<button onclick="document.getElementById('id02').style.display='block'" class="btn btn-info" <?php if ($sopposer==false) {?> disabled <?php } ?> >S'opposer</button>
		<div id="id01" class="modal">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<form class="modal-content" method="post" action="participer.php">
			<div class="container">
			<h1>Participation à la Pétition N°<?php echo $id;?></h1>
			<p style="font-size: 20px">Êtes vous sur de participer à cette pétition ?</p>
			<div class="clearfix">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<textarea class="form-control" rows="3" name="comment" placeholder="Commentaire (optionnel)" value=""></textarea>
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Annuler</button>
				<button type="submit" class="btn btn-primary" style="padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;opacity: 0.9;">Participer</button>
			</div>
			</div>
		</form>
		</div>
		<div id="id02" class="modal">
		<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		<form class="modal-content" method="post" action="sopposer.php">
			<div class="container">
			<h1>Opposition du Pétition N°<?php echo $id;?></h1>
			<p style="font-size: 20px">Êtes vous sur de désapprouver cette pétition ?</p>
			<div class="clearfix">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<textarea class="form-control" rows="3" name="comment" placeholder="Commentaire (optionnel)" value=""></textarea>
				<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Annuler</button>
				<button type="submit" class="btn btn-primary" style="padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;opacity: 0.9;">S'opposer</button>
			</div>
			</div>
		</form>
		</div>
		</div>
		
		
		</div>

      </div>
    </div>
  </div>
	<div class="row">
		<div class="col-6">
			<h5 class="text-center" style="margin-bottom: 20px">Utilisateurs POUR : <?php echo mysqli_num_rows($result2) ?></h5>
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Commentaire</th>
					</tr>
				</thead>
				<tbody>
				<?php echo $dataRow2;?>
				</tbody>
			</table>
		</div>
		<div class="col-6">
			<h5 class="text-center" style="margin-bottom: 20px">Utilisateurs CONTRE : <?php echo mysqli_num_rows($result3) ?></h5>
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Commentaire</th>
					</tr>
				</thead>
				<tbody>
				<?php echo $dataRow3;?>
				</tbody>
			</table>
		</div>
		
  </div>
  
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-3.3.1.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap-4.3.1.js"></script>
<script>
// Get the modal
var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  else if (event.target == modal2) {
	  modal2.style.display = "none";
  }
}
</script>
</body>
</html>
	<?php 

  }else{

      header("Location: login.php");

      exit();

  }

?>  