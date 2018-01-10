<?php

class TipoDocumento {
    private $conexion;

    public function TipoDocumento() {
        include_once('inc/ConectarBD.php');
        $conectarBD = new ConectarBD();
        $this->conexion = $conectarBD->conectar();
    }

    public function listaTipoDocumento($descripcion,
                                       $estado,
                                       $cantReg,
                                       $limite) {
        $sql = "select codTipoDocumento, " .
                                "descripcionTipoDocumento, " .
                                "estadoRegistro " .
                                "FROM tipo_documento " .
                                "where descripcionTipoDocumento like '%" . $descripcion . "%' " .
                                "and estadoRegistro like '%" . $estado . "%' " .
                                "limit $cantReg OFFSET $limite;";
        $resultado = $this->conexion->query($sql);

        return $resultado;
    }

    public function obtenerRegistroTipoDocumento($codTipoDocumento) {
        $sql = "select codTipoDocumento, " .
                                "descripcionTipoDocumento, " .
                                "estadoRegistro " .
                                "FROM tipo_documento " .
                                "where codTipoDocumento = '" . $codTipoDocumento . "';";

        $resultado = $this->conexion->query($sql);

        return $resultado;
    }

    public function nuevoTipoDocumento($descripcion,
                                       $usuario) {
        $respuesta = "";

        $sql = "insert into tipo_documento(descripcionTipoDocumento,estadoRegistro,usuarioInsercion,fechaInsercion) " .
                                "values('$descripcion', " .
                                "'S', " .
                                "'$usuario', " .
                                "CURDATE());";

        $resultado = $this->conexion->query($sql);

        if (!$resultado) {
            $respuesta = "No se Realizó Inserción de Registro";
        }else {
            $respuesta = "000";
        }

        return $respuesta;
    }

    public function editarTipoDocumento($codTipoDocumento,
                                        $descripcion,
                                        $estado,
                                        $usuario) {
        $respuesta = "";

        $sql = "update tipo_documento " .
                                "set descripcionTipoDocumento = '$descripcion', " .
                                "estadoRegistro = '$estado', " .
                                "usuarioModificacion = '$usuario', " .
                                "fechaModificacion = CURDATE() " .
                                "where codTipoDocumento = '$codTipoDocumento';";

        $resultado = $this->conexion->query($sql);

        if (!$resultado) {
            $respuesta = "No se Realizó Actualización de Registro";
        }else {
            $respuesta = "000";
        }

        return $respuesta;
    }
}