<?php 

session_start();
if (isset($_SESSION['mailadmin'])) {
	include "db_conn.php";
	$query = "select p.id, p.titre, p.date from petition p, membre m where p.mail=m.mail;";
	$result= mysqli_query($conn,$query);
	
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrateur</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap-4.3.1.css" rel="stylesheet">
	<link rel="stylesheet" href="css/admin.css">
	<link rel="icon" type="image/x-icon" href="logotrans whitebg.ico">
	
	</head>
	<body>
	<!-- body code goes here -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light"><a href="admin.php"><img src="logo1tran.png" class="img-fluid" alt="Placeholder image" height="auto" width="300" ></a> <a class="navbar-brand" href="#"></a>
	<div class="collapse navbar-collapse" id="navbarSupportedContent1">
      <ul class="navbar-nav mr-auto" style="margin-left: 50px;  gap:50px">
        <li class="nav-item"> <a class="nav-link" href="admin.php">Consulter les pétitions</a> </li>
      </ul>
      <button type="button" class="btn btn-info" style="margin-right: 20px" onclick="location.href='logout.php'">Déconnecter</button>
      
    </div>
	</nav>
	<div class="container rounded bg-white mt-5 mb-5">
	<div class="row">
		<div class="border-right col-md-12">
		<div class="p-3 py-5">
		
		<?php if (isset($_GET['success'])) { ?> 
			<p style="color:green; font-size: 24px"><?php echo $_GET['success']; ?></p>
		<?php } 
		?> 
			<div class="d-flex justify-content-between align-items-center mb-3">
			
			<h4 class="text-right">Consulter les pétitions</h4>
			</div>
			<input type="text" class="form-control" id="filterInput" onkeyup="filtrer()" placeholder="Filtrer par titre ...">
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
				  <td><a href='petition-admin.php?id=<?php echo $row[0]?>'><?php echo $row[0]; ?></a></td>
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