<?php 
		include	"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<?php 
			$busqueda = $_REQUEST['busqueda'];
			if(empty[$busqueda]){
				header("location: lista_usuarios.php");
			}
		?>
		<h1>Lista de Usuarios</h1>
			<a href="registro_usuario.php" class="btn_new">Crear Usuario</a>
			<form class="buscar_usuario.php" method="GET" class="form_search">
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
					<input type="submit" value="Buscar" class="btn_search">
			</form>
			<table>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Usuario</th>
					<th>Rol</th>
					<th>Acciones</th>
				</tr>
					<?php 
					//paginador
					$rol = "":
					if($busqueda == 'Administrador'){
						$rol = "OR rol LIKE '%1%'";
					}else if($busqueda == 'Diseñador@'){
						$rol = "OR rol LIKE '%2%'";
					}else if($busqueda == 'Vendedor'){
						$rol = "OR rol LIKE '%3%'";
					}
							$sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM usuario 
												WHERE 
												(
												idusuario LIKE '%$busqueda%' OR
												nombre LIKE '%$busqueda%' OR
												correo LIKE '%$busqueda%' OR
												usuario LIKE '%$busqueda%' OR
												$rol)
												AND	estatus = 1");
							$result_register = mysqli_fetch_array($sql_register);
							$total_registro = $result_register['total_registro'];
							$por_pagina = 9;
							if(empty($_GET['pagina'])){
								$pagina = 1;
							}else{
								$pagina = $_GET['pagina'];
							}
								$desde = ($pagina - 1) * $por_pagina;
								$total_paginas = ceil($total_registro / $por_pagina); //CEIL SIRVE PARA REDONDEAR
									$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE
										( u.idusuario LIKE '%$busqueda%' OR
										  u.nombre LIKE '%$busqueda%' OR
										  u.correo LIKE '%$busqueda%' OR
										  u.usuario LIKE '%$busqueda%' OR
										  r.rol LIKE '$busqueda')
 										AND	 estatus = 1 ORDER BY idusuario ASC LIMIT $desde, $por_pagina");
											$result = mysqli_num_rows($query);
												if($result	> 0){
													while (	$data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $data["idusuario"] ?></td>
									<td><?php echo $data["nombre"] ?></td>
									<td><?php echo $data["correo"] ?></td>
									<td><?php echo $data["usuario"] ?></td>
									<td><?php echo $data["rol"] ?></td>
									<td>
										<a class = "link_edit" href="editar_usuario.php?id=<?php echo $data["idusuario"] ?>">Editar</a>
										<?php
											if($data["idusuario"] != 1 ){
											
										?>
										|
										<a class = "link_delete" href="eliminar_usuario.php?id=<?php echo $data["idusuario"] ?>">Eliminar</a>
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
								<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
								<li><a href="?pagina=<?php echo $pagina - 1; ?>"><<</a></li>
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
								<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
								<li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
								<?php
									}
								?>
							</ul>
						</div>
					</section>
<?php include "include/footer.php"; ?>
</body>
</html>