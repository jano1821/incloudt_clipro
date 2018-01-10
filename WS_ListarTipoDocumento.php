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
                  array('descripcionTipoDocumento' => 'xsd:string','estadoRegistro' => 'xsd:string','cantReg'=>'xsd:string','limite'=>'xsd:string'),
                  array('return'=>'tns:tipoDocumento'),
                  'urn:obtenerTipoDocumento',
                  'urn:obtenerTipoDocumento#tipoDocumento',
                  'rpc',
                  'encoded',
                  'Este método devuelve un tipoDocumento.');

function obtenerTipoDocumento($descripcion,$estado,$cantReg,$limite){
  $cadenaCodTipoDocumento="";
  $cadenaDescripcionTipoDocumento="";
  $cadenaEstadoRegistro="";
  $conecta = new ConectarBD();
  $conexion = $conecta -> conectar();

  $sql = "select codTipoDocumento, ".
         "descripcionTipoDocumento, ".
         "estadoRegistro ".
         "FROM tipo_documento ".
         "where descripcionTipoDocumento like '%".$descripcion."%' ".
         "and estadoRegistro like '%".$estado."%' ".
         "limit $cantReg OFFSET $limite;";
  $resultado = $conexion->query($sql);

    while ($row = $resultado->fetch_array()) {
      $cadenaCodTipoDocumento .= $row[0].'#';
      $cadenaDescripcionTipoDocumento .= $row[1].'#';
      $cadenaEstadoRegistro .= $row[2].'#';
    }



    return array("codTipoDocumento" => $cadenaCodTipoDocumento,"descripcionTipoDocumento" => $cadenaDescripcionTipoDocumento,"estadoRegistro" => $cadenaEstadoRegistro);


}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>