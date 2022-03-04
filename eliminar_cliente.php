<?php  
session_start();
if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 4){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
				if(empty($_POST['idcliente'])){
					header("location: lista_cliente.php");
					mysqli_close($conection);
				}
				$idcliente = $_POST['idcliente'];
				//$query_delete = mysqli_query($conection,"DELETE FROM cliente WHERE idusuario = $idusuario");
				$query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $idcliente");
				mysqli_close($conection);
				if($query_delete){
					header("location: lista_cliente.php");
				}else {
					echo "Error al eliminar el cliente";
				}
			}
		
			if(empty($_REQUEST['id'])){
				header("location: lista_cliente.php");
				mysqli_close($conection);
			}else{
				$idcliente = $_REQUEST['id'];
				$query = mysqli_query($conection,"SELECT *	FROM cliente WHERE idcliente = $idcliente");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);
				if ($result > 0) {
					while($data = mysqli_fetch_array($query)){
						$cedula = $data['cedula'];
						$nombre = $data['nombre'];
					}
				}else{
					header("location: lista_cliente.php");
				}
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Eliminar Cliente</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="data_delete"> 
			<h2>¿Esta seguro de eliminar al cliente</h2>
			<br>
			<p>Cédula: <span><?php echo $cedula; ?></span></p>
			<p>Nombre del Cliente: <span><?php echo $nombre; ?></span></p>
			<form method="POST" action="">
				<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
				<a href="lista_cliente.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>