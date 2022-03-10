<?php 
		if(empty($_SESSION['active'])){
					header('location: ../');
		}
?>
<header>
		<div class="header">
			<p style="text-align" ><i class="fa fa-paw" aria-hidden="true"></i> Sistema de Facturación Love & Pets</p>
			<div class="optionsBar">
				<p>Quito, <?php echo fechaC();?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['nombre'].'-'.$_SESSION['rol'];?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"; ?>
	</header>
