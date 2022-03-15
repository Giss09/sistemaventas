<nav>
	<ul>
		<li><a href="index.php"><i class="fa-solid fa-bone"></i> Inicio</a></li>
		<?php
			if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3){
		?>
		<li class="principal">
				<a href="lista_usuarios.php"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
		</li>

			<li class="principal">
				<a href="lista_cliente.php"><i class="fa fa-user-circle" aria-hidden="true"></i> Clientes</a>
			</li>
                <?php
			}
		?>
			<li class="principal">
				<a href="lista_categoria.php"><i class="fa-solid fa-cat"></i> Categorias</a>
			</li>
			<li class="principal">
				<a href="lista_producto.php"><i class="fa-solid fa-dog"></i> Productos</a>
			</li>
                <?php
			if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3){
		?>
			<li class="principal">
				<a href="nueva_venta.php"><i class="fa-solid fa-fish"></i> Facturas</a>
			</li>
                <?php
			}
		?>
	</ul>
</nav>