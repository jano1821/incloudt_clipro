<?php
include_once('lib/nusoap.php');
include_once('inc/ConectarBD.php');
$server = new soap_server;
$server->configureWSDL('obtenerTipoDocumento', 'urn:obtenerTipoDocumento');
$server->wsdl->addComplexType('tipoDocumento','complexType','struct','all','',
                array('codTipoDocumento' => array('name' => 'codTipoDocumento', 'type' => 'xsd:string'),
                      'descripcionTipoDocumento' => array('name' => 'descripcionTipoDocumento', 'type' => 'xsd:string'),
                      'estadoRegistro' => array('name' => 'estadoRegistro', 'type' => 'xsd:string' ),
                     )

               );

$server->register('obtenerTipoDocumento',
                  array('codTipoDocumento' => 'xsd:string'),
                  array('return'=>'tns:tipoDocumento'),
                  'urn:obtenerTipoDocumento',
                  'urn:obtenerTipoDocumento#tipoDocumento',
                  'rpc',
                  'encoded',
                  'Este método devuelve un tipoDocumento.');

function obtenerTipoDocumento($codTipoDocumento){
  $arrayTipoDocumento = array();

  $conecta = new ConectarBD();
  $conexion = $conecta -> conectar();

  $sql = "select codTipoDocumento, ".
         "descripcionTipoDocumento, ".
         "estadoRegistro ".
         "FROM tipo_documento ".
         "where codTipoDocumento = '".$codTipoDocumento."';";

  $resultado = $conexion->query($sql);

    while ($row = $resultado->fetch_array()) {
      $arrayTipoDocumento[] = $row;
    }



    return array("codTipoDocumento" => $arrayTipoDocumento[0][0],"descripcionTipoDocumento" => $arrayTipoDocumento[0][1],"estadoRegistro" => $arrayTipoDocumento[0][2]);


}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>