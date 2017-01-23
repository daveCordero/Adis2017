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

<script src="recursos/js/jquery-1.11.3.min.js"></script>

<?php 

$cedula = stripslashes($_POST["_cedPost"]);
$clave  = stripslashes($_POST["_pssPost"]);

?>

<script type="text/javascript">
// alert(navigator.appCodeName);

var cedPost = '<?php echo $cedula; ?>'; //cedula rechazada
var pssPost = '<?php echo $clave; ?>';  //pass rechazado

function identificar(){

	var regCed = /^[1-9]{1}[0-9]{8,9}$/; //cedula fisica 9, juridica 10
    var cedLog = document.getElementById('_cedLog').value;
    var pssLog = document.getElementById('_pssLog').value;
    // alert('cedLog: ' + cedLog + ' | pssLog: ' + pssLog);

    if( cedLog == '' && pssLog == '' ){
        alert('Ingrese los datos solicitados');
        document.getElementById('errorCed').style.display = 'block';
        document.getElementById('errorPss').style.display = 'block';

    } else if( cedLog != '' && pssLog == '' ){
        alert('Ingrese la clave');
        document.getElementById('errorCed').style.display = 'none';
        document.getElementById('errorPss').style.display = 'block';

    } else if( cedLog == '' && pssLog != '' ){
        alert('Ingrese el número de cédula');
        document.getElementById('errorCed').style.display = 'block';
        document.getElementById('errorPss').style.display = 'none';

    } else if( true == regCed.test(cedLog) && false == regCed.test(pssLog) ){
    	alert('Los valores son incorrectos');
    	document.getElementById('errorCed').style.display = 'none';
    	document.getElementById('errorPss').style.display = 'none';
        document.getElementById('errorLog').style.display = 'block';

    } else if( true == regCed.test(cedLog) && true == regCed.test(pssLog) ){
		document.getElementById('cortina').style.display = 'block';

		document.getElementById('identificarForm').action = "usuario.php";
		document.forms['identificarForm'].submit();
		return false;

	}//fin if( cedLog

}//fin identificar()


$(document).ready(function(){

	if( navigator.onLine ){
		// alert('Online');
	} else {
		// alert('Offline');
		document.getElementById('conexionOff').style.display = 'block';
	}//fin if( navigator
	
	if( cedPost != '' || pssPost != '' ){
		document.getElementById('errorLog').style.display = 'block';
	}//fin if( cedPost

});//fin document ready
</script>

</head>
<body>

<div id="cortina"> <br><br><br><br><br><br><br><br> Un momento por favor </div><!-- /#cortina -->

<div id="main" class="disBlock floatNoneClearBoth">

	<div id="conexionOff" class="disNone floatNoneClearBoth">
		<img class="logoLPT disBlock posAbs" src="recursos/img/logo_lpt_trans.png">
		Esta aplicación requiere conexión a internet. 
		<br>
		Regrese a la aplicación cuando se encuentre conectado nuevamente. 
	</div><!-- #conexionOff -->

	<?php include 'dblpt.php'; ?>

	<form id="identificarForm" method="post" action="">
		<img class="logoLPT disBlock posRel marginAuto" src="recursos/img/logo_lpt_trans.png">
		<table id="tableLog" class="disBlock floatNoneClearBoth">
			<tr>
				<td class="columna50Per"> Cédula </td>
				<td class="columna50Per"> <input id="_cedLog" name="_cedLog" type="text" placeholder="Ej: 909990999"> </td>
			</tr>
			<tr>
				<td> Clave </td>
				<td> <input id="_pssLog" name="_pssLog" type="password"> </td>
			</tr>
			<tr>
				<td colspan="2"> 
					<a id="btnLogin" onclick="identificar()" class="disBlock floatNoneClearBoth marginAuto btnSubmit">Ingresar</a> 
					<div id="errorCed"> El número de cédula es incorrecto </div>
					<div id="errorPss"> La clave es incorrecta </div>
					<div id="errorLog"> 
						El número de cédula o la clave son incorrectos. Por favor verifique.
					</div><!-- #errorLog -->
				</td>
			</tr>
		</table><!-- #tableLog -->
	</form><!-- #identificarForm -->

</div><!-- #main -->

<div id="footer" class="disBlock floatNoneClearBoth">
    <strong>Asociación Libros para Todos</strong>
    <br><br>
	Teléfono gratuito: <a href="tel:800-800-1000">800-800-1000</a>
	<br>
	Whatsapp (texto): 7300-6685
</div><!-- /#footer -->

</body>
</html>