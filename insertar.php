<?php 

include 'inSqlProtect.php';

/* muestra todas las variables POST
foreach( $_POST as $name => $value ) {
	echo 'campo: ' . $name . ' / valor: ' . $value . '<br>';
}//fin foreach */

$patron    = '/^[1-9]{1}[0-9]{8,9}+$/'; 
$regExId   = '/^[0-9]{1,4}+$/'; 
// $regExDate = '/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}+$/'; 

$count     = stripslashes($_POST["_count"]); //total líneas agregadas en proforma

$cedula    = stripslashes($_POST["_cedula"]);
$razon     = stripslashes($_POST["_razon"]);

$idUsr     = stripslashes($_POST["_idUsr"]);
// $fecha     = stripslashes($_POST["_fecha"]);
$fecha     = date('Y-m-d') . ' ' . date('h:m:s');

$discount  = 0;// descuento general, en caso de Adis viene por línea
$status    = 'ING';// Ericka o Hanie siempre deben aprobar
$sub       = 0;// echo 'sub: ' . $sub . '<br>';
$total     = 0;
$type      = 'V';
$descrip   = 'Venta App Adis';// permitirá filtrar proformas creadas desde App Adis
$cantItems = 0;// conteo cantidad total de productos
$detalle   = '';// guardará líneas de cada producto para enviar por correo

if( preg_match($patron, $cedula) && preg_match($regExId, $idUsr) && $razon != '' && $count != '' ){ // && preg_match($regExDate, $fecha)

	if( $count > 0 ){

		for( $x = 1; $x <= $count; $x++ ){ 
			if( $_POST['mont' . $x] != '' &&  $_POST['cant' . $x] != '' &&  $_POST['neto' . $x] != '' ){ 

				$monto = $_POST['mont' . $x];
				// echo 'monto: ' . $monto . '<br>';
				$montoNum = (int)$monto;
				$total = $total + $montoNum;
				// echo 'total: ' . $total . '<br>';

				$neto = $_POST['neto' . $x];
				// echo 'neto: ' . $neto . '<br>';
				$netoNum = (int)$neto;
				$sub = $sub + $netoNum;
				// echo 'sub: ' . $sub . '<br>';
				
				$cant = $_POST['cant' . $x];
				// echo 'cant: ' . $cant . ' / ';
				$cantNum = (int)$cant;
				$cantItems = $cantItems + $cantNum;
				// echo 'cantItems: ' . $cantItems . '<br>'; 

			}//fin if( $_POST
		}//fin for( $x
		// echo 'sub: ' . $sub . '<br>';

	}//fin if( $count

	include 'dblpt.php';
	$cusQuery = mysql_query('SELECT IDCUSTOMER, IDNUMBER FROM lpt_customer WHERE IDNUMBER = \''.$cedula.'\' '); //LIMIT 1 
	$result   = mysql_fetch_row($cusQuery);
	
	if( $result[0] ){

		// echo $result['IDCUSTOMER'] . '<br>';
		$customer = $result[0];
		$queryPro = 'INSERT INTO lpt_preOrder (CUSTOMERID, date, DISCOUNT, STATUS, SUBTOTAL, TOTAL, TYPE, USERID) 
					 VALUES (\''.$customer.'\',\''.$fecha.'\',\''.$discount.'\',\''.$status.'\',\''.$sub.'\',\''.$total.'\',\''.$type.'\',\''.$idUsr.'\')';
		// echo 'queryPro: ' . $queryPro . '<br>'; 
		mysql_query($queryPro) or die (mysql_error());

		$idOrder  = mysql_query('SELECT ID, CUSTOMERID FROM lpt_preOrder WHERE CUSTOMERID = \''.$customer.'\' ORDER BY ID DESC LIMIT 1');
		$resOrder = mysql_fetch_row($idOrder);
		// echo 'resOrder: ' . $resOrder[0] . '<br>';

		if( $resOrder[0] ){
			$preOrderId = $resOrder[0];

			// ID, CANTPRODUCTS, DESCRIPTION, TOTALAMOUNT, PreOrderEntity, SCHOOL_IDSCHOOL
			$queryEnt = 'INSERT INTO lpt_groupPreOrderDetailEntity (CANTPRODUCTS, DESCRIPTION, TOTALAMOUNT, PreOrderEntity) 
						 VALUES (\''.$cantItems.'\',\''.$descrip.'\',\''.$sub.'\',\''.$preOrderId.'\')';// ,\''.$idSchool.'\'
			// echo 'queryEnt: ' . $queryEnt . '<br>'; 
			mysql_query($queryEnt) or die (mysql_error());

			for( $x = 1; $x <= $count; $x++ ){ 

				if( $_POST['prod' . $x] != '' &&  $_POST['cant' . $x] != '' && $_POST['mont' . $x] != '' ){ 
					$prodDet = $_POST['prod' . $x]; //echo 'prodDet: ' . $prodDet . '<br>';
					$cantDet = $_POST['cant' . $x];
					$montDet = $_POST['mont' . $x];
					$descDet = $_POST['desc' . $x]; //echo 'descDet: ' . $descDet . '<br>';
					$netoDet = $_POST['neto' . $x]; //echo 'netoDet: ' . $netoDet . '<br>';

					$detalle .= '<tr> <td>' . $cantDet . '</td> <td>' . $prodDet . '</td> <td>' . $descDet . '% </td> </tr>';

					$idProd  = mysql_query('SELECT DEFAULTCODE FROM lpt_product WHERE NAME = \''.$prodDet.'\' ORDER BY DEFAULTCODE DESC LIMIT 1');
					$resProd = mysql_fetch_row($idProd);
					// echo 'resProd: ' . $resProd[0] . '<br>';
					$defaultCode = $resProd[0];

					$idDetEnt  = mysql_query('SELECT ID FROM lpt_groupPreOrderDetailEntity WHERE PreOrderEntity = \''.$preOrderId.'\' ORDER BY ID DESC LIMIT 1');
					$resDetEnt = mysql_fetch_row($idDetEnt);
					// echo 'resDetEnt: ' . $resDetEnt[0] . '<br>';
					$detailEnt = $resDetEnt[0];

					// ID, AMOUNT, QUANTITY, GroupPreOrderDetailEntity, PRODUCT_DEFAULTCODE, DISCOUNT
					/* en lpt_preOrderDetail: 
					   valor en AMOUNT es el monto del producto sin descuento 
					   valor en DISCOUNT es el % de descuento por línea */
					$queryDet = 'INSERT INTO lpt_preOrderDetail (AMOUNT, QUANTITY, GroupPreOrderDetailEntity, PRODUCT_DEFAULTCODE, DISCOUNT) 
								 VALUES (\''.$netoDet.'\',\''.$cantDet.'\',\''.$detailEnt.'\',\''.$defaultCode.'\',\''.$descDet.'\')';
					// echo 'queryDet: ' . $queryDet . '<br>'; 
					mysql_query($queryDet) or die (mysql_error());

				}//fin if( $_POST
			}//fin for( $x

			$detalle = str_replace("2017", "", "$detalle");
			$detalle = str_replace("LPT", "", "$detalle");
			$detalle = str_replace("-", "", "$detalle");

			////////////////////////////////////// correo Agente LPT
			$correoLTP = "dvdhec@gmail.com";//pruebas
			// $correoLTP = "luis.segura@librosparatodoscr.com";
			$sendTo    = $correoLTP; //Destinatario del Mensaje
			$subject   = "Nuevo pedido: " . $razon;
			
			$headers   = "From: appAdis@librosparatodoscr.com" . "\r\n";
			// $headers  .= "Cc: jcorrales@librosparatodoscr.com, juancarlos.alvarez@librosparatodoscr.com, hcordero@librosparatodoscr.com, nancy.salas@librosparatodoscr.com, david.herrera@librosparatodoscr.com" . "\r\n";
			// $headers  .= "Cc: hcordero@librosparatodoscr.com" . "\r\n";
			$headers  .= "Reply-To: david.herrera@librosparatodoscr.com" . "\r\n";
			$headers  .= "Content-type: text/html";
			
			$message   = "<html> <head> </head> <body> Ha sido solicitado un pedido con los siguientes datos
<br><br><br><br>

<table width='450' border='0' cellpadding='0' cellspacing='0'>

<tr>
<td width='100' align='center'> <strong> Cédula </strong> </td>
<td width='250' align='center'> <strong> Agente </strong> </td>
<td width='150' align='center'> <strong> Fecha </strong> </td>
</tr>

<tr>
<td align='center'>" . $cedula . "</td>
<td align='center'>" . $razon . "</td>
<td align='center'>" . $fecha . "</td>
</tr>

<tr>
<td colspan='3' align='center'> <br> <strong> Detalle del pedido </strong> </td>
</tr>

<tr>
<td> Cantidad </td>
<td> Producto </td>
<td> Descuento </td>
</tr>
" . $detalle . "
<tr>
<td colspan='3' align='center'> <br> <strong> Monto total: </strong>" . $total . " colones </td>
</tr>

</table>


<br><br><br><br><br>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
<br>
Enviado desde la aplicación de Adis de Libros para Todos. 
</body> </html>";
			mail($sendTo, $subject, $message, $headers);
			////////////////////////////////////// fin correo Agente LPT

			?>

			<form id="okForm" action="main.php" method="post">
				<input id="_cedPost" name="_cedPost" type="hidden" value="<?php echo $cedula; ?>">
				<input id="_pssPost" name="_pssPost" type="hidden" value="<?php echo $cedula; ?>">
				<input id="_rznPost" name="_rznPost" type="hidden" value="<?php echo $razon; ?>">
				<input id="_idPost"  name="_idPost"  type="hidden" value="<?php echo $idUsr; ?>">
			</form>
			<script type="text/javascript">
				document.getElementById("okForm").submit();
			</script>

			<?php 

		} else {
			echo 'El id de Proforma no existe.'; 
		}//fin if( $resOrder

	} else {
		echo 'El usuario no existe.'; 
	}//fin if( $result

} else {
	
	?>

	<form id="backForm" action="index.php" method="post">
		<input id="_cedPost" name="_cedPost" type="hidden" value="">
		<input id="_pssPost" name="_pssPost" type="hidden" value="">
	</form>
	<script type="text/javascript">
		document.getElementById("backForm").submit();
	</script>

	<?php 

}//fin if( preg_match 

?>