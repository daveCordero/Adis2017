<?php 

mysql_connect('52.70.158.89:3306','david_herrera','lptdb4321') or die ('Ha fallado la conexión: ' . mysql_error());
// mysql_select_db('LPT') or die ('Error al seleccionar la Base de Datos: ' . mysql_error());
mysql_select_db('LPT_TEST') or die ('Error al seleccionar la Base de Datos: ' . mysql_error());
mysql_query("SET NAMES 'utf8'");
/*
$tablas = mysql_query('SHOW TABLES FROM LPT');
while( $regTablas = mysql_fetch_array($tablas) ){
	echo($regTablas[0] . "<br>");
}//fin while*/
/*
$colCliente = mysql_query('SHOW COLUMNS FROM lpt_customer');
while( $regCliente = mysql_fetch_array($colCliente) ){
	echo($regCliente[0] . "<br>");
}//fin while */
/*
$colOrder = mysql_query('SHOW COLUMNS FROM lpt_preOrder');
while( $regOrder = mysql_fetch_array($colOrder) ){
	echo $regOrder[0] . '<br>';
}//fin while */
/*
echo 'lpt_groupPreOrderDetailEntity: ' . '<br>';
$colOrderDetail = mysql_query('SHOW COLUMNS FROM lpt_groupPreOrderDetailEntity');
while( $regOrderDetail = mysql_fetch_array($colOrderDetail) ){
	echo $regOrderDetail[0] . '<br>';
}//fin while 
*/
/*
echo 'lpt_preOrderDetail: ' . '<br>';
$colPreDetail = mysql_query('SHOW COLUMNS FROM lpt_preOrderDetail');
while( $regPreDetail = mysql_fetch_array($colPreDetail) ){
	echo $regPreDetail[0] . '<br>';
}//fin while */
/*
echo 'lpt_preOrderStatus: ' . '<br>';
$colOrderStatus = mysql_query('SHOW COLUMNS FROM lpt_preOrderStatus');
while( $regOrderStatus = mysql_fetch_array($colOrderStatus) ){
	echo $regOrderStatus[0] . '<br>';
}//fin while */
/*
$colRoles = mysql_query('SHOW COLUMNS FROM lpt_roles');
while( $regRoles = mysql_fetch_array($colRoles) ){
	echo $regRoles[0] . '<br>';
}//fin while */
/*
$colProd = mysql_query('SHOW COLUMNS FROM lpt_product');
while( $regProd = mysql_fetch_array($colProd) ){
	echo $regProd[0] . '<br>';
}//fin while */
/*
$colSchool = mysql_query('SHOW COLUMNS FROM lpt_school');
while( $regSchool = mysql_fetch_array($colSchool) ){
	echo $regSchool[0] . '<br>';
}//fin while */
/*
$colUsers = mysql_query('SHOW COLUMNS FROM lpt_users');
while( $regUsers = mysql_fetch_array($colUsers) ){
	echo $regUsers[0] . '<br>';
}//fin while */
/*
$colPerm = mysql_query('SHOW COLUMNS FROM lpt_permissions');
while( $regPerm = mysql_fetch_array($colPerm) ){
	echo $regPerm[0] . '<br>';
}//fin while */
// echo 'date: ' . date('Y-m-d') . ' ' . date('h:m:s') . '<br>';

echo '<table>'; 
/*
echo 'lpt_preOrder: ' . '<br>';
echo '<thead> 
		<tr> 
			<th> ID </th> 
			<th> CUSTOMERID </th> 
			<th> date </th> 
			<th> DISCOUNT </th> 
			<th> STATUS </th> 
			<th> SUBTOTAL </th> 
			<th> TOTAL </th> 
			<th> TYPE </th> 
			<th> USERID </th> 
	  	</tr> 
	  </thead>';
// $colOrder = mysql_query('SELECT * FROM lpt_preOrder');
$colOrder = mysql_query('SELECT * FROM lpt_preOrder ORDER BY ID DESC');// WHERE CUSTOMERID = 85
while( $regOrder = mysql_fetch_array($colOrder) ){
	echo '<tr> 
			<td>' . $regOrder['ID']         . '</td> 
			<td>' . $regOrder['CUSTOMERID'] . '</td> 
			<td>' . $regOrder['date']       . '</td> 
			<td>' . $regOrder['DISCOUNT']   . '</td> 
			<td>' . $regOrder['STATUS']     . '</td> 
			<td>' . $regOrder['SUBTOTAL']   . '</td> 
			<td>' . $regOrder['TOTAL']      . '</td> 
			<td>' . $regOrder['TYPE']       . '</td> 
			<td>' . $regOrder['USERID']     . '</td> 
		  </tr>';

}//fin while */
/*
echo 'lpt_groupPreOrderDetailEntity: ' . '<br>';
echo '<thead> 
		<tr> 
			<th> ID </th> 
			<th> CANTPRODUCTS </th> 
			<th> DESCRIPTION </th> 
			<th> TOTALAMOUNT </th> 
			<th> PreOrderEntity </th> 
			<th> SCHOOL_IDSCHOOL </th> 
	  	</tr> 
	  </thead>';
$colOrderDetail = mysql_query('SELECT * FROM lpt_groupPreOrderDetailEntity'); // PRODUCT_DEFAULTCODE = "GND0300207" QUANTITY = 10 / ORDER BY PreOrderEntity / WHERE PreOrderEntity = 1205
while( $regOrderDetail = mysql_fetch_array($colOrderDetail) ){
	echo '<tr> 
			<td>' . $regOrderDetail['ID']              . '</td> 
			<td>' . $regOrderDetail['CANTPRODUCTS']    . '</td> 
			<td>' . $regOrderDetail['DESCRIPTION']     . '</td> 
			<td>' . $regOrderDetail['TOTALAMOUNT']     . '</td> 
			<td>' . $regOrderDetail['PreOrderEntity']  . '</td> 
			<td>' . $regOrderDetail['SCHOOL_IDSCHOOL'] . '</td> 
		  </tr>';
}//fin while */
/*
echo '<thead>
		<tr> 
			<th> ID </th> 
			<th> RESOLUTION </th> 
			<th> DESCRIPTION </th> 
			<th> IDPREORDER </th> 
			<th> IDUSER </th> 
			<th> IDUSERREQUEST </th>
		  </tr>
	  </thead>';
$colOrderStatus = mysql_query('SELECT * FROM lpt_preOrderStatus');
while( $regOrderStatus = mysql_fetch_array($colOrderStatus) ){
	echo '<tr> 
			<td>' . $regOrderStatus['ID']            . '</td> 
			<td>' . $regOrderStatus['RESOLUTION']    . '</td> 
			<td>' . $regOrderStatus['DESCRIPTION']   . '</td> 
			<td>' . $regOrderStatus['IDPREORDER']    . '</td> 
			<td>' . $regOrderStatus['IDUSER']        . '</td> 
			<td>' . $regOrderStatus['IDUSERREQUEST'] . '</td>
		  </tr>';
}//fin while */
// <td>' . $regOrderStatus[0] . '</td>
/*
$colRoles = mysql_query('SELECT * FROM lpt_roles');
while( $regRoles = mysql_fetch_array($colRoles) ){
	echo '<tr> 
			<td>' . $regRoles['id']          . '</td> 
			<td>' . $regRoles['description'] . '</td> 
		  </tr>';
}//fin while */
/*
echo 'lpt_product: ' . '<br>';
echo '<thead> 
		<tr> 
			<th> DEFAULTCODE </th> 
			<th> PACK </th> 
			<th> ISGRADEPACK </th> 
			<th> GRADE </th> 
			<th> EDITION </th> 
			<th> STATUS </th> 
			<th> PRICE </th> 
			<th> NAME </th> 
	  	</tr> 
	  </thead>';
$colProd = mysql_query('SELECT * FROM lpt_product WHERE EDITION = 2017');
while( $regProd = mysql_fetch_array($colProd) ){
	echo '<tr> 
			<td>' . $regProd['DEFAULTCODE'] . '</td> 
			<td>' . $regProd['PACK']        . '</td> 
			<td>' . $regProd['ISGRADEPACK'] . '</td> 
			<td>' . $regProd['GRADE']       . '</td> 
			<td>' . $regProd['EDITION']     . '</td> 
			<td>' . $regProd['STATUS']      . '</td> 
			<td>' . $regProd['PRICE']       . '</td> 
			<td>' . $regProd['NAME']        . '</td> 
		  </tr>';
}//fin while */
/*
$colProd = mysql_query('SELECT * FROM lpt_product WHERE EDITION = 2017');
while( $regProd = mysql_fetch_array($colProd) ){
	echo '<tr> 
			<td>' . $regProd['DEFAULTCODE'] . '</td> 
			<td>' . $regProd['PACK']        . '</td> 
			<td>' . $regProd['ISGRADEPACK'] . '</td> 
			<td>' . $regProd['GRADE']       . '</td> 
			<td>' . $regProd['EDITION']     . '</td> 
			<td>' . $regProd['STATUS']      . '</td> 
			<td>' . $regProd['PRICE']       . '</td> 
			<td>' . $regProd['NAME']        . '</td> 
		  </tr>';
}//fin while */
/*
$colSchool = mysql_query('SELECT * FROM lpt_school');
while( $regSchool = mysql_fetch_array($colSchool) ){
	echo '<tr> 
			<td>' . $regSchool['IDSCHOOL']      . '</td> 
			<td>' . $regSchool['CANTON']        . '</td> 
			<td>' . $regSchool['CODMEP']        . '</td> 
			<td>' . $regSchool['DISTRIC']       . '</td> 
			<td>' . $regSchool['STATUS']        . '</td> 
			<td>' . $regSchool['LAT']           . '</td> 
			<td>' . $regSchool['LON']           . '</td> 
			<td>' . $regSchool['NAME']          . '</td> 
			<td>' . $regSchool['ZONA']          . '</td> 
			<td>' . $regSchool['PROVINCE']      . '</td> 
			<td>' . $regSchool['POBLADO']       . '</td> 
			<td>' . $regSchool['REGION']        . '</td> 
			<td>' . $regSchool['DEPENDENCIA']   . '</td> 
			<td>' . $regSchool['CIRES']         . '</td> 
			<td>' . $regSchool['DIR_REGIONAL']  . '</td> 
			<td>' . $regSchool['CIRCUITO']      . '</td> 
			<td>' . $regSchool['MATRICULA_ACT'] . '</td> 
			<td>' . $regSchool['DONANTE']       . '</td> 
			<td>' . $regSchool['VENDEDOR']      . '</td> 
			<td>' . $regSchool['CONTACTNAME']   . '</td> 
			<td>' . $regSchool['TEL']           . '</td> 
			<td>' . $regSchool['EMAIL']         . '</td> 
			<td>' . $regSchool['ADDRESS']       . '</td> 
		  </tr>';
}//fin while */
/*
echo 'lpt_users: ' . '<br>';
echo '<thead>
		<tr> 
			<th> id </th> 
			<th> email </th> 
			<th> last_name1 </th> 
			<th> last_name2 </th> 
			<th> name </th> 
			<th> password </th>
			<th> status </th>
			<th> id_role </th>
		  </tr>
	  </thead>';
$colUsers = mysql_query('SELECT * FROM lpt_users'); // WHERE id_role = 3306
while( $regUsers = mysql_fetch_array($colUsers) ){
	echo '<tr> 
			<td>' . $regUsers['id']         . '</td> 
			<td>' . $regUsers['email']      . '</td> 
			<td>' . $regUsers['last_name1'] . '</td> 
			<td>' . $regUsers['last_name2'] . '</td> 
			<td>' . $regUsers['name']       . '</td> 
			<td>' . $regUsers['password']   . '</td> 
			<td>' . $regUsers['status']     . '</td> 
			<td>' . $regUsers['id_role']    . '</td> 
		  </tr>';

}//fin while */
/*
echo 'lpt_preOrderDetail: ' . '<br>';
echo '<thead>
		<tr> 
			<th> ID </th> 
			<th> AMOUNT </th> 
			<th> QUANTITY </th> 
			<th> GroupPreOrderDetailEntity </th> 
			<th> PRODUCT_DEFAULTCODE </th> 
			<th> DISCOUNT </th>
		  </tr>
	  </thead>';
$colOrDet = mysql_query('SELECT * FROM lpt_preOrderDetail'); // WHERE id_role = 3306
while( $regOrDet = mysql_fetch_array($colOrDet) ){
	echo '<tr> 
			<td>' . $regOrDet['ID']                        . '</td> 
			<td>' . $regOrDet['AMOUNT']                    . '</td> 
			<td>' . $regOrDet['QUANTITY']                  . '</td> 
			<td>' . $regOrDet['GroupPreOrderDetailEntity'] . '</td> 
			<td>' . $regOrDet['PRODUCT_DEFAULTCODE']       . '</td> 
			<td>' . $regOrDet['DISCOUNT']                  . '</td> 
		  </tr>';
}//fin while */

echo 'lpt_customer: ' . '<br>';
echo '<thead>
		<tr> 
			<th> IDCUSTOMER </th> 
			<th> ADDRESS </th> 
			<th> EMAIL </th> 
			<th> IDNUMBER </th> 
			<th> isCompany </th> 
			<th> name </th>
			<th> PHONE </th>
			<th> STATUS </th>
			<th> WEBSITE </th>
			<th> OBSERVATIONS </th>
			<th> CUSTOMERTYPE </th>
			<th> ENTREGA </th>
			<th> IND_ACOM </th>
			<th> IND_ACT </th>
			<th> IND_DOC </th>
			<th> ESP_DESC </th>
			<th> NUM_ADC </th>
			<th> PLAZO_PAGO </th>
			<th> IND_OC </th>
			<th> NOM_FAC </th>
			<th> EMAIL_FAC </th>
			<th> TEL_FAC </th>
			<th> NOM_ENT </th>
			<th> EMAIL_ENT </th>
			<th> TEL_ENT </th>
		  </tr>
	  </thead>';
$colCliente = mysql_query('SELECT * FROM lpt_customer');
while( $regCliente = mysql_fetch_array($colCliente) ){
	echo '<tr> 
			<td>' . $regCliente['IDCUSTOMER']   . '</td> 
			<td>' . $regCliente['ADDRESS']      . '</td> 
			<td>' . $regCliente['EMAIL']        . '</td> 
			<td>' . $regCliente['IDNUMBER']     . '</td> 
			<td>' . $regCliente['isCompany']    . '</td> 
			<td>' . $regCliente['name']         . '</td> 
			<td>' . $regCliente['PHONE']        . '</td> 
			<td>' . $regCliente['STATUS']       . '</td> 
			<td>' . $regCliente['WEBSITE']      . '</td> 
			<td>' . $regCliente['OBSERVATIONS'] . '</td> 
			<td>' . $regCliente['CUSTOMERTYPE'] . '</td> 
			<td>' . $regCliente['ENTREGA']      . '</td> 
			<td>' . $regCliente['IND_ACOM']     . '</td> 
			<td>' . $regCliente['IND_ACT']      . '</td> 
			<td>' . $regCliente['IND_DOC']      . '</td> 
			<td>' . $regCliente['ESP_DESC']     . '</td> 
			<td>' . $regCliente['NUM_ADC']      . '</td> 
			<td>' . $regCliente['PLAZO_PAGO']   . '</td> 
			<td>' . $regCliente['IND_OC']       . '</td> 
			<td>' . $regCliente['NOM_FAC']      . '</td> 
			<td>' . $regCliente['EMAIL_FAC']    . '</td> 
			<td>' . $regCliente['TEL_FAC']      . '</td> 
			<td>' . $regCliente['NOM_ENT']      . '</td> 
			<td>' . $regCliente['EMAIL_ENT']    . '</td> 
			<td>' . $regCliente['TEL_ENT']      . '</td> 
		  </tr>';

}//fin while 
/*
$colPerm = mysql_query('SELECT * FROM lpt_permissions'); //
while( $regPerm = mysql_fetch_array($colPerm) ){
	echo '<tr> 
			<td>' . $regPerm['ID']            . '</td> 
			<td>' . $regPerm['PERMISSIONS']   . '</td> 
			<td>' . $regPerm['ROLEENTITY_id'] . '</td> 
		  </tr>';

}//fin while */

echo '</table>'; 

/*
// $colOrder = mysql_query('SELECT * FROM lpt_preOrder');
$colOrder = mysql_query('SELECT * FROM lpt_preOrder WHERE CUSTOMERID = 85');
while( $regOrder = mysql_fetch_array($colOrder) ){
	$someArray = array(
						'id'         => $regOrder['ID'],
						'customerid' => $regOrder['CUSTOMERID'],
						'date'       => $regOrder['date'],
						'discount'   => $regOrder['DISCOUNT'],
						'status'     => $regOrder['STATUS'],
						'subtotal'   => $regOrder['SUBTOTAL'],
						'total'      => $regOrder['TOTAL'],
						'type'       => $regOrder['TYPE'],
						'userid'     => $regOrder['USERID']
	);
	$someJSON = json_encode($someArray);
	echo $someJSON;
}//fin while */

?>