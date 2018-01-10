<?php
require_once('lib/nusoap.php');

$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_ObtenerTipoDocumento.php?wsdl', 'wsdl');
//$l_oClient = new soapclient('http://localhost:81/incloudt_clipro/WS_ListarTipoDocumento.php?wsdl', 'wsdl');
$l_oProxy  = $l_oClient->getProxy();


$l_stResult = $l_oProxy->obtenerTipoDocumento('1');
//$l_stResult = $l_oProxy->obtenerTipoDocumento('%','%','10','0');


   print '<h1>Tipo Documento :</h1>'
           . '<br>codTipoDocumento: '  . $l_stResult['codTipoDocumento']
           . '<br>descripcionTipoDocumento: '  . $l_stResult['descripcionTipoDocumento']
           . '<br>estadoRegistro: '  . $l_stResult['estadoRegistro']

?>