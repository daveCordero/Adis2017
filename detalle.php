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

$cedula   = stripslashes($_POST["_cedDet"]);
$razon    = stripslashes($_POST["_rznDet"]);
$preOrder = stripslashes($_POST["_preOrder"]); //echo 'preOrder: ' . $preOrder . '<br>';
if( $cedula != '' && $razon != '' && $preOrder != '' ){

?>

<!-- <script src="recursos/js/jquery-1.11.3.min.js"></script> -->
<script src="recursos/js/functions.js"></script>

	<script type="text/javascript">
	// alert(navigator.appCodeName);
	// var lineaProd = '<?php echo $productos; ?>';// alert('lineaProd: ' + lineaProd );

	$(document).ready(function(){

		if( navigator.onLine ){
			// alert('Online');
		} else {
			// alert('Offline');
			document.getElementById('conexionOff').style.display = 'block';
		}//fin if( navigator

	});//fin document ready
	</script>

	</head>
	<body onload="lineaIni()">

	<div id="header" class="disBlock posRel">
		<img class="logoLPT disBlock posAbs" src="recursos/img/logo_lpt_trans.png">
		<a id="backIni" href="javascript:void()" onclick="backIni()" class="disBlock posAbs"></a>
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

	</div><!-- #main -->

	<div class="disBlock floatNoneClearBoth" id="misProformas"> Pedido #<?php echo $preOrder; ?> </div>

	<?php 

	include 'dblpt.php';

	$idDetEnt  = mysql_query('SELECT ID FROM lpt_groupPreOrderDetailEntity WHERE PreOrderEntity = \''.$preOrder.'\'');// ORDER BY ID DESC
	$resDetEnt = mysql_fetch_row($idDetEnt);
	// echo 'resDetEnt: ' . $resDetEnt[0] . '<br>';
	$detailEnt = $resDetEnt[0];

	$colDetail = mysql_query('SELECT ID, AMOUNT, QUANTITY, GroupPreOrderDetailEntity, PRODUCT_DEFAULTCODE, DISCOUNT FROM lpt_preOrderDetail WHERE GroupPreOrderDetailEntity = \''.$detailEnt.'\' ');
	$numRows   = mysql_num_rows($colDetail); //echo 'numRows: ' . $numRows .  '<br>';
	if( $numRows >= 1 ){

	?>

	<table id="columna4">
		<thead>
		<tr>
			<th width="50%"> Producto </th>
			<th width="10%"> Cantidad </th>
			<th width="40%"> Monto    </th>
		</tr>
		</thead>
		<?php 

		while( $regDetail = mysql_fetch_array($colDetail) ){

			$codeProd = $regDetail['PRODUCT_DEFAULTCODE'];// echo 'codeProd: ' . $codeProd . '<br>';
			$nameProd = mysql_query('SELECT NAME, DEFAULTCODE FROM lpt_product WHERE DEFAULTCODE = \''.$codeProd.'\'');
			$resProd  = mysql_fetch_row($nameProd);// echo 'resProd: ' . $resProd[0] . '<br>';
			$prodName = $resProd[0];

			$descuento = $regDetail['AMOUNT'] * $regDetail['DISCOUNT'] / 100;
			$prodDescontado = $regDetail['AMOUNT'] - $descuento;

			echo '<tr> 
					<td>' . $prodName              . '</td> 
					<td>' . $regDetail['QUANTITY'] . '</td> 
					<td>' . $prodDescontado        . '</td> 
				  </tr>';

		}//fin while

		$usrQuery = mysql_query('SELECT id FROM lpt_users WHERE id_role = 3 AND name = \''.$cedula.'\' AND password = \''.$cedula.'\' LIMIT 1 ');
		$result   = mysql_fetch_row($usrQuery);
		$idUsr    = $result[0];

		?>
	</table><!-- #columna6 -->

	<form id="okForm" action="main.php" method="post">
		<input id="_cedPost" name="_cedPost" type="hidden" value="<?php echo $cedula; ?>">
		<input id="_pssPost" name="_pssPost" type="hidden" value="<?php echo $cedula; ?>">
		<input id="_rznPost" name="_rznPost" type="hidden" value="<?php echo $razon;  ?>">
		<input id="_idPost"  name="_idPost"  type="hidden" value="<?php echo $idUsr;  ?>">
	</form>

	<?php 

	} else {

	?>
	
	<div class="disBlock floatNoneClearBoth txAlignC">
		No existen productos en este pedido.
	</div><!-- /.disBlock -->

	<?php 

	}//fin if( $numRows

	?>

	<div id="footer" class="disBlock floatNoneClearBoth">
	    Asociación Libros para Todos
	</div><!-- /#footer -->

<?php 
} else {

?>

<script type="text/javascript">
location.href = 'index.php';
</script>

<?php 
}//fin if( $preOrder

?>

</body>
</html>