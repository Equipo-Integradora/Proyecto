
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

<div class="container" style="width: 100%; ">
    <h1 class="titu">Productos Generales</h1>
    <div class="row">
        <div style="width: 20%; height:100%;">
            <div class="container">
                <h2>Categorías</h2>
                <ul class='list-group'>
                <?php
                foreach ($cat as $index => $ca) { ?>
                    <li class="list-group-item" data-toggle="collapse" data-target="#subtemas<?php echo $index?>">
                     <?php echo $ca->nombre_categoria ?>
                    </li>
                    <?php
                        $consulta2 = "SELECT tipo_categorias.nombre_tipo_categoria
                        FROM tipo_categorias INNER JOIN categorias ON categorias.id_categoria = tipo_categorias.categoria_tipo_catergoria_FK
                        WHERE categorias.id_categoria = '$ca->id_categoria';";
                    $cat_ti = $conexion->cat_tip($consulta2);
                    ?>
                    <div id="subtemas<?php echo $index ?>" class="collapse">
                        <ul class="list-group">
                   <?php foreach ($cat_ti as $c) { ?>
                      <li class="list-group-item" style="color: red;"><?php echo $c->nombre_tipo_categoria?></li>
                   <?php } ?>                   
                        </ul>
                    </div>
                    <?php
                }
                ?>
                </ul>
            </div>
        </div>

            <div class="col-9" style="width: 80%;">

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
    <h4 class="product-title"><?php echo $reg->nombre_producto; ?> </h4>
    <div class="price precio">
   <?php echo'$'.$reg->precio_producto; ?>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/listas.js"></script>

    <script>
  // JavaScript para cambiar el título de la pestaña
  // Asegúrate de que este código se encuentre dentro del <head> o antes del cierre del </body>

  // Función que cambia el título de la pestaña
  function cambiarTituloPestana(nuevoTitulo) {
    document.title = nuevoTitulo;
  }

  // Evento para cuando el usuario está en la página (foco en la página)
  window.addEventListener("focus", function() {
    cambiarTituloPestana("Sweet Beauty");
  });

  // Evento para cuando el usuario abandona la página (pierde el foco)
  window.addEventListener("blur", function() {
    cambiarTituloPestana("sweet beauty");
  });
</script>

</body>
</html>
