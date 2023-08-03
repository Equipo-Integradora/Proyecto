<?php
session_start();
include '../class/database.php';
$db = new database();
$db->conectarDB();
//if(isset($_SESSION['carrito'])){
  //  header('Location: ../views/carrito2.php');
//}
$arreglo = json_decode($_POST['arregloCarrito']);
//$arreglo=$_POST['ti'];

//var_dump($arreglo);
//var_dump($arreglo);

//echo $arreglo[1]['Id'];





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

    $edi= "UPDATE detalle_productos
    set existencias_detalle_producto=existencias_detalle_producto - {$arreglo[$i]->Cantidad}
    WHERE id_detalle_producto = " . $arreglo[$i]->Id;
    
    $edi=$db->ejecuta($edi);
}
header("refresh:3; ../views/mis_ordenes.php");

        echo "<div class='alert alert-success' style='margin-top: 5%'>SIIIIIIIIIIIII</div>";
        

?>