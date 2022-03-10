<?php 
session_start();
		include	"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Lista de Clientes</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<?php 
			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda)){
				header("location: lista_cliente.php");
				mysqli_close($conection);
			}
		?>
		<h1><i class="fa fa-users fa-lg" aria-hidden="true"></i> Lista de Clientes</h1>
			<a href="registro_cliente.php" class="btn_new"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear Cliente</a>
			<form action="buscar_cliente.php" method="GET" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
					<button type="submit" class="btn_search"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			<table>
				<tr>
					<th>ID</th>
					<th>Cédula</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Dirección</th>
					<th>Acciones</th>
				</tr>
					<?php 
					//paginador
							$sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM cliente 
												WHERE 
											(	idcliente LIKE '%$busqueda%' OR
												cedula LIKE '%$busqueda%' OR
												nombre LIKE '%$busqueda%' OR
												telefono LIKE '%$busqueda%' OR
												direccion LIKE '%$busqueda%' 
												)
												AND	estatus = 1");
							$result_register = mysqli_fetch_array($sql_register);
							$total_registro = $result_register['total_registro'];
							$por_pagina = 5;
							if(empty($_GET['pagina'])){
								$pagina = 1;
							}else{
								$pagina = $_GET['pagina'];
							}
								$desde = ($pagina - 1) * $por_pagina;
								$total_paginas = ceil($total_registro / $por_pagina); //CEIL SIRVE PARA REDONDEAR
									$query = mysqli_query($conection, "SELECT * FROM cliente WHERE
										( idcliente LIKE '%$busqueda%' OR
										  cedula LIKE '%$busqueda%' OR
										  nombre LIKE '%$busqueda%' OR
										  telefono LIKE '%$busqueda%' OR
										 direccion LIKE '%$busqueda%' )
 										AND	 estatus = 1 ORDER BY idcliente ASC LIMIT $desde, $por_pagina");
									mysqli_close($conection);
											$result = mysqli_num_rows($query);
												if($result	> 0){
													while (	$data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $data["idcliente"] ?></td>
									<td><?php echo $data["cedula"] ?></td>
									<td><?php echo $data["nombre"] ?></td>
									<td><?php echo $data["telefono"] ?></td>									
									<td><?php echo $data["direccion"] ?></td>
									<td>
										<a class = "link_edit" href="editar_cliente.php?id=<?php echo $data["idcliente"] ?>"><i class="far fa-edit"></i> Editar</a>
										<?php
											if($_SESSION['rol'] == 1){
										?>
										|
										<a class = "link_delete" href="eliminar_cliente.php?id=<?php echo $data["idcliente"] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
										<?php
											}
										?>
									</td>
								</tr>		
								<?php
													}
												}
								?>	
					</table>
					<?php
						if($total_registro != 0){
					?>
						<div class="paginador">
							<ul>
								<?php 
									if($pagina != 1){
								?>	
								<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>
								<li><a href="?pagina=<?php echo $pagina - 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
								<?php
									}
									for ($i=1; $i <= $total_paginas; $i++) { 
										if($i == $pagina){
											echo '<li class="pageSelected">'.$i.'</li>';
										}else{
											echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
										}
									}
									if($pagina != $total_paginas){
								?>
								<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
								<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fa fa-step-forward" aria-hidden="true"></i></a></a></li>
								<?php
									}

								?>
							</ul>
						</div>
					<?php
					} 
					?>
					</section>
<?php include "include/footer.php"; ?>
</body>
</html>
