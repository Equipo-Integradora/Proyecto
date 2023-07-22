<?php 
include "../templates/header.php";
?>

<?php 
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();
    $idpro=$_GET['id'];
    $query="SELECT * FROM productos inner join detalle_productos 
    on productos.id_producto=detalle_productos.detalle_producto_detalle_producto_FK left join  colores
    on colores.id_color=detalle_productos.color_detalle_producto_FK
    where detalle_productos.id_detalle_producto='$idpro'";
    $pro=$conexion->ejecuta($query);
?>


<div class="container" style="margin-top: 100px ; width: 100%;">
<div class="row">

<img class="col-4" style="height: 700px;" src="../img/productos/<?php echo $pro->imagen_detalle_producto?>" alt="...">
<div class="col-8"><h1><?php echo $pro->nombre_producto?></h1>
<?php 
if(!empty($pro->nombre_color)){
?>
<h2>Color: <?php echo $pro->nombre_color?></h2>
<?php
}
?>
<br>
<br>
<h2><?php echo '$'.$pro->precio_producto?></h2>
<br>
<div class="row" style="text-align: center;">
<div class="col-4"><h4>Existencias(<?php echo $pro->existencias_detalle_producto ?>)</h4></div>
<div class="col-3"> <form method="post" action="#">
        <!-- Input oculto para almacenar la cantidad actual -->
        <input type="hidden" name="cantidad" id="cantidad" value="1">
        <!--para que no pueda tomar mas de lo que hay-->
        <input type="hidden" name="maximo" id="maximo" value="<?php echo $pro->existencias_detalle_producto?>">   
        <button type="button" class="btn btn-outline-danger" style="width: 30%;" onclick="decrementarCantidad()">-</button>
        <span id="cantidad_actual" style="width: 30%;" >1</span>
        <button type="button" class="btn btn-outline-success"style="width: 30%;"  onclick="incrementarCantidad()">+</button>
        </div>
        <br>
        <button type="submit"  class="btn btn-outline-warning">Agregar al carrito</button>
    </form>
</div>
<br>
<p>
    <?php echo $pro->descripcion_producto?>
</p>



</div> 
</div>


<div class="row">
<?php
//Consulta para que cheque si hay varios productos iguales y sugerirlos
$con="select distinct id, imagen, nombre_producto, precio_producto, colorn
FROM suge inner join
(SELECT * FROM productos inner join detalle_productos 
on productos.id_producto=detalle_productos.detalle_producto_detalle_producto_FK left join  colores
on colores.id_color=detalle_productos.color_detalle_producto_FK
where detalle_productos.id_detalle_producto='$idpro') as uno
on suge.fk=uno.detalle_producto_detalle_producto_FK";
    $si=$conexion->ejecuta($con);

    if ($si->colorn !=null)
    {
        $sub="select distinct id, imagen, nombre_producto, precio_producto, colorn
        FROM suge inner join
        (SELECT * FROM productos inner join detalle_productos 
        on productos.id_producto=detalle_productos.detalle_producto_detalle_producto_FK left join  colores
        on colores.id_color=detalle_productos.color_detalle_producto_FK
        where detalle_productos.id_detalle_producto='$idpro') as uno
        on suge.fk=uno.detalle_producto_detalle_producto_FK
        where suge.id != '$idpro'";
            $va=$conexion->seleccionar($sub);

?>
        <h1 class="heading m-5">Podría <span>interesarte </span></h1>

<?php
            
        foreach($va as $am)
        {
       

         ?>

            <div class="col-4" style="margin-top: 5px;margin-bottom:5px; ">
                <div class="card" style="height: 450px;">
                <a style="margin: auto;" href="../views/verproducto.php?id=<?php echo $am->id ?> "><img href class="card-img-top pro" src="../img/productos/<?php echo $am->imagen; ?>" 
                
                alt="..."></a>
                <div class="card-body text-center">
                <div class="icons card-title"> </div>
                <div class="card-text">
                
                <a  href="../views/verproducto.php?id=<?php echo $am->id ?>"><h4 class="product-title"><?php echo $am->nombre_producto;?></h4></a>
                <a  href="../views/verproducto.php?id=<?php echo $am->id ?>"><h4 class="product-title">Color <?php echo $am->colorn;?></h4></a>
                


                <div class="price precio">
            <?php echo'$'.$am->precio_producto; ?>
                </div>
                </div>
                </div>
                </div>
                </div>
                
                <?php
        }
    }
?>

</div>

</div>

<br> <br>
<div >


</div>













    <script>
        // Función para decrementar la cantidad
        function decrementarCantidad() {
            var cantidad = parseInt(document.getElementById("cantidad").value);
            if (cantidad > 1) {
                cantidad -= 1;
                document.getElementById("cantidad").value = cantidad;
                document.getElementById("cantidad_actual").textContent = cantidad;
            }
        }

        // Función para incrementar la cantidad
        function incrementarCantidad() {
            var cantidad = parseInt(document.getElementById("cantidad").value);
            var max = parseInt(document.getElementById("maximo").value);
            if(cantidad<max){
            cantidad += 1;
            document.getElementById("cantidad").value = cantidad;
            document.getElementById("cantidad_actual").textContent = cantidad;
            }
        }


    </script>
</body>

</html>