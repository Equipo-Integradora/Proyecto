<?php
class Admin {
    protected static $fechas = array();
    
    public static function agregarFecha($fecha) {
        array_push(self::$fechas, $fecha);
        
        return error_log("Fecha agregada: " . $fecha);
    }

    public static function obtenerFechas() {
        return self::$fechas;
    }

    public static function borrarFecha($fecha) {
        if (($key = array_search($fecha, self::$fechas)) !== false) {
            unset(self::$fechas[$key]);
            
            error_log("Fecha borrada: " . $fecha);
        } else {

            error_log("No se encontró la fecha para borrar: " . $fecha);
        }
    }
}

?>