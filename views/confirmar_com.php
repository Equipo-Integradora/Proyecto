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
?>

<div class="container">
<div class="row" style="background-color: white; padding: 10px;">
            <div class="col-4" >
            <a href="../views/verproducto.php?id=<?php echo $arregloCarrito[$i]['Id'] ?>">
            <img style="width: 140px; height: 180px" src="../img/productos/<?php echo $arregloCarrito[$i]['Imagen'] ?>" alt="no">
            </a>
            </div>
            <div class="col">
                <div class="row" >
                    <div class="col-12"><?php echo $arregloCarrito[$i]['Nombre'] ?></div>
                    <div class="col-12"><?php echo $arregloCarrito[$i]['Color'] ?></div>
                    <div class="col-12"></div>
                    <div class="col-12"><b>$MXN<?php echo $arregloCarrito[$i]['Precio'] ?></b></div>
                    <div class="col-8 cant<?php echo $arregloCarrito[$i]['Id']; ?>">Total por cantidad $<?php echo $arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad'] ?></div>
                </div>
            </div>
            <hr style="margin-top: 5px;">
        </div>
</div>