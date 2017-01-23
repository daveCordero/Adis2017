//detecta cliente navegador
var isiPhone   = navigator.userAgent.toLowerCase().indexOf('iphone');
var isiPad     = navigator.userAgent.toLowerCase().indexOf('ipad');
var isiPod     = navigator.userAgent.toLowerCase().indexOf('ipod');
var isSafari   = navigator.userAgent.toLowerCase().indexOf('safari');
var isAndroid  = navigator.userAgent.toLowerCase().indexOf('android');
// var sectionBtn = '';


document.oncontextmenu = function(){return false};
//document.onselectstart = function(){return false};
//document.onkeydown = function(){return false};


var linea = 0;
var f = new Date();
var fechaHoy = f.getDate() + "-" + (f.getMonth() +1) + "-" + f.getFullYear(); 
// revisar dato al enviar o validar form pues datepicker cambia - (guión) por / (barra inclinada)
// y satélite espera - 


var newPro = 0;
function nuevaProforma(){
    if( newPro == 0 ){
        // alert('linea: ' + linea);
        document.getElementById('addProforma').style.height = 'auto';
        document.getElementById('nuevaPro').style.backgroundImage = "url('recursos/img/ico_x.png')";
        newPro = 1;
    } else if( newPro == 1 ){
        document.getElementById('addProforma').style.height = '1px';
        document.getElementById('nuevaPro').style.backgroundImage = "url('recursos/img/ico_plus.png')";
        newPro = 0;
    }//fin if( newPro
}//fin nuevaProforma()


function validaProforma(){
    for( i = 1; i <= linea; i++ ){ 
        prod = document.getElementById('prod' + i).value; //alert(prod);
        cant = document.getElementById('cant' + i).value; //alert(cant);
        mont = document.getElementById('mont' + i).value; //alert(mont);

        if( prod == '' && cant != '' ){
            alert('Seleccione el producto');
        } else if( prod != '' && cant == '' ){
            validaCant(cant,'cant' + i);
        } else if( i == linea ){
            if( prod == '' && cant == '' && i == linea && linea == 1 ){
                alert('Ingrese al menos un producto');
            } else if( prod == '' && cant == '' && i == linea && linea != 1 ){
                showCortina();
                document.getElementById('prod' + i).disabled = true;
                document.getElementById('cant' + i).disabled = true;
                document.getElementById('desc' + i).disabled = true;
                document.getElementById('neto' + i).disabled = true;
                enviarPro();
            } else if( prod != '' && cant != '' && i == linea ){
                showCortina();
                enviarPro();
            }//fin if( prod
        }//fin if( prod 

    }//fin for( i
}//fin validaProforma()


function enviarPro(){
    // alert('enviarPro');
    showCortina();
    for( x = 1; x <= linea; x++ ){ 
        document.getElementById('prod' + x).disabled = false;
        document.getElementById('mont' + x).disabled = false;
    }//fin for( x
    document.getElementById('_count').value = linea;
    document.getElementById("addProforma").action = "insertar.php";
    document.forms['addProforma'].submit();
    return false;
}//fin enviarPro


function lineaObj(){
    $('#columna4').append('<tr id="tr' + linea + '"> <td> <select id="prod' + linea + '" name="prod' + linea + '" onchange="asignaProd()"> <option value=""> Seleccione el producto</option> ' + lineaProd + ' </select> <input id="cant' + linea + '" name="cant' + linea + '" type="number" min="0" max="9999" placeholder="cantidad" onchange="validaCant(this.value,this.name)" required> <input id="mont' + linea + '" name="mont' + linea + '" type="text" placeholder="monto" disabled> <input type="hidden" id="desc' + linea + '" name="desc' + linea + '" value=""> <input type="hidden" id="neto' + linea + '" name="neto' + linea + '" value=""> <input type="button" onclick="addLinea()" id="btnAddLine" value="&nbsp;"> </td> </tr>'); 
}//fin lineaObj() 


function lineaIni(){
    linea ++; //alert('linea: ' + linea);
    lineaObj();
}//fin lineaIni() 


var regExpCant = /^[0-9]{1,3}$/;
function addLinea(){

	prod = document.getElementById('prod' + linea).value; //alert(prod);
    cant = document.getElementById('cant' + linea).value; //alert(cant);

    if( prod == '' ){
        alert('Seleccione el producto');
    } else if( cant == '' ){
        alert('Indique la cantidad de productos');
    } else if( false == regExpCant.test(cant) ){
        alert('Cantidad debe ser un número');
    } else {
        $('#prod' + linea).attr('disabled', true);
        $('#btnAddLine').replaceWith('<input type="button" onclick="deleteLinea(' + linea + ')" class="btnDelLine" value="&nbsp;">');
        linea ++; //alert('linea: ' + linea);
        lineaObj();
        document.getElementById('addProforma').style.height = 'auto';
    }//fin if( prod

}//fin addLinea() 


function asignaProd(){
    if( document.getElementById('prod' + linea).value != '' ){
        document.getElementById('cant' + linea).value = 1;
        validaCant(1,'cant' + linea);
    } else if( document.getElementById('prod' + linea).value == '' ){
        document.getElementById('cant' + linea).value = '';
        document.getElementById('mont' + linea).value = '';
        document.getElementById('desc' + linea).value = '';
        document.getElementById('neto' + linea).value = '';
    }//fin if( document
}//fin asignaProd()


var costoTexto = 1900;  // materias básicas
var costoComp  = 3000;  // productos complementarios
var descTexto  = 17.37; // descuento materias básicas
var descComp   = 20;    // descuento complementarios
var monto      = 0;
var neto       = 0;
function validaCant(numero,idObj){

    if( idObj != null ){
        var objNum = idObj.replace('cant', '');
    } else {
        var objNum = linea;
    }//fin if( idObj 
    // alert('objNum: ' + objNum);

    if( document.getElementById('prod' + objNum).value == '' ){
        alert('Seleccione el producto antes de elegir la cantidad');
        document.getElementById('cant' + objNum).value = '';
    } else if( false == regExpCant.test(numero) ){
        alert('Ingrese un número en Cantidad.');
        document.getElementById('cant' + objNum).value = '';
        document.getElementById('mont' + objNum).value = '';
        // document.getElementById('desc' + objNum).value = '';
        // document.getElementById('neto' + objNum).value = '';
    } else if( numero <= 0 ){
        alert('Cantidad debe ser 1 o superior');
        document.getElementById('cant' + objNum).value = '';
    } else {
        producto = document.getElementById('prod' + objNum).value; //alert(producto);
        if( producto.indexOf('LPT-2017') != -1 ){
            var textoDescontado = descTexto * costoTexto / 100; //alert('textoDescontado: ' + textoDescontado);
            monto = numero * (costoTexto - textoDescontado); //alert('monto: ' + monto);// descuento de 17.37 %
            neto  = numero * costoTexto;
            document.getElementById('desc' + objNum).value = descTexto;

        } else if( producto.indexOf('Figuras y espacios 1 2017') != -1 || 
                   producto.indexOf('Lápiz y letras 1 2017') != -1 || 
                   producto.indexOf('Lápiz y letras 2 2017') != -1 || 
                   producto.indexOf('Literaturas') != -1 
                 ){
            var compDescontado  = descComp * costoComp / 100; //alert('compDescontado: ' + compDescontado);
            monto = numero * (costoComp - compDescontado); //alert('monto: ' + monto);// descuento de 20 %
            neto  = numero * costoComp;
            document.getElementById('desc' + objNum).value = descComp;

        }//fin if( producto

        document.getElementById('neto' + objNum).value = neto;
        document.getElementById('mont' + objNum).value = monto;
        totalPro();

    }//fin if( false
}//fin validaCant()


function addCommas(nStr){
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }//fin while
    // return x1 + x2;
    x2 = parseFloat(x2).toFixed(2);
    return x1 + x2;
}//fin addCommas()


function totalPro(){ 
    var contador  = 0;
    var totalMont = 0;

    for( y = 1; y <= linea; y++ ){ 
        // alert(y);
        contador = document.getElementById('mont' + y).value;
        contador = Number(contador);
        if( contador != '' && contador != 0 ){ 
        // if( contador != null ){ 
            totalMont = totalMont + contador;
        }//fin if( contador
    }//fin for( y 

    totalMont = addCommas(totalMont);
    document.getElementById('proTotal').value = totalMont;
}//fin totalPro()


function deleteLinea(elemento){
    // alert('#tr' + elemento);
    if( linea != 1 ){
    // if( elemento != 1 ){
        $('#tr' + elemento).remove();
    } else {
        alert('Debe ingresar al menos un producto');
    }//fin if( linea
}//fin borrarLinea()


function backIni(){
    // alert('backIni');
    showCortina();
    document.forms['okForm'].submit();
    return false;
}//fin backIni()

function showCortina(){
    // alert('showCortina');
    document.getElementById('cortina').style.display = 'block';
}//fin backIni()

