<?php 
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
		include	"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Lista de Proveedores</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<h1><i class="fa fa-address-book" aria-hidden="true"></i> Lista de Proveedores</h1>
			<a href="registro_proveedor.php" class="btn_new"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear Proveedor</a>
			<form action="buscar_proveedor.php" method="get" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
					<button type="submit" class="btn_search"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
				<table>
					<tr>
						<th>ID</th>
						<th>Empresa</th>
						<th>Nombre del Proveedor</th>
						<th>Teléfono</th>
						<th>Dirección</th>
						<th>Acciones</th>
					</tr>
						<?php 
						//paginador
							$sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM proveedor WHERE estatus = 1");
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
									$query = mysqli_query($conection, "SELECT * FROM  proveedor 
										 WHERE estatus = 1 ORDER BY codproveedor ASC LIMIT $desde, $por_pagina");
										mysqli_close($conection);
											$result = mysqli_num_rows($query);
												if($result	> 0){
													while (	$data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $data["codproveedor"] ?></td>
									<td><?php echo $data["proveedor"] ?></td>
									<td><?php echo $data["contacto"] ?></td>
									<td><?php echo $data["telefono"] ?></td>
									<td><?php echo $data["direccion"] ?></td>
									<td>
										<a class = "link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"] ?>"><i class="far fa-edit"></i> Editar</a>
										|
										<a class = "link_delete" href="eliminar_proveedor.php?id=<?php echo $data["codproveedor"] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>	
									</td>
								</tr>		
								<?php
													}
												}
								?>	
					</table>
						<div class="paginador">
							<ul>
								<?php 
									if($pagina != 1){
								?>	
								<li><a href="?pagina=<?php echo 1; ?>"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>
								<li><a href="?pagina=<?php echo $pagina - 1; ?>"><i class="fa fa-backward" aria-hidden="true"></i></a></li>
								<?php
									}
									for ($i=1; $i <= $total_paginas; $i++) { 
										if($i == $pagina){
											echo '<li class="pageSelected">'.$i.'</li>';
										}else{
											echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
										}
									}
									if($pagina != $total_paginas){
								?>
								<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fa fa-forward" aria-hidden="true"></i></a></li>
								<li><a href="?pagina=<?php echo $total_paginas; ?>"><i class="fa fa-step-forward" aria-hidden="true"></i></a></li>
								<?php
									}
								?>
							</ul>
						</div>
					</section>
<?php include "include/footer.php"; ?>
</body>
</html>
