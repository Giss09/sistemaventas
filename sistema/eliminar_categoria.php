<?php  
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
				if(empty($_POST['id_categoria'])){
					header("location: lista_categoria.php");
					mysqli_close($conection);
				}
				$id_categoria = $_POST['id_categoria'];
				//$query_delete = mysqli_query($conection,"DELETE FROM cliente WHERE idusuario = $idusuario");
				$query_delete = mysqli_query($conection, "UPDATE categoria SET estatus = 0 WHERE id_categoria = $id_categoria");
				mysqli_close($conection);
				if($query_delete){
					header("location: lista_categoria.php");
				}else {
					echo "Error al eliminar la categoria";
				}
			}
		
			if(empty($_REQUEST['id'])){
				header("location: lista_categoria.php");
				mysqli_close($conection);
			}else{
				$id_categoria = $_REQUEST['id'];
				$query = mysqli_query($conection,"SELECT *	FROM categoria WHERE id_categoria = $id_categoria");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);
				if ($result > 0) {
					while($data = mysqli_fetch_array($query)){
						$descripcion = $data['descripcion'];
					}
				}else{
					header("location: lista_categoria.php");
				}
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Eliminar Categoria</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="data_delete"> 
			<i class="fa fa-user-times fa-7x" color= "#88B0A4" aria-hidden="true"></i>
			<br>
			<br>	
			<h2>¿Esta seguro de eliminar la categoria</h2>
			<br>
			<p>Nombre de la Categoria: <span><?php echo $descripcion; ?></span></p>
			<form method="POST" action="">
				<input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
				<button type="submit" class="btn_ok"><i class="fa fa-trash" aria-hidden="true"></i> Aceptar</button>
				<a class="btn_cancel" href="lista_categoria.php"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a> 
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>