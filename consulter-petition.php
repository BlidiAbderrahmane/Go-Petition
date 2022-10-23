<?php 

session_start();


if (isset($_SESSION['mail'])) {
  include "db_conn.php";
  $mail = $_SESSION['mail'];
  $query = "select p.id, p.titre, p.date from petition p, membre m where p.mail=m.mail and m.type=(select type from membre where mail='$mail');";
  $result= mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Consulter les pétitions</title>
<!-- Bootstrap -->
<link href="css/bootstrap-4.3.1.css" rel="stylesheet">
<link rel="stylesheet" href="css/consulter-petition.css">
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
          <h4 class="text-right">Consulter les pétitions</h4>
        </div>
		<div class="mt-5 text-center">
			<table class="table table-bordered table-striped table-hover" id="myTable">
				<thead class="thead-dark">
					<tr style="cursor: pointer;">
						<th onclick="sortTable(0)">ID</th>
						<th onclick="sortTable(1)">Titre</th>
						<th onclick="sortTable(2)">Date de création</th>
					</tr>
				</thead>
				<tbody>
        <?php
            while ($row = mysqli_fetch_array($result)) {
        ?>
                  <tr>
                <td><a href='petition.php?id=<?php echo $row[0]?>'><?php echo $row[0]; ?></a></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
            </tr>
          <?php
                }

          ?>
				</tbody>
			</table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-3.3.1.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap-4.3.1.js"></script>
<script src="js/admin.js"></script>
</body>
</html>
<?php 

  }else{

      header("Location: login.php");

      exit();

  }

?>  