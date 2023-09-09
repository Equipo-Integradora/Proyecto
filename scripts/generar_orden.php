<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <title>Producto agotado</title>
</head>
<body>
  <div class="container">
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

if ($cero==1)
{
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Tienes un artículo sin existencias.',";
                echo "  showConfirmButton: false,";
                echo "  timer: 3000";
                echo "});";
                echo "</script>";
  header("refresh:3; ../views/carrito2.php");
}else{

//var_dump($existenciasArray);



$random = $db->aleatorio();
//ORDEN VENTA
$query="INSERT INTO orden_venta(id_venta,cliente_orden_venta_FK) values ('$random','$_SESSION[id]')";
$query=$db->ejecuta($query);

//DETALLE ORDEN VENTA
for($i=0;$i<count($arreglo);$i++){

    $si = "SELECT * FROM detalle_productos WHERE id_detalle_producto = " . $arreglo[$i]->Id;
    $no=$db->ejecuta($si);
    $produ=$no->detalle_producto_detalle_producto_FK;

    $chi = "INSERT INTO detalle_orden_venta(orden_venta_detalle_orden_FK, producto_orden_venta_FK, cantidad_producto_orden_venta) VALUES ('$random', '$produ', {$arreglo[$i]->Cantidad})";
    $chi=$db->ejecuta($chi);


}
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'success',";
                echo "  title: 'Compra realizada con exito.',";
                echo "  showConfirmButton: false,";
                echo "  timer: 3000";
                echo "});";
                echo "</script>";
header("refresh:3; ../views/mis_ordenes.php");     
}
?>
  </div>
</body>
</html>