<?php

include_once('lib/nusoap.php');
$server = new soap_server;
$server->configureWSDL('insertarTipoDocumento',
                       'urn:insertarTipoDocumento');
$server->wsdl->addComplexType('tipoDocumento',
                              'complexType',
                              'struct',
                              'all',
                              '',
                              array('respuesta' => array('name' => 'respuesta', 'type' => 'xsd:string'))
);

$server->register('insertarTipoDocumento',
                  array('descripcionTipoDocumento' => 'xsd:string', 'usuarioInsercion' => 'xsd:string'),
                  array('return' => 'tns:tipoDocumento'),
                  'urn:insertarTipoDocumento',
                  'urn:insertarTipoDocumento#tipoDocumento',
                  'rpc',
                  'encoded',
                  'Este método devuelve un tipoDocumento.');

function insertarTipoDocumento($descripcion,
                               $usuario) {
    try {
        include_once('controller/TipoDocumentoController.php');

        $tipoDocumentoController = new TipoDocumentoController();

        $arrayRespuesta = $tipoDocumentoController->nuevoTipoDocumento($descripcion,
                                                                       $usuario);
        return $arrayRespuesta;
    }catch (Exception $e) {
        return array('respuesta'=>'No se Realizó Registro');
    }
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>