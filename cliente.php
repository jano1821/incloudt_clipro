<?php
require_once('lib/nusoap.php');

//$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_ObtenerTipoDocumento.php?wsdl', 'wsdl');
//$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_ListarTipoDocumento.php?wsdl', 'wsdl');
//$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_InsertarTipoDocumento.php?wsdl', 'wsdl');
$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_EditarTipoDocumento.php?wsdl', 'wsdl');
$l_oProxy  = $l_oClient->getProxy();


//$l_stResult = $l_oProxy->obtenerTipoDocumento('1');
//$l_stResult = $l_oProxy->obtenerTipoDocumento('%','%','10','0');
//$l_stResult = $l_oProxy->insertarTipoDocumento('libreta','jano');
$l_stResult = $l_oProxy->editarTipoDocumento('1','DNIa','S','jano');


   print '<h1>Tipo Documento :</h1>'
           . '<br>respuesta: '  . $l_stResult['respuesta']
           //. '<br>descripcionTipoDocumento: '  . $l_stResult['descripcionTipoDocumento']
           //. '<br>estadoRegistro: '  . $l_stResult['estadoRegistro']

?>