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
 try {
        include_once('controller/TipoDocumentoController.php');
        
        $tipoDocumentoController = new TipoDocumentoController();

        $arrayRespuesta = $tipoDocumentoController->obtenerRegistroTipoDocumento($codTipoDocumento);

          return $arrayRespuesta; 
    }catch (Exception $e) {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>