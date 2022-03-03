<?php
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$idUsuario = $_POST['idUsuario'];
				$nombre = $_POST['nombre'];
				$email = $_POST['correo'];
				$user = $_POST['usuario'];
				$clave = md5($_POST['clave']);
				$rol = $_POST['rol'];
				$query = mysqli_query($conection,"SELECT * FROM usuario 
													WHERE (usuario = '$user' AND idusuario != $idUsuario)
													OR (correo = '$email' AND idusuario != $idUsuario)");
				$result = mysqli_fetch_array($query);
				if($result > 0){
					$alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
				}else{
					if(empty($_POST['clave'])){
						$sql_update = mysqli_query($conection,"UPDATE usuario
								SET nombre = '$nombre', correo = '$email', usuario = '$user', rol = '$rol'
								WHERE idusuario = $idUsuario");
					}else{
						$sql_update = mysqli_query($conection,"UPDATE usuario
								SET nombre = '$nombre', correo = '$email', usuario = '$user', clave = '$clave', rol = '$rol'
								WHERE idusuario = $idUsuario");
					}
					if($sql_update){
						$alert = '<p class="msg_save">El usuario a sido actualizado existosamente.</p>';	
					}else{
						$alert = '<p class="msg_error">El usuario no ha sido actualizado.</p>';
					}
				}
			}
		}

		//MOSTRAR DATOS
		if(empty($_GET['id'])){
			header('location: lista_usuarios.php');
		}
		$iduser = $_GET['id'];
		$sql = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) AS idrol, (r.rol) AS rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario = $iduser");
		$result_sql = mysqli_num_rows($sql);
		if($result_sql == 0){
			header ('location: lista_usuarios.php');
		}else{
			$option = "";
			while ($data = mysqli_fetch_array($sql)){
				$iduser = $data['idusuario']; 
				$nombre = $data['nombre']; 
				$correo = $data['correo']; 
				$usuario = $data['usuario']; 
				$idrol = $data['idrol'];
				$rol = $data['rol'];  
				if($idrol == 1){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}else if($idrol == 2){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}else if($idrol == 3){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Actualizar Usuarios</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h3>Actuaizar Usuario</h3>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre;?>">
				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo;?>">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario;?>">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de Acceso">
				<label for="rol">Rol</label>
				<?php 
					$query_rol = mysqli_query($conection,"SELECT * FROM rol");
					$result_rol = mysqli_num_rows($query_rol);
				?>
				<select name = "rol" id = "rol" class="notItemOne">
					<?php
						echo $option;
						if($result_rol > 0){
							while($rol = mysqli_fetch_array($query_rol)){
					?>
						<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<input type="submit" value="Actualizar Usuario" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>