<?php 
session_start();
		include	"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Lista de Categorias</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<h1><i class="fa fa-heartbeat" aria-hidden="true"></i> Lista de Categorias</h1>
			<a href="registro_categoria.php" class="btn_new"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear Categoria</a>
			<form action="buscar_categoria.php" method="get" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
					<button type="submit" class="btn_search"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
				<table>
					<tr>
						<th>ID</th>
						<th>Descripción</th>
						
						<th>Agregado</th>
						<th>Acciones</th>
					</tr>
						<?php 
						//paginador
							$sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM categoria WHERE estatus = 1");
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
									$query = mysqli_query($conection, "SELECT * FROM  categoria 
										 WHERE estatus = 1 ORDER BY id_categoria ASC LIMIT $desde, $por_pagina");
										mysqli_close($conection);
											$result = mysqli_num_rows($query);
												if($result	> 0){
													while (	$data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $data["id_categoria"] ?></td>
									<td><?php echo $data["descripcion"] ?></td>
									
									<td><?php echo $data["date_add"] ?></td>
									<td>
										<?php
											if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 4){
											
										?>
										<a class = "link_edit" href="editar_categoria.php?id=<?php echo $data["id_categoria"] ?>"><i class="far fa-edit"></i> Editar</a>
										
										|
										<a class = "link_delete" href="eliminar_categoria.php?id=<?php echo $data["id_categoria"] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>	
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