<?php  
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
				if(empty($_POST['codproducto'])){
					header("location: lista_producto.php");
					mysqli_close($conection);
				}
				$codproducto = $_POST['codproducto'];
				//$query_delete = mysqli_query($conection,"DELETE FROM cliente WHERE idusuario = $idusuario");
				$query_delete = mysqli_query($conection, "UPDATE producto SET estatus = 0 WHERE codproducto = $codproducto");
				mysqli_close($conection);
				if($query_delete){
					header("location: lista_producto.php");
				}else {
					echo "Error al eliminar el Producto";
				}
			}
		
			if(empty($_REQUEST['id'])){
				header("location: lista_producto.php");
				mysqli_close($conection);
			}else{
				$codproducto = $_REQUEST['id'];
				$query = mysqli_query($conection,"SELECT *	FROM producto WHERE codproducto = $codproducto");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);
				if ($result > 0) {
					while($data = mysqli_fetch_array($query)){
						$producto = $data['producto'];
					}
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
	<title>Eliminar Producto</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="data_delete"> 
			<i class="fa-solid fa-trash fa-7x" color= "#88B0A4" aria-hidden="true"></i>
			
			<br>
			<br>	
			<h2>¿Esta seguro de eliminar el producto</h2>
			<br>
			<p>Nombre del Producto: <span><?php echo $producto; ?></span></p>
			<form method="POST" action="">
				<input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">
				<button type="submit" class="btn_ok"><i class="fa fa-trash" aria-hidden="true"></i> Aceptar</button>
				<a class="btn_cancel" href="lista_producto.php"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a> 
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>