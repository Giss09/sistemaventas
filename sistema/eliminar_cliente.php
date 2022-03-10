<?php  
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
				if(empty($_POST['idproveedor'])){
					header("location: lista_proveedor.php");
					mysqli_close($conection);
				}
				$idproveedor = $_POST['idproveedor'];
				//$query_delete = mysqli_query($conection,"DELETE FROM cliente WHERE idusuario = $idusuario");
				$query_delete = mysqli_query($conection, "UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor");
				mysqli_close($conection);
				if($query_delete){
					header("location: lista_proveedor.php");
				}else {
					echo "Error al eliminar el proveedor";
				}
			}
		
			if(empty($_REQUEST['id'])){
				header("location: lista_proveedor.php");
				mysqli_close($conection);
			}else{
				$idproveedor = $_REQUEST['id'];
				$query = mysqli_query($conection,"SELECT *	FROM proveedor WHERE codproveedor = $idproveedor");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);
				if ($result > 0) {
					while($data = mysqli_fetch_array($query)){
						$proveedor = $data['proveedor'];
					}
				}else{
					header("location: lista_proveedor.php");
				}
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Eliminar Proveedor</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="data_delete"> 
			<i class="fa fa-user-times fa-7x" color= "#88B0A4" aria-hidden="true"></i>
			<br>
			<br>	
			<h2>¿Esta seguro de eliminar al Proveedor</h2>
			<br>
			<p>Nombre del Proveedor: <span><?php echo $proveedor; ?></span></p>
			<form method="POST" action="">
				<input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<button type="submit" class="btn_cancel"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
				<button type="submit" class="btn_ok"><i class="fa fa-trash" aria-hidden="true"></i> Aceptar</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>
