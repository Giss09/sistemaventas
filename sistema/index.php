<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<?php include "include/scripts.php"; ?>
	<title>Sistema de Ventas</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<h1><i class="fa fa-paw" aria-hidden="true"></i> Bienvenid@ al Sistema Love & Pets</h1>
		<br>
		<br>
		<div>	
		<span class="user"><?php echo $_SESSION['nombre'];?></span>
		</div>

	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>
