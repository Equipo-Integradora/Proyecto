
    <?php
    include "../templates/header.php";
    include "../class/database.php";

    $conexion = new database();
    $conexion->conectarDB();

    $consulta = "SELECT productos.nombre_producto, productos.precio_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto
    FROM detalle_productos INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
    INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK;";

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

<div class="container">
    <h1 class="titu">Productos Generales</h1>
    <div class="row">
        <div class="col-lg-3">
            <div class="container">
                <h2>Categorías</h2>
                <ul class='list-group'>
                <?php
                foreach ($cat as $index => $ca) {
                    echo "<li class='list-group-item' data-toggle='collapse' data-target='#subtemas$index'>";
                    echo "$ca->nombre_categoria";
                    echo "</li>";  
                    $consulta2 = "SELECT tipo_categorias.nombre_tipo_categoria
                        FROM tipo_categorias INNER JOIN categorias ON categorias.id_categoria = tipo_categorias.categoria_tipo_catergoria_FK
                        WHERE categorias.id_categoria = '$ca->id_categoria';";
                    $cat_ti = $conexion->cat_tip($consulta2);
                    echo "<div id='subtemas$index' class='collapse'>";
                    echo "    <ul class='list-group'>";
                    foreach ($cat_ti as $c) {
                        echo "        <li class='list-group-item'>".$c->nombre_tipo_categoria."</li>";
                    }                    
                    echo "    </ul>";
                    echo "</div>";
                }
                ?>
                </ul>
            </div>
        </div>

            <div class="col-lg-9">
                <div class="row">
                    
                    <?php
foreach ($tabla as $reg) {
    echo "<div class='col-lg-4 d-flex flex-fill'>";
    echo "<div class='card'>";
    echo "<img class='card-img-top pro' src='../img/productos/".$reg->imagen_detalle_producto."' alt='...'>";
    echo "<div class='card-body text-center'>";
    echo "<div class='icons card-title'>"; echo "</div>";
    echo "<div class='card-text'>";
    echo "<h3 class='product-title'>".$reg->nombre_producto . "</h3>";
    echo "<div class='price precio'>";
    echo "$".$reg->precio_producto;
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
$conexion->desconectarDB();
?>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/listas.js"></script>

</body>
</html>
