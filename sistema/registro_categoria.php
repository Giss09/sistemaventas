<?php
session_start();
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['descripcion'])){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$descripcion = $_POST['descripcion'];
				$usuario_id = $_SESSION['idUser'];
					$query_insert = mysqli_query($conection,"INSERT INTO categoria(descripcion, usuario_id) VALUES('$descripcion','$usuario_id')");
					if($query_insert){
						$alert = '<p class="msg_save">La Categoria a sido creada existosamente.</p>';	
						header("location: lista_categoria.php");
					}else{
						$alert = '<p class="msg_error">La Categoria no fue creada.</p>';
				}
			}
			mysqli_close($conection);
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Registro de Categoria</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<i class="fa-solid fa-fish fa-3x"></i>
			<h1>Registro de Categoria</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripción de la Categoria">
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Crear Categoria</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>