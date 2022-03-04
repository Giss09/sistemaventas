<?php
session_start();
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']) ){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$cedula = $_POST['cedula'];
				$nombre = $_POST['nombre'];
				$telefono = $_POST['telefono'];
				$direccion = $_POST['direccion'];
				$usuario_id = $_SESSION['idUser'];
				$result = 0;
				if(is_numeric($cedula)){
					$query = mysqli_query($conection,"SELECT * FROM cliente WHERE cedula = '$cedula' ");
					$result = mysqli_fetch_array($query);
				}
				if($result > 0){
					$alert = '<p class="msg_error">El número de cedula ya existe.</p>';
				}else{
					$query_insert = mysqli_query($conection,"INSERT INTO cliente(cedula, nombre, telefono, direccion, usuario_id) VALUES('$cedula','$nombre','$telefono','$direccion','$usuario_id')");
					if($query_insert){
						$alert = '<p class="msg_save">El cliente a sido creado existosamente.</p>';	
						header("location: lista_cliente.php");
					}else{
						$alert = '<p class="msg_error">El cliente no fue creado.</p>';
					}
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
	<title>Registro de Clientes</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h3>Registro de Clientes</h3>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<label for="cedula">Cédula</label>
				<input type="number" name="cedula" id="cedula" placeholder="Cédula de Ciudadania">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección">
							
				<input type="submit" value="Guardar Cliente" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>