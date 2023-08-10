<?php
session_start();
include '../class/database.php';
$db = new database();
$db->conectarDB();
//if(isset($_SESSION['carrito'])){
  //  header('Location: ../views/carrito2.php');
//}
$arreglo = json_decode($_POST['arregloCarrito']);
$chec = json_decode($_POST['arregloCarrito'],true);
$cero=0;
//var_dump($arreglo);

//echo $arreglo[1]['Id'];


$existenciasArray = array('exi'=>''
);
for ($i = 0; $i < count($chec); $i++) {
    $idProducto = $chec[$i]['Id'];
    
    $consulta = "SELECT * FROM detalle_productos WHERE id_detalle_producto = '$idProducto';";
    $no=$db->ejecuta($consulta);
    $existencias=$no->existencias_detalle_producto;    
    
    $existenciasArray[$i]['exi'] = $existencias;
}
//var_dump($existenciasArray);
for($j=0;$j<count($chec);$j++){
if($existenciasArray[$j]['exi']==0){
$cero=1;
break;
}
}

if ($cero==1){

  header("refresh:0; ../views/carrito2.php");

}else{

//var_dump($existenciasArray);

echo json_encode($existenciasArray);


$random = $db->aleatorio();
//ORDEN VENTA
$query="INSERT INTO orden_venta(id_venta,cliente_orden_venta_FK) values ('$random','$_SESSION[id]')";
$query=$db->ejecuta($query);

//DETALLE ORDEN VENTA
for($i=0;$i<count($arreglo);$i++){

    $si = "SELECT * FROM detalle_productos WHERE id_detalle_producto = " . $arreglo[$i]->Id;
    $no=$db->ejecuta($si);
    $produ=$no->detalle_producto_detalle_producto_FK;

    $chi = "INSERT INTO detalle_orden_venta(orden_venta_detalle_orden_FK, producto_orden_venta_FK, cantidad_producto_orden_venta, precio_detalle_orden) VALUES ('$random', '$produ', {$arreglo[$i]->Cantidad}, {$arreglo[$i]->Precio})";
    $chi=$db->ejecuta($chi);


}
header("refresh:0; ../views/mis_ordenes.php");
        
}
?>