<?php
class ConectarBD {

    public function conectar() {
        include('DB_mysql.php');
        $db_mysql = new DB_mysql;
        $conexion = $db_mysql->conectar();

        return $conexion;
    }
}
;
?>