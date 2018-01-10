<?php

include_once('lib/nusoap.php');
$server = new soap_server;
$server->configureWSDL('editarTipoDocumento',
                       'urn:editarTipoDocumento');
$server->wsdl->addComplexType('tipoDocumento',
                              'complexType',
                              'struct',
                              'all',
                              '',
                              array('respuesta' => array('name' => 'respuesta', 'type' => 'xsd:string'),
                        )
);

$server->register('editarTipoDocumento',
                  array('codTipoDocumento' => 'xsd:string','descripcionTipoDocumento' => 'xsd:string', 'estadoRegistro' => 'xsd:string', 'usuario' => 'xsd:string'),
                  array('return' => 'tns:tipoDocumento'),
                  'urn:editarTipoDocumento',
                  'urn:editarTipoDocumento#tipoDocumento',
                  'rpc',
                  'encoded',
                  'Este método devuelve un tipoDocumento.');

function editarTipoDocumento($codTipoDocumento,
                             $descripcion,
                             $estado,
                             $usuario) {
    try {
        include_once('controller/TipoDocumentoController.php');

        $tipoDocumentoController = new TipoDocumentoController();

        $arrayRespuesta = $tipoDocumentoController->editarTipoDocumento($codTipoDocumento,
                                                                       $descripcion,
                                                                       $estado,
                                                                       $usuario);

        return $arrayRespuesta;
    }catch (Exception $e) {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>