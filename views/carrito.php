
<?php
session_start();
if(isset($_SESSION["usuario"]))
{
?>
        
<?php
    include "../templates/header.php";
    include "../class/database.php";

    $conexion = new database();
    $conexion->conectarDB();
    
    $consulta = "SELECT productos.nombre_producto, SUM(productos.precio_producto*detalle_orden_venta.cantidad_producto_orden_venta) AS 'precio', tipo_categorias.nombre_tipo_categoria, detalle_productos.imagen_detalle_producto, detalle_orden_venta.cantidad_producto_orden_venta
    FROM usuarios INNER JOIN orden_venta ON orden_venta.cliente_orden_venta_FK = usuarios.id_usuario
    INNER JOIN detalle_orden_venta ON detalle_orden_venta.orden_venta_detalle_orden_FK = orden_venta.id_venta
    INNER JOIN productos ON productos.id_producto = detalle_orden_venta.producto_orden_venta_FK
    INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
    INNER JOIN detalle_productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
WHERE orden_venta.estado_orden_venta = 'Pendiente' AND usuarios.nombre_usuario LIKE '%".$_SESSION["usuario"]."%'
    GROUP BY productos.nombre_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.imagen_detalle_producto, detalle_orden_venta.cantidad_producto_orden_venta;";

    $tabla = $conexion->seleccionar($consulta);

    
    $consulta1 = "SELECT *
    FROM categorias;";
    $cat = $conexion->cate($consulta1);

    $consulta3 = "SELECT productos.nombre_producto, productos.precio_producto, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto
    FROM detalle_productos INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
    INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
    Where tipo_categorias.nombre_tipo_categoria LIKE '%cat%';";
    $c_p = $conexion->cate_pro($consulta3);
    


    ?>
    <div class="m-5 col-9" style="width: 80%;">
                <div class="row">  
                <?php
foreach ($tabla as $reg) { ?>
    <div class="col-4" style="margin-top: 5px;margin-bottom:5px;">
    <div class="card" style="height: 400px;">
    <img class="card-img-top pro" src="../img/productos/<?php echo $reg->imagen_detalle_producto; ?>" 
    
    alt="...">
    <div class="card-body text-center">
    <div class="icons card-title"> </div>
    <div class="card-text">
    <h4 class="product-title"> <?php
                            $max_caracteres = 20;
                            $nombre_producto = $reg->nombre_producto;

                            
                             if (strlen($nombre_producto) > $max_caracteres) {
                                 echo substr($nombre_producto, 0, $max_caracteres) . '...';
                             } else {
                                 echo $nombre_producto;
                            }
                           ?>   </h4>
    <div class="price precio">
   <?php echo'$'.$reg->precio; ?><?php echo " Cantidad:".$reg->cantidad_producto_orden_venta; ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    <?php
}
$conexion->desconectarDB();
?>

                </div>
    
            </div>


        </div>
    </div>
    <?php
        include "../templates/footer.php"
    ?>
    <?php
    
}
else
{
    header("Location: ../views/login.php");
}
    ?>