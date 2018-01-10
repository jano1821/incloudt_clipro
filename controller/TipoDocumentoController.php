<?php

class TipoDocumentoController {

    public function TipoDocumentoController() {
        
    }

    public function listaTipoDocumento($descripcion,
                                       $estado,
                                       $cantReg,
                                       $limite) {
        include_once('entity/TipoDocumento.php');

        $cadenaCodTipoDocumento = "";
        $cadenaDescripcionTipoDocumento = "";
        $cadenaEstadoRegistro = "";

        $tipoDocumento = new TipoDocumento();
        $resultado = $tipoDocumento->listaTipoDocumento($descripcion,
                                                        $estado,
                                                        $cantReg,
                                                        $limite);

        while ($row = $resultado->fetch_array()) {
            $cadenaCodTipoDocumento .= $row[0] . '#';
            $cadenaDescripcionTipoDocumento .= $row[1] . '#';
            $cadenaEstadoRegistro .= $row[2] . '#';
        }

        return array("codTipoDocumento" => $cadenaCodTipoDocumento, "descripcionTipoDocumento" => $cadenaDescripcionTipoDocumento, "estadoRegistro" => $cadenaEstadoRegistro);
    }

    public function obtenerRegistroTipoDocumento($codTipoDocumento) {
        include_once('entity/TipoDocumento.php');
        $arrayTipoDocumento = array();

        $tipoDocumento = new TipoDocumento();
        $resultado = $tipoDocumento->obtenerRegistroTipoDocumento($codTipoDocumento);

        while ($row = $resultado->fetch_array()) {
            $arrayTipoDocumento[] = $row;
        }

        return array("codTipoDocumento" => $arrayTipoDocumento[0][0], "descripcionTipoDocumento" => $arrayTipoDocumento[0][1], "estadoRegistro" => $arrayTipoDocumento[0][2]);
    }

    public function nuevoTipoDocumento($descripcion,
                                       $usuario) {
        include_once('entity/TipoDocumento.php');

        $tipoDocumento = new TipoDocumento();
        $resultado = $tipoDocumento->nuevoTipoDocumento($descripcion,
                                                        $usuario);

        return array("respuesta" => $resultado);
    }

    public function editarTipoDocumento($codTipoDocumento,
                                        $descripcion,
                                        $estado,
                                        $usuario) {
        include_once('entity/TipoDocumento.php');

        $tipoDocumento = new TipoDocumento();
        $resultado = $tipoDocumento->editarTipoDocumento($codTipoDocumento,
                                                         $descripcion,
                                                         $estado,
                                                         $usuario);

        return array("respuesta" => $resultado);
    }
}