<?php
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['descripcion'])){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$id_categoria = $_POST['id'];
				$descripcion = $_POST['descripcion'];	
				$sql_update = mysqli_query($conection,"UPDATE categoria
					SET descripcion = '$descripcion'
						WHERE id_categoria = $id_categoria");
				if($sql_update){
					$alert = '<p class="msg_save">La Categoria a sido actualizada existosamente.</p>';	
				}else{
					$alert = '<p class="msg_error">La Categoria no ha sido actualizada.</p>';
				}
			}
		}	
		//MOSTRAR DATOS
		if(empty($_REQUEST['id'])){
			header('location: lista_categoria.php');
			mysqli_close($conection);
		}
		$id_categoria = $_REQUEST['id'];
		$sql = mysqli_query($conection,"SELECT * FROM categoria WHERE id_categoria = $id_categoria and estatus = 1");
		mysqli_close($conection);
		$result_sql = mysqli_num_rows($sql);
		if($result_sql == 0){
			header ('location: lista_categoria.php');
		}else{
			while ($data = mysqli_fetch_array($sql)){
				$id_categoria = $data['id_categoria']; 
				$descripcion = $data['descripcion']; 
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
			<h1><i class="far fa-edit"></i> Actualizar Categoria</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="hidden" name="id" value="<?php echo $id_categoria; ?>">
				<label for="descripcion">Descripciónn</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Nombre de la Categoria" value="<?php echo $descripcion; ?>">
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Actualizar Categoria</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>ds