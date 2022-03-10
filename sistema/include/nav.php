<nav>
	<ul>
		<li><a href="index.php"><i class="fa-solid fa-bone"></i> Inicio</a></li>
		<?php
			if($_SESSION['rol'] == 1){
		?>
			<li class="principal">
				<a href="#"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
				<ul>
					<li><a href="registro_usuario.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo Usuario</a></li>
					<li><a href="lista_usuarios.php"><i class="fa fa-users" aria-hidden="true"></i> Lista de Usuarios</a></li>
				</ul>
			</li>
		<?php
			}
		?>
			<li class="principal">
				<a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> Clientes</a>
				<ul>
					<li><a href="registro_cliente.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo Cliente</a></li>
					<li><a href="lista_cliente.php"><i class="fa fa-users" aria-hidden="true"></i> Lista de Clientes</a></li>
				</ul>
			</li>
		<?php
			if($_SESSION['rol'] == 1){
		?>
			<li class="principal">
				<a href="#"><i class="fa fa-address-book" aria-hidden="true"></i> Proveedores</a>
				<ul>
					<li><a href="registro_proveedor.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo Proveedor</a></li>
					<li><a href="lista_proveedor.php"><i class="fa fa-users" aria-hidden="true"></i> Lista de Proveedores</a></li>
				</ul>
			</li>
		<?php
			}
		?>
			</li>
			<li class="principal">
				<a href="#">Materia Prima</a>
				<ul>
					<li><a href="#">Nueva Materia Prima</a></li>
					<li><a href="#">Lista de Materia Prima</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Productos</a>
				<ul>
					<?php
			if($_SESSION['rol'] == 1){
		?>
					<li><a href="registro_producto.php"><i class="fa-solid fa-cat"></i> Nuevo Producto</a></li>
					<?php
			}
		?>
					<li><a href="lista_producto.php"><i class="fa-solid fa-dog"></i>  Lista de Productos</a></li>
					
				</ul>
			</li>
			<li class="principal">
				<a href="#">Pedidos</a>
				<ul>
					<li><a href="#">Nuevo Pedido</a></li>
					<li><a href="#">Lista de Pedidos</a></li>
				</ul>
			</li>
			<li class="principal">
				<a href="#">Facturas</a>
				<ul>
					<li><a href="#">Nuevo Factura</a></li>
					<li><a href="#">Facturas</a></li>
				</ul>
			</li>
	</ul>
</nav>
