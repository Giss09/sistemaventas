<?php
	session_start();
	include "../conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include "include/scripts.php"; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nueva Venta</title>
</head>
<body>
	<?php include "include/header.php"; ?>
	<section id="container">
		<div class="title_page">
			<h1>Nueva Venta</h1>
		</div>
		<div class="datos_cliente">
			<div class="action_cliente">
				<h1>Datos del Cliente</h1>
				<a href="#" class="btn_new btn_new_cliente">Nuevo Cliente</a>	
			</div>
			<form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
				<input type="hidden" name="action" value="addCliente">
				<input type="hidden" id="idcliente" name="idcliente" value="" required>
				<div class="wd30">
					<label>Cédula</label>
					<input type="text" name="cedula_cliente" id="cedula_cliente">
				</div>
				<div class="wd30">
					<label>Nombre del CLiente</label>
					<input type="text" name="nom_cliente" id="nom_cliente" disabled required>
				</div>
				<div class="wd30">
					<label>Teléfono</label>
					<input type="text" name="tel_cliente" id="tel_cliente" disabled required>
				</div>
				<div class="wd100">
					<label>Dirección</label>
					<input type="text" name="dir_cliente" id="dir_cliente" disabled required>
				</div>
				<div id="div_registro_cliente" class="w100">
					<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar</button>
				</div>
			</form>
		</div>
		<div class="datos_venta">
			<h4>Datos de Venta</h4>
			<div class="datos">
				<div class="wd50">
					<label>Vendedor</label>
					<p>Gissella Urgilés</p>
				</div>
				<div class="wd50">
					<label>Acciones</label>
					<div id="acciones_venta">
						<a href="#" class="btn_ok textcenter" id="btn_anular_venta">Anular</a>
						<a href="#" class="btn_new textcenter" id="btn_facturar_venta">Procesar</a>
					</div>
				</div>
			</div>
		</div>
		<table class="tbl_venta">
			<thead>
				<tr>
					<th width="100px">Codigo</th>
					<th>Descripción</th>
					<th>Talla</th>
					<th>Existencia</th>
					<th width="100px">Cantidad</th>
					<th class="textright">Precio</th>	
					<th class="textright">Precio Total</th>	
					<th>Acción</th>	
				</tr>
				<tr>
					<td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
					<td><input type="text" name="txt_nom_producto" id="txt_nom_producto"></td>
					<td id="txt_talla">-</td>
					<td id="txt_existencia">-</td>
					<td><input type="text" name="txt_cant_productp" id="txt_cant_producto" value="0" min="1" disabled></td>
					<td id="txt_precio" class="textright">0,00</td>
					<td id="txt_precio_total" class="textright">0,00</td>
					<td><a href="#" id="add_product_venta" class="link_agregar">Agregar</a></td>
				</tr>
				<tr>
					<th>Código</th>
					<th colspan="1">Descripción</th>
					<th colspan="2">Talla</th>
					<th>Cantidad</th>
					<th class="textright">Precio</th>
					<th class="textright">Precio Total</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody class="detalle_venta">
				<tr>
					<td>1</td>
					<td colspan="1">Pijama de Cerdito</td>
					<td colspan="2">Talla</td>
					<td class="textcenter">1</td>
					<td class="textright">100,00</td>
					<td class="textright">100,00</td>
					<td class="">
						<a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle(1);"></a>
					</td>
				</tr>
				<tr>
					<td>1</td>
					<td colspan="1">Pijama de Unicornio</td>
					<td colspan="2" >Talla</td>
					<td class="textcenter">1</td>
					<td class="textright">100,00</td>
					<td class="textright">100,00</td>
					<td class="">
						<a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle(1);"></a>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6" class="textright">Subtotal</td>
					<td class="textright">88,88</td>
				</tr>
				<tr>
					<td colspan="6" class="textright">Descuento</td>
					<td class="textright">5%</td>
				</tr>
				<tr>
					<td colspan="6" class="textright">Subtotal - Descuento</td>
					<td class="textright">88,88</td>
				</tr>
				<tr>
					<td colspan="6" class="textright">IVA 12%</td>
					<td class="textright">100</td>
				</tr>
				<tr>
					<td colspan="6" class="textright">TOTAL</td>
					<td class="textright">100,00</td>
				</tr>
			</tfoot>
		</table>
	</section>
	<?php include "include/footer.php"; ?>
</body>
</html>