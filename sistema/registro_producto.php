<?php
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
			//print_r($_FILES);
			//exit;
			$alert = "";
			if(empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <=0 || empty($_POST['talla']) || empty($_POST['existencia']) ||  $_POST['existencia'] <=0 ){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$categoria = $_POST['categoria'];
				$producto = $_POST['producto'];
				$precio	 = $_POST['precio'];
				$talla	 = $_POST['talla'];
				$existencia = $_POST['existencia'];
				$usuario_id = $_SESSION['idUser'];
				/*FOTOGRAFIA*/
				$foto = $_FILES['foto'];
				$nombre_foto = $foto['name'];
				$type = $foto['type'];
				$url_temp = $foto['tmp_name'];
				/*imagen si no se pone imagen para materia prima */
				$imgProducto = 'img_producto.jpg';
				if($nombre_foto != ''){
					$destino = 'img/imagenesProductos/';
					$img_nombre = 'img_'.md5(date('d-m-Y H:m:s')); /*nombre aleatorio con fecha y hora del ingreso*/
					$imgProducto = $img_nombre.'.jpg';
					$src = $destino.$imgProducto;
				}
				/*almacenar datos en la tabla materia prima*/
				$query_insert = mysqli_query($conection,"INSERT INTO producto(categoria, producto, precio, talla, existencia, usuario_id, foto) VALUES('$categoria','$producto','$precio','$talla','$existencia','$usuario_id', '$imgProducto')");
					if($query_insert){
						if($nombre_foto != ''){
							move_uploaded_file($url_temp, $src); /*almacenando la ruta temporal del archivo y lo va a mover a la nueva ruta */
						}
						$alert = '<p class="msg_save">El producto se creo existosamente.</p>';	
						header("location: lista_producto.php");
					}else{
						$alert = '<p class="msg_error">El producto no fue creado.</p>';
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Registro Producto</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">   
			<h1><i class="fa-solid fa-dog"></i> Registro Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST" enctype="multipart/form-data"> <!-- indicamos que nuestro formulario va a tener la capacidad de  adjuntar archivos en este caso imagenes de la materia prima-->
				<?php
					$query_categoria = mysqli_query($conection, "SELECT id_categoria, descripcion FROM categoria WHERE estatus = 1 ORDER BY descripcion ASC");
					$result_categoria = mysqli_num_rows($query_categoria);
					mysqli_close($conection);
				?>
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria">
					<?php
						if($result_categoria > 0){
							while($categoria = mysqli_fetch_array($query_categoria)){
					?>
						<option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['descripcion']; ?></option>
					<?php			
							}
						}
					?>
				</select>

				<label for="producto">Descripción del Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto">
				<label for="precio">Precio</label>
				<input type="float" name="precio" id="precio" placeholder="Precio del Producto">
				<label for="talla">Talla</label>
				<input type="text" name="talla" id="talla" placeholder="Talla de la Prenda">
				<label for="existencia">Cantidad</label>
				<input type="float" name="existencia" id="existencia" placeholder="Cantidad del Producto">
				<div class="photo">
					<label for="foto">Foto</label>
				        <div class="prevPhoto">
				        <span class="delPhoto notBlock">X</span>
				        <label for="foto"></label>
				        </div>
				        <div class="upimg">
				        <input type="file" name="foto" id="foto">
				        </div>
				        <div id="form_alert"></div>
				</div>
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Guardar Producto</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>