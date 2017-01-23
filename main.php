<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8" />
<title>Libros para Todos</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="icon" href="recursos/img/favicon.ico" type="image/ico" sizes="48x48">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="author" content="Libros para Todos: David Herrera Cordero">
<meta name="keywords" content="Libros para Todos,Agentes Distribuidores Independientes,ADIs">
<meta name="description" content="Aplicación para Agentes Distribuidores Independientes de Libros para Todos.">

<link rel="stylesheet" type="text/css" href="recursos/fonts/fonts.css">
<link rel="stylesheet" type="text/css" href="recursos/css/global.css">

<?php 

include 'inSqlProtect.php';

$cedula = stripslashes($_POST["_cedPost"]);
$clave  = stripslashes($_POST["_pssPost"]);
$razon  = stripslashes($_POST["_rznPost"]);
$idUsr  = stripslashes($_POST["_idPost"]);

if( $cedula != '' && $clave != '' && $razon != '' && $idUsr != '' ){

	include 'dblpt.php';
	$productos = '';
	$colPro = mysql_query('SELECT NAME FROM lpt_product WHERE name LIKE "%2017%" AND name NOT LIKE "%Muestra%" AND name NOT LIKE "%PAQUETE%" ');
	while( $regPro = mysql_fetch_array($colPro) ){ 
		$productos .= '<option>' . $regPro['NAME']  . '</option>';
	}//fin while 

?>

	<script src="recursos/js/jquery-1.11.3.min.js"></script>
	<script src="recursos/js/functions.js"></script>

	<script type="text/javascript">
	// alert(navigator.appCodeName);
	var lineaProd = '<?php echo $productos; ?>';// alert('lineaProd: ' + lineaProd );

	$(document).ready(function(){

		if( navigator.onLine ){
			// alert('Online');
		} else {
			// alert('Offline');
			document.getElementById('conexionOff').style.display = 'block';
		}//fin if( navigator

		document.getElementById('_fecha').value = fechaHoy;

	});//fin document ready
	</script>

	</head>
	<body onload="lineaIni()">

	<div id="cortina"> <br><br><br><br><br><br><br><br> Un momento por favor </div><!-- /#cortina -->

	<div id="header" class="disBlock posRel">
		<img class="logoLPT disBlock posAbs" src="recursos/img/logo_lpt_trans.png">
		<a id="nuevaPro" class="disBlock posAbs" href="javascript:void()" onclick="nuevaProforma()"></a>
	</div><!-- #header -->

	<div id="main" class="disBlock floatNoneClearBoth">

		<div id="conexionOff" class="disNone floatNoneClearBoth">
			<img class="logoLPT disBlock posAbs" src="recursos/img/logo_lpt_trans.png">
			Esta aplicación requiere conexión a internet. 
			<br>
			Regrese a la aplicación cuando se encuentre conectado nuevamente. 
		</div><!-- #conexionOff -->

		<table class="columna2">
			<tr>
				<td class="columna50Per"> <input type="text" value="<?php echo $cedula; ?>" disabled> </td>
				<td class="columna50Per"> <input type="text" value="<?php echo $razon; ?>"  disabled> </td>
			</tr>
		</table><!-- .columna2 -->

		<form id="addProforma" class="disBlock tran200" method="post">
			<div class="disBlock floatNoneClearBoth" id="newProforma"> Nuevo Pedido </div> <!-- #newProforma -->
			<table class="columna2">
				<tr>
					<td class="columna50Per"> <label for="_fecha">Fecha</label> </td>
					<td class="columna50Per"> <input id="_fecha" name="_fecha" type="text" disabled> </td>
				</tr>
			</table><!-- .columna2 -->

			<table id="columna4">
			</table><!-- #columna4 -->

			<table class="columna2">
				<tr>
					<td class="columna50Per"> Total </td>
					<td class="columna50Per"> <input id="proTotal" name="proTotal" type="text" placeholder="0" disabled> </td> <!-- valor asignado x js -->
				</tr>
			</table><!-- .columna2 -->

			<div id="enviar" class="disBlock floatNoneClearBoth"> 
				<a id="btnEnviar" onclick="validaProforma()" class="disBlock floatNoneClearBoth marginAuto btnSubmit">Enviar Pedido</a>
			</div><!-- #enviar -->

			<input id="_cedula" name="_cedula" type="hidden" value="<?php echo $cedula; ?>" >
			<input id="_razon"  name="_razon"  type="hidden" value="<?php echo $razon;  ?>" >
			<input id="_idUsr"  name="_idUsr"  type="hidden" value="<?php echo $idUsr;  ?>" >
			<input id="_count"  name="_count"  type="hidden" value="" > <!-- valor asignado x js -->
		</form>

	</div><!-- #main -->

	<div class="disBlock floatNoneClearBoth" id="misProformas"> Mis Pedidos </div> <!-- #misProformas -->

	<?php 

	$colCliente = mysql_query('SELECT IDCUSTOMER FROM lpt_customer WHERE IDNUMBER = \''.$cedula.'\' ');
	$resCliente = mysql_fetch_row($colCliente);
	if( $resCliente[0] ){
		$customer = $resCliente[0];
		// echo 'customer: ' . $customer . '<br>';
	}//fin if( $resCliente
	
	$colOrder = mysql_query('SELECT ID, date, TOTAL, STATUS FROM lpt_preOrder WHERE CUSTOMERID = \''.$customer.'\' AND STATUS !="ANU" AND date LIKE "%2017%" ORDER BY ID DESC ');
	$numRows   = mysql_num_rows($colOrder); //echo 'numRows: ' . $numRows .  '<br>';
	if( $numRows >= 1 ){

	?>

	<table id="columna6" class="disBlock posRel floatNoneClearBoth marginAuto">
		<thead>
		<tr>
			<th width="6%" > id       </th>
			<th width="21%"> Fecha    </th>
			<th width="22%"> Total ¢  </th>
			<th width="15%"> Estado   </th>
			<th width="11%"> Ver      </th>
			<!-- <th width="11%"> Eliminar </th> -->
		</tr>
		</thead>
		<?php 

		while( $regOrder = mysql_fetch_array($colOrder) ){
			$totalPre = $regOrder['TOTAL'];
			$totalFormat = number_format( $totalPre, 2, "." , "," );

			echo '<tr> 
					<td>' . $regOrder['ID']                  . '</td> 
					<td>' . substr($regOrder['date'], 0, 10) . '</td> 
					<td>' . $totalFormat                     . '</td> 
					<td>';

			if( $regOrder['STATUS'] == "ING" ){
				echo 'Ingresado';
			} else if( $regOrder['STATUS'] == "PPA" ){
				echo 'Por Aprobar';
			} else if( $regOrder['STATUS'] == "APR" ){
				echo 'Aprobado';
			} else if( $regOrder['STATUS'] == "REC" ){
				echo 'Rechazado';
			}//fin if( $regOrder['STATUS

			echo '  </td> 
					<td> <form method="post" action="detalle.php"> 
							<input type="hidden" name="_cedDet"   id="_cedDet"   value="' . $cedula         . '"> 
							<input type="hidden" name="_rznDet"   id="_cedDet"   value="' . $razon          . '"> 
							<input type="hidden" name="_preOrder" id="_preOrder" value="' . $regOrder['ID'] . '"> 
							<button class="disBlock floatNoneClearBoth marginAuto verPro"></button> 
						 </form> 
					</td>
				  </tr>';
		}//fin while 

		?>
	</table><!-- #columna6 -->

	<div class="txAlignC pad10">
		Si su pedido <strong>Aprobado</strong> demora más de 48 horas laborales, por favor comuníquese con su Asesor de ventas.
	</div><!-- /.txAlignC -->

	<?php 

	} else {

	?>

	<div class="disBlock floatNoneClearBoth txAlignC">
		Aún no tiene pedidos. Realice un pedido en el botón "+".
	</div><!-- /.disBlock -->

	<?php 

	}//fin if( $numRows

	?>

	<div id="footer" class="disBlock floatNoneClearBoth">
		<strong>Asociación Libros para Todos</strong>
		<br><br>
		Teléfono gratuito: <a href="tel:800-800-1000">800-800-1000</a>
		<br>
		Whatsapp (texto): 7300-6685
	</div><!-- /#footer -->

<?php 
} else {

?>

<script type="text/javascript">
location.href = 'index.php';
</script>

<?php 
}//fin if( $cedula

?>

</body>
</html>