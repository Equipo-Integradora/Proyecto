<?php
session_start();
include '../class/database.php'; 
$db = new database();
$db->conectarDB();

$arregloCarrito = $_POST['arregloCarrito'];
$existenciasArray = array('exi'=>''
);
for ($i = 0; $i < count($arregloCarrito); $i++) {
    $idProducto = $arregloCarrito[$i]['Id'];
    
    $consulta = "SELECT * FROM detalle_productos WHERE id_detalle_producto = '$idProducto';";
    $no=$db->ejecuta($consulta);
    $existencias=$no->existencias_detalle_producto;    
    
    $existenciasArray[$i]['exi'] = $existencias;
}

// Devuelve las existencias en formato JSON
var_dump($existenciasArray);

echo json_encode($existenciasArray);


?>





