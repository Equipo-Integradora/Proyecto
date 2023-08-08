<?php
session_start();
include '../class/database.php';
$db = new database();
$db->conectarDB();
//if(isset($_SESSION['carrito'])){
  //  header('Location: ../views/carrito2.php');
//}
$arreglo = json_decode($_POST['arregloCarrito'], true);
//$arreglo=$_POST['ti'];

//var_dump($arreglo);

//echo $arreglo[1]['Id'];
include "../templates/header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/carrito.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/pruebatexto.css">
    <title>Document</title>
</head>
<body style="background-color: #f4f4f4;">
    
<div class="container" style="margin-top: 100px ; width: 100%;">
<div class="row " >
    <div class="col-lg-8 col-12" style="padding: 10px;">
    <div class="row justify-content-end" style="background-color: #f3eafb; height:40px">
    <div class="col-lg-4" style="margin-top: 13px; font-size:larger" >
        <b><p>MI ORDEN</p></b>
    </div>
    <div class="offset-lg-5 col-lg-3" style="margin-top: 13px; font-size:larger">
        <p>Ver <?php echo count($arreglo) ?> Articulos ></p>
    </div>
</div>
<div class="row" style="background-color: white; padding: 10px; height:370px; padding:20px">
<!--si--><div class="row" style="background-color: #f9f9f9; padding:20px; height: 160px;">

<div class="nav-container" style="height: 129px;" >
        <button class="btn prev-button"><i class="bi bi-caret-left"></i></button>
        <div class="nav-items-container">
          <ul class="nav-items">
          <?php
//var_dump($arreglo);
$tot=0;
                for($i=0;$i<count($arreglo);$i++){
$tot=$tot+ $arreglo[$i]['Precio']*$arreglo[$i]['Cantidad'];
?>
            <li class="nav-item" style="height: 200px;">
              <div class="col-4" style="width: 70px; height: 90px; position: relative; margin-right:30px;">
                <img style="width: 90px; height: 90px" src="../img/productos/<?php echo $arreglo[$i]['Imagen'] ?>" alt="no">
                <div style="width: 90px;    background-color: hsla(0,0%,0%,.5); text-align: center; color: #fa6338; position: absolute; bottom: 0;">
                    <b>x<?php echo $arreglo[$i]['Cantidad'] ?></b>
                </div>
                <div class="col-12" style="width: 90px; margin-top:5px;text-align:center">
                    <p style="font-size: 13px;"><b>$<?php echo $arreglo[$i]['Precio'] ?></b></p>
                </div>
              </div>
            </li>
            <?php
                }
            ?>
          </ul>
        </div>
        <button class="btn next-button"><i class="bi bi-caret-right"></i></button>
      </div>

                </div>
                <hr>
                <div class="col-12"><p>Total: <b>$MXN <?php echo $tot ?> </b></p></div>
        </div>
        </div>
</div>
</div>







<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
    const prevButton = document.querySelector(".prev-button");
const nextButton = document.querySelector(".next-button");
const navItemsContainer = document.querySelector(".nav-items-container");

let scrollX = 0;

prevButton.addEventListener("click", () => {
  scrollX -= 120;
  navItemsContainer.scrollTo({
    left: scrollX,
    behavior: "smooth",
  });
});

nextButton.addEventListener("click", () => {
  scrollX += 120;
  navItemsContainer.scrollTo({
    left: scrollX,
    behavior: "smooth",
  });
});
</script>


</div>


</body>
</html>

