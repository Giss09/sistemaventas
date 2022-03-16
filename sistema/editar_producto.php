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
			if(empty($_POST['categoria']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <=0 || empty($_POST['talla']) || empty($_POST['existencia']) ||  $_POST['existencia'] <=0 || empty($_POST['foto_actual']) ||  empty($_POST['foto_remove']) ){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$codproducto = $_POST['id'];
				$categoria = $_POST['categoria'];
				$producto = $_POST['producto'];
				$precio	 = $_POST['precio'];
				$talla	 = $_POST['talla'];
                                $existencia = $_POST['existencia'];
				$imgProducto = $_POST['foto_actual'];
				$imgRemove = $_POST['foto_remove'];
				$usuario_id = $_SESSION['idUser'];
				/*FOTOGRAFIA*/
				$foto = $_FILES['foto'];
				$nombre_foto = $foto['name'];
				$type = $foto['type'];
				$url_temp = $foto['tmp_name'];
				$upd = '';
				/*imagen si no se pone imagen para materia prima */
				//$imgProducto = 'img_producto.jpg';
				if($nombre_foto != ''){
					$destino = 'img/imagenesProductos/';
					$img_nombre = 'img_'.md5(date('d-m-Y H:m:s')); /*nombre aleatorio con fecha y hora del ingreso*/
					$imgProducto = $img_nombre.'.jpg';
					$src = $destino.$imgProducto;
				}else{
					if($_POST['foto_actual'] != $_POST['foto_remove']){
						$imgProducto = 'img_producto.jpg';
					}
				}
				/*almacenar datos en la tabla materia prima*/
				$query_update = mysqli_query($conection,"UPDATE producto
														 SET producto = '$producto',
														     categoria = $categoria,
														     precio = $precio,
														     talla = '$talla',
                                                                                                                     existencia = '$existencia',
														     foto = '$imgProducto'
														     WHERE codproducto = $codproducto");
														
					if($query_update){
						if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.jpg')) || ($_POST['foto_actual'] != $_POST['foto_remove'])){
							unlink('img/imagenesProductos/'.$_POST['foto_actual']);
						}
						if($nombre_foto != ''){
							move_uploaded_file($url_temp, $src); /*almacenando la ruta temporal del archivo y lo va a mover a la nueva ruta */
						}
						$alert = '<p class="msg_save">El producto se actualizo existosamente.</p>';	
						header("location: lista_producto.php");
					}else{
						$alert = '<p class="msg_error">El producto no fue actualizado.</p>';
				}
			}
		}
	
	//validar producto
	if(empty($_REQUEST['id'])){
		header("location: lista_producto.php");
	}else{
		$id_producto = $_REQUEST['id'];
		if(!is_numeric($id_producto)){
			header("location: lista_producto.php");
		}
		$query_producto = mysqli_query($conection, "SELECT p.codproducto, p.producto, p.precio, p.talla, p.existencia, p.foto, 
													c.id_categoria, c.descripcion
													FROM producto p 
													INNER JOIN categoria c
													ON p.categoria = c.id_categoria
													WHERE p.codproducto = $id_producto  AND p.estatus = 1");
		$result_producto = mysqli_num_rows($query_producto);
		$foto = '';
		$classRemove = 'notBlock';

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);
			if($data_producto['foto'] != 'img_producto.jpg'){
				$classRemove = '';
				$foto = '<img id="img" src="img/imagenesProductos/'.$data_producto['foto'].'" alt="Producto">';
			}
			//print_r($data_producto);
		}else{
			header("location: lista_producto.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Editar Producto</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">   
			<h1><i class="fa-solid fa-dog"></i> Editar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST" enctype="multipart/form-data"> <!-- indicamos que nuestro formulario va a tener la capacidad de  adjuntar archivos en este caso imagenes de la materia prima-->
				<input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
				<input type="hidden" name="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
				<input type="hidden" name="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">

				<?php
					$query_categoria = mysqli_query($conection, "SELECT id_categoria, descripcion FROM categoria WHERE estatus = 1 ORDER BY descripcion ASC");
					$result_categoria = mysqli_num_rows($query_categoria);
					mysqli_close($conection);
				?>
				<label for="categoria">Categoria</label>
				<select name="categoria" id="categoria" class="notItemOne">
					<option value="<?php echo $data_producto['id_categoria']; ?>" selected><?php echo $data_producto['descripcion']; ?></option>
					<?php
						if($result_categoria > 0){
							while($categoria = mysqli_fetch_array($query_categoria))
						{
					?>
						<option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['descripcion']; ?></option>
					<?php			
							}
						}
					?>
				</select>

				<label for="producto">Descripción del Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto" value="<?php echo $data_producto['producto']; ?>">
				<label for="precio">Precio</label>
				<input type="float" name="precio" id="precio" placeholder="Precio del Producto" value="<?php echo $data_producto['precio']; ?>">
				<label for="talla">Talla</label>
				<input type="text" name="talla" id="talla" placeholder="Talla de la Prenda" value="<?php echo $data_producto['talla']; ?>">
				<label for="existencia">Cantidad</label>
				<input type="float" name="existencia" id="existencia" placeholder="Cantidad del Producto" value="<?php echo $data_producto['existencia']; ?>">
                                <div class="photo">
					<label for="foto">Foto</label>
				        <div class="prevPhoto">
				        <span class="delPhoto <?php echo $classRemove; ?>">X</span>
				        <label for="foto"></label>
				        <?php echo $foto; ?>
				        </div>
				        <div class="upimg">
				        <input type="file" name="foto" id="foto">
				        </div>
				        <div id="form_alert"></div>
				</div>
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Actualizar Producto</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>
