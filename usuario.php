<?php 

include 'inSqlProtect.php';

$cedula = stripslashes($_POST["_cedLog"]);
$clave  = stripslashes($_POST["_pssLog"]);
$patron = "/^[1-9]{1}[0-9]{8,9}+$/";

if( preg_match($patron, $cedula) && preg_match($patron, $clave) ){
	
	include 'dblpt.php';
	$usrQuery = mysql_query('SELECT id, name, password, last_name1 FROM lpt_users WHERE id_role = 3 AND name = \''.$cedula.'\' AND password = \''.$clave.'\' LIMIT 1 ');
	$result   = mysql_fetch_row($usrQuery);
	if( $result[0] ){

		$idUsr = $result[0];
		$razon = $result[3];
		?>
		<form id="okForm" action="main.php" method="post">
			<input id="_idPost"  name="_idPost"  type="hidden" value="<?php echo $idUsr; ?>">
			<input id="_cedPost" name="_cedPost" type="hidden" value="<?php echo $cedula; ?>">
			<input id="_pssPost" name="_pssPost" type="hidden" value="<?php echo $clave; ?>">
			<input id="_rznPost" name="_rznPost" type="hidden" value="<?php echo $razon; ?>">
		</form>
		<script type="text/javascript">
			document.getElementById("okForm").submit();
		</script>
		<?php 

	} else {

		?>
		<form id="noForm" action="index.php" method="post">
			<input id="_cedPost" name="_cedPost" type="hidden" value="<?php echo $cedula; ?>">
			<input id="_pssPost" name="_pssPost" type="hidden" value="<?php echo $clave; ?>">
		</form>
		<script type="text/javascript">
			document.getElementById("noForm").submit();
		</script>
		<?php 

	}//fin if( $result

} else {
	
	?>
	<form id="backForm" action="index.php" method="post">
		<input id="_cedPost" name="_cedPost" type="hidden" value="<?php echo $cedula; ?>">
		<input id="_pssPost" name="_pssPost" type="hidden" value="<?php echo $clave; ?>">
	</form>
	<script type="text/javascript">
		document.getElementById("backForm").submit();
	</script>
	<?php 

}//fin if( preg_match

?>