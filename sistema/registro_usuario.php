<?php
session_start();
if($_SESSION['rol'] != 1){
	header("location: ./");
}
	include "../conexion.php";
		if(!empty($_POST)){
			$alert = "";
			if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])){
				$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
			}else{
				$nombre = $_POST['nombre'];
				$email = $_POST['correo'];
				$user = $_POST['usuario'];
				$clave = md5($_POST['clave']);
				$rol = $_POST['rol'];
				$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
				$result = mysqli_fetch_array($query);
				if($result > 0){
					$alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
				}else{
					$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre, correo, usuario, clave, rol)  VALUES('$nombre','$email','$user','$clave','$rol')");
					if($query_insert){
						$alert = '<p class="msg_save">El usuario a sido creado existosamente.</p>';	
						header("location: lista_usuarios.php");
					}else{
						$alert = '<p class="msg_error">El usuario no fue creado.</p>';
					}
				}
			}
		}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "include/scripts.php"; ?>
	<title>Registro de Usuarios</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="form_register">
			<h1><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Registro de Usuario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			<form action="" method="POST">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
				<label for="correo">Correo Electronico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo Electronico">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" placeholder="Usuario">
				<label for="clave">Clave</label>
				<input type="password" name="clave" id="clave" placeholder="Clave de Acceso">
				<label for="rol">Rol</label>
				<?php 
					$query_rol = mysqli_query($conection,"SELECT * FROM rol");
					$result_rol = mysqli_num_rows($query_rol);
				?>
				<select name = "rol" id = "rol">
					<?php
						if($result_rol > 0){
							while($rol = mysqli_fetch_array($query_rol)){
					?>
						<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
					<?php
							}
						}
					?>
				</select>				
				<button type="submit" class="btn_save"><i class="far fa-save"></i> Crear Usuario</button>
			</form>
		</div>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>
