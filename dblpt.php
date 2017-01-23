<?php 

mysql_connect('52.70.158.89:3306','david_herrera','lptdb4321') or die ('Ha fallado la conexión: ' . mysql_error());
// mysql_select_db('LPT') or die ('Error al seleccionar la Base de Datos: ' . mysql_error());
mysql_select_db('LPT_TEST') or die ('Error al seleccionar la Base de Datos: ' . mysql_error());
mysql_query("SET NAMES 'utf8'");

?>