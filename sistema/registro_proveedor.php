<?php
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']) ){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$proveedor = $_POST['proveedor'];
				$contacto = $_POST['contacto'];
				$telefono	 = $_POST['telefono'];
				$direccion = $_POST['direccion'];
				$usuario_id = $_SESSION['idUser'];
				$query_insert = mysqli_query($conection,"INSERT INTO proveedor(proveedor, contacto, telefono, direccion, usuario_id) VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");
					if($query_insert){
						$alert = '<p class="msg_save">El Proveedor a sido creado existosamente.</p>';	
						header("location: lista_proveedor.php");
					}else{
						$alert = '<p class="msg_error">El proveedor no fue creado.</p>';
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
	<title>Registro de Proveedores</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Registro Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<label for="proveedor">Empresa</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre de la Empresa">
				<label for="contacto">Nombre del Proveedor</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre del Proveedor">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección">
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Guardar Proveedor</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>
