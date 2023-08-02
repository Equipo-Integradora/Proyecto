<?php 

session_start();
include '../class/database.php';
$db = new database();
$db->conectarDB();
if(isset($_SESSION['carrito'])){
    //Si existe bucamos si ya está agregado ese producto
    if(isset($_POST['id'])){
        $arreglo=$_SESSION['carrito'];
        $encontro=false;
        $numero=0;
        for($i=0;$i<count($arreglo);$i++)
        {
            if($arreglo[$i]['Id']==$_POST['id'])
            {
                $encontro=true;
                $numero=$i;
            }
        }
        if($encontro==true){
            $arreglo[$numero]['Cantidad']= $arreglo[$numero]['Cantidad']+1;
            $_SESSION['carrito']=$arreglo;
            
        }else{
                $id=$_POST['id'];
                $nombre=$_POST['nombre'];
                    $precio=$_POST['precio'];
                    $color=$_POST['color'];
                    $imagen=$_POST['imagen'];
                    $cantidad=$_POST['cantidad'];
                    $si=$_POST['si'];
                    $maximo='';
                    
                $query="SELECT * FROM productos inner join detalle_productos 
            on productos.id_producto=detalle_productos.detalle_producto_detalle_producto_FK left join  colores
            on colores.id_color=detalle_productos.color_detalle_producto_FK
            where detalle_productos.id_detalle_producto=$id";
            $res=$db->ejecuta($query);
            $maximo=$res->existencias_detalle_producto;
            $arregloNuevo= array(
                'Id'=>$id,
                'Nombre'=>$nombre,
                'Precio'=>$precio,
                'Color'=>$color,
                'Imagen'=>$imagen,
                'Cantidad'=>1,
                'Maximo'=>$maximo,
                'Si'=>$si
            );
            array_push($arreglo,$arregloNuevo);
            $_SESSION['carrito']=$arreglo;
            //header("location: " .$_SERVER['HTTP_REFERER']."");  
            
            
        }
        
    }

}else{
    //Creamos la variable de sesión
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
            $precio=$_POST['precio'];
            $color=$_POST['color'];
            $imagen=$_POST['imagen'];
            $cantidad=$_POST['cantidad'];
            $si=$_POST['si'];

            $maximo='';


        $query="SELECT * FROM productos inner join detalle_productos 
    on productos.id_producto=detalle_productos.detalle_producto_detalle_producto_FK left join  colores
    on colores.id_color=detalle_productos.color_detalle_producto_FK
    where detalle_productos.id_detalle_producto=$id";
    $res=$db->ejecuta($query);
    $maximo=$res->existencias_detalle_producto;
    $arreglo[]= array(
        'Id'=>$id,
        'Nombre'=>$nombre,
        'Precio'=>$precio,
        'Color'=>$color,
        'Imagen'=>$imagen,
        'Cantidad'=>$cantidad,
        'Maximo'=>$maximo,
        'Si'=>$si
        
    );
    $_SESSION['carrito']=$arreglo;
    }
    //header("location: " .$_SERVER['HTTP_REFERER']."");

}
if(isset($_POST['id']))
{
        header("location: " .$_SERVER['HTTP_REFERER']."");
    
}
include "../templates/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="ruta/a/main.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<body style="background-color: #f4f4f4;">
<div class="container" style="margin-top: 100px ; width: 100%;">
<div class="row" style="background-color:aquamarine">
    <div class="col-8" style="padding: 10px;">
        <!--Ciclo-->
        <?php
                    $total = 0;

        if(isset($_SESSION['carrito'])) {
                $arregloCarrito=$_SESSION['carrito'];
                for($i=0;$i<count($arregloCarrito);$i++){
                    $total= $total+($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);

             ?>

        <div class="row" style="background-color: white; padding: 10px;">
            <div class="col-4" >
            <img style="width: 180px; height: 180px" src="../img/productos/<?php echo $arregloCarrito[$i]['Imagen'] ?>" alt="no">
            </div>
            <div class="col">
                <div class="row" >
                    <div class="col-12"><?php echo $arregloCarrito[$i]['Nombre'] ?></div>
                    <div class="col-12"><?php echo $arregloCarrito[$i]['Color'] ?></div>
                    <div class="col-12"></div>
                    <div class="col-3"><b>$MXN<?php echo $arregloCarrito[$i]['Precio'] ?></b></div>
                    <div class="col-3 offset-3">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <input style="width: 50px;" 
                            type="number" 
                            min="1" 
                            max="<?php echo $arregloCarrito[$i]['Maximo']?>"
                            class="form-control text-center txtCantidad"
                            data-precio="<?php echo $arregloCarrito[$i]['Precio']; ?>"
                            data-id="<?php echo $arregloCarrito[$i]['Id']; ?>"                        
                            value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>"
                            placeholder="" aria-label="" aria-describedby="button-addon1">
                        </div>
                    </div>
                    <div class="col-3">
                        <a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id'];?>">Borrar</a>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 5px;">
        </div>
        <?php
        }
    }
        ?>
    </div>
    <div class="col-4" style=" padding: 10px">
    <div class="container" style="background-color: white; width:300px;" >
<div class="justify-contend-end" style="border-color: black; border:3px;">
            <div class="row">
                <div class="col-12 text-right border-bottom">
                    <h3 class="text-black h4 text-upperccase">Total carrito</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <span class="text-black">Total</span>
                </div>
                <div class="col-6 text-right">
                    <strong class="text-black cant<?php echo $arregloCarrito[$i]['Id']; ?>">$<?php echo $total ?></strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                <form action="../scripts/generar_orden.php" method="post">
    <input type="hidden" name="arregloCarrito" value="<?php echo htmlspecialchars(json_encode($arregloCarrito)); ?>">
    <button class="btn btn-primary btn-lg py-3 btn-block">Proceder compra</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
</div>

<div class="table-responsive" style="margin-top: 100px ; width: 100%;">
    <table class="table shadow-sm table-hover">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if(isset($_SESSION['carrito'])) {
                $arregloCarrito=$_SESSION['carrito'];
                for($i=0;$i<count($arregloCarrito);$i++){
                    $total= $total+($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);

             ?>
             
            <tr>
                <td ><img style="width: 200px; height: 300px" src="../img/productos/<?php echo $arregloCarrito[$i]['Imagen'] ?>" alt="no"></td>
                <td><?php echo $arregloCarrito[$i]['Nombre'] ?> <?php echo isset($arregloCarrito[$i]['Color']) ?></td>
                <td>$<?php echo $arregloCarrito[$i]['Precio'] ?></td>
                <td>
                    <div class="input-group mb-3" style="max-width: 120px;">
                        <input style="width: 50px;" 
           type="number" 
           min="1" 
           max="<?php echo $arregloCarrito[$i]['Maximo']?>"
           class="form-control text-center txtCantidad"
           data-precio="<?php echo $arregloCarrito[$i]['Precio']; ?>"
           data-id="<?php echo $arregloCarrito[$i]['Id']; ?>"                        
           value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>"
           placeholder="" aria-label="" aria-describedby="button-addon1">
                    </div>
            </td>
                <td class="cant<?php echo $arregloCarrito[$i]['Id']; ?>">$<?php echo $arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad'] ?></td>
                <td><a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id'];?>">X</a></td>
            </tr>
            <?php
            }
        }
        //exit;
            ?>
        </tbody>
    </table>
    
</div>
<div class="container" style="margin-bottom: 200px;">
<div class="col-md-6 pl-5" style="border-color: black; border:3px">
    <div class="row justify-contend-end">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-upperccase">Total carrito</h3>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo $total ?></strong>
                </div>
            
                
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                    <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                    <strong class="text-black cant<?php echo $arregloCarrito[$i]['Id']; ?>"><?php echo $total ?></strong>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <form action="../scripts/generar_orden.php" method="post">
    <input type="hidden" name="arregloCarrito" value="<?php echo htmlspecialchars(json_encode($arregloCarrito)); ?>">
    <button class="btn btn-primary btn-lg py-3 btn-block">Proceder compra</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    

   $(document).ready(function(){
        $(".btnEliminar").click(function(event){
            event.preventDefault();
            var id=$(this).data('id');
            var boton= $(this);
            $.ajax({
                method:'POST',
                url:'../scripts/eliminarCarrito.php',
                data:{
                    id:id
                }
            }).done(function(respuesta){
                boton.parent('td').parent('tr').remove();
                //window.location.href = '../views/carrito2.php';

            });
        });

    $(".txtCantidad").on('keyup input', function () {
        var cantidad = parseInt($(this).val());
        var max = parseInt($(this).attr('max'));
        if (!isNaN(cantidad)) {
            if (!isNaN(max) && cantidad > max) {
                $(this).val(max);
            } else if (cantidad < 1) {
                $(this).val(1);
            }
        } else {
            $(this).val(1);
        }
        actualizarTotal(this);
    });

    function actualizarTotal(input) {
        var cantidad = parseInt($(input).val());
        var precio = parseFloat($(input).data('precio'));
        var id = $(input).data('id');
        var mult = cantidad * precio;
        $(".cant" + id).text("$" + mult.toFixed(2));
        $.ajax({
            method: 'POST',
            url: '../scripts/actualizar.php',
            data: {
                id: id,
                cantidad: cantidad
            }
        }).done(function (respuesta) {
            // ... (otras partes de tu código) ...
        });
    }
    });


    
</script>

<script>

function incrementarValor() {
    var input = document.getElementById('txtCantidad');
    var valor = parseInt(input.value);
    input.value = (isNaN(valor) ? 0 : valor) + 1;
}

function decrementarValor() {
    var input = document.getElementById('txtCantidad');
    var valor = parseInt(input.value);
    if(valor>1){
            input.value = (isNaN(valor) ? 0 : valor) - 1;

    }
    
}
function validarMaximo(event, input) {
 var valor = parseInt(input.value);
  var min = parseInt(input.getAttribute('min'));
  var max = parseInt(input.getAttribute('max'));

  if (!isNaN(valor)) {
    if (!isNaN(min) && valor < min) {
      input.value = min; // Restringe el valor al mínimo permitido
    } else if (!isNaN(max) && valor > max) {
      input.value = max; // Restringe el valor al máximo permitido
    }
  }
}

function Actualizar(){
    
}


        


    </script>



</body>
</html>