<?php
class Admin {
    private $fechas = array();

    public function __construct() 
    {
        // Cargar fechas desde el archivo al crear una nueva instancia de Admin
        $this->cargarFechas();
    }

    public function agregarFecha($fecha) 
    {
        array_push($this->fechas, $fecha);
        
        $this->guardarFechas();
    }

    public function obtenerFechas() 
    {
        return $this->fechas;
    }

    public function borrarFecha($fecha) 
    {
        $key = array_search($fecha, $this->fechas);
        if ($key !== false) 
        {
            unset($this->fechas[$key]);
            
            $this->guardarFechas();
        }
    }

    private function cargarFechas() 
    {
        $archivo = 'fechas.txt';
        if (file_exists($archivo)) 
        {
            $contenido = file_get_contents($archivo);
            $this->fechas = unserialize($contenido);
        }
    }

    private function guardarFechas() 
    {
        $archivo = 'fechas.txt';
        $contenido = serialize($this->fechas);
        file_put_contents($archivo, $contenido);
    }
}

?>
