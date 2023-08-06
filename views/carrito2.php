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
<div class="row" >
    <div class="col-lg-8 col-12" style="padding: 10px;">
        <!--Ciclo-->
        <?php
                    $total = 0;
                    

$boton="";

if(empty($_SESSION['carrito']))
{
    $boton="disabled";
}


        if(isset($_SESSION['carrito'])) {
                $arregloCarrito=$_SESSION['carrito'];
                for($i=0;$i<count($arregloCarrito);$i++){
                    $total= $total+($arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad']);
                    if($arregloCarrito[$i]['Cantidad']>$arregloCarrito[$i]['Maximo']){
                        $arregloCarrito[$i]['Cantidad']=$arregloCarrito[$i]['Maximo'];
                    }
             ?>

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
                    <div class="col-4 ">
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
                    <div class="col-12">
                        <a id="mensaje" href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id'];?>">Borrar</a>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 5px;">
        </div>
        <?php
        }
    }
    else
    { ?>
      
<div class="row" style="text-align: center; background-color:white">
            <div class="col-12"><img src="../img/carrito/vacio.png" alt=""></div>
            <div class="col-12"><p><b>TU BOLSA ESTÁ VACÍA</b></p></div>
            <div class="col-12"><p style="text-transform: lowercase; color:gray">Vamos de compras a llenar tu bolsa</p></div>
            <div class="col-12" style="text-align: center;">
                <a href="../views/ver_producto_general.php" style="text-decoration: none;">
                <button type="button" class="btn btn-lg" style="background-color: pink;">COMPRAR AHORA</button>
    
                
                </a>
            </div>
        </div>
      <?php
    }
        ?>
    </div>
    <div class="col-4" style=" padding: 10px">
    <div class="container" style="background-color: white; width:280px; height: 210px;" >
<div class="justify-contend-end" style="border-color: black; border:3px;">
            <div class="row">
                <div class="col-12 text-center border-bottom">
                    <h3 class="text-black h4 text-upperccase">Total carrito</h3>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <span class="text-black">Subtotal</span>
                </div>
                <div class="col-6 text-right">
                    <strong id="total-container" class="text-black cant<?php echo $arregloCarrito[$i]['Id']; ?>">$<?php echo $total ?></strong>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <span class="text-black">Total</span>
                </div>
                <div class="col-6 text-right">
                    <strong id="total-container" class="txtCantidad text-black tot<?php echo $arregloCarrito[$i]['Id']; ?>">$<?php echo $total ?></strong>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" style="text-align: center;">
                <br> 
                <form action="../scripts/generar_orden.php" method="post">
    <input type="hidden" name="arregloCarrito" value="<?php echo htmlspecialchars(json_encode($arregloCarrito)); ?>">
    <button id="si" <?php echo $boton ?> class="btn btn-primary btn-lg py-3 btn-block">Proceder compra</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    
    document.getElementById("si").addEventListener("click", function() {
  // Código que se ejecuta cuando se hace clic en el botón

        var arreglo = <?php echo json_encode($_SESSION['carrito']); ?>;

    for (var i = 0; i < arreglo.length; i++) {
        var id = arreglo[i]['Id'];
            var boton= $(this);
            $.ajax({
                method:'POST',
                url:'../scripts/eliminarCarrito.php',
                data:{
                    id:id
                }
            }
            ).done(function(respuesta){
                boton.parent('a').parent('div').parent('div').remove();
                //location.reload();
                //window.location.href = '../views/carrito2.php';

            });
        }
    
});

   $(document).ready(function(){
    

        $(".btnEliminar").click(function(event){
                alert("¡Hola! Has hecho clic en el botón.");

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
                boton.parent('a').parent('div').parent('div').remove();
                location.reload();
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
        var tot = tot+mult;
        $(".cant" + id).text("Total por cantidad $" + mult.toFixed(2));
        $(".tot" + id).text("$" + tot.toFixed(2));        
        $.ajax({
            method: 'POST',
            url: '../scripts/actualizar.php',
            data: {
                id: id,
                cantidad: cantidad
            }
        }).done(function (respuesta) {
        });
    }
    });
    function si(){
        alert(hola);


    }
    function actualizarTotall() {
        var total = 0;
        // Recorre todos los elementos del carrito y suma los totales de cada producto
        <?php
        if(isset($arregloCarrito)) {
            for($i=0; $i<count($arregloCarrito); $i++) {
                echo "total += " . $arregloCarrito[$i]['Precio'] . " * " . $arregloCarrito[$i]['Cantidad'] . ";";
            }
        }
        ?>
        // Actualiza el valor del elemento en el DOM con el nuevo total
        document.getElementById('total-container').innerText = "$" + total.toFixed(2);
    }

    // Llama a la función actualizarTotal al cargar la página
    actualizarTotall();

    // Ahora, utiliza la función actualizarTotal cada vez que se actualice la cantidad de un producto
    $(document).ready(function() {
        $(".txtCantidad").on('keyup input', function() {
            actualizarTotall();
        });
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