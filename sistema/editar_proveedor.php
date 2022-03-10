<?php
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$idproveedor = $_POST['id'];
				$proveedor = $_POST['proveedor'];
				$contacto = $_POST['contacto'];
				$telefono = $_POST['telefono'];
				$direccion = $_POST['direccion'];			
				$sql_update = mysqli_query($conection,"UPDATE proveedor
					SET proveedor = '$proveedor', contacto = '$contacto', telefono = '$telefono', direccion = '$direccion'
						WHERE codproveedor = $idproveedor");
				if($sql_update){
					$alert = '<p class="msg_save">El proveedor a sido actualizado existosamente.</p>';	
				}else{
					$alert = '<p class="msg_error">El proveedor no ha sido actualizado.</p>';
				}
			}
		}	
		//MOSTRAR DATOS
		if(empty($_REQUEST['id'])){
			header('location: lista_proveedor.php');
			mysqli_close($conection);
		}
		$idproveedor = $_REQUEST['id'];
		$sql = mysqli_query($conection,"SELECT * FROM proveedor WHERE codproveedor = $idproveedor and estatus = 1");
		mysqli_close($conection);
		$result_sql = mysqli_num_rows($sql);
		if($result_sql == 0){
			header ('location: lista_proveedor.php');
		}else{
			while ($data = mysqli_fetch_array($sql)){
				$idproveedor = $data['codproveedor']; 
				$proveedor = $data['proveedor']; 
				$contacto = $data['contacto']; 
				$telefono = $data['telefono']; 
				$direccion = $data['direccion']; 
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Actualizar Proveedor</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1><i class="far fa-edit"></i> Actualizar Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
				<label for="proveedor">Empresa</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre de la Empresa" value="<?php echo $proveedor; ?>">
				<label for="contacto">Nombre del Proveedor</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre del Proveedor" value="<?php echo $contacto; ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $telefono; ?>">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $direccion; ?>">
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Actualizar Proveedor</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>ds
