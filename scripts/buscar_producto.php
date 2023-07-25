<?php
$perfil = false;
    include "../templates/header.php";
    include "../class/database.php";

    $conexion = new database();
    $conexion->conectarDB();

    extract($_POST);
    $consulta = "
    SELECT productos.nombre_producto, productos.precio_producto, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto
FROM detalle_productos INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
INNER JOIN colores ON colores.id_color = detalle_productos.color_detalle_producto_FK
INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
Where productos.nombre_producto LIKE '%$buscar%' OR colores.nombre_color LIKE '%$buscar%';
    ";

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
    <style>
    .content {
        text-align: left;
    }

    .content .right-align {
        text-align: right; 
    }
</style>

<div style="margin-left: 1rem;">
<!--Inicio del Carusel-->
<div style="margin-top: 5rem;" id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img style="width: 100%;" src="../img/productos/ban2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img style="width: 100%;" src="../img/productos/ban1.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!--Fin del Carusel-->

<!--Inicio de los tipos de categoria-->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="right-align">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <i class="bi bi-funnel-fill"></i>
    </button>
    </div>
    <?php
                foreach ($cat as $index => $ca) { ?>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $ca->nombre_categoria ?>
                        </a>
                        <?php
                        $consulta2 = "SELECT tipo_categorias.nombre_tipo_categoria
                        FROM tipo_categorias INNER JOIN categorias ON categorias.id_categoria = tipo_categorias.categoria_tipo_catergoria_FK
                        WHERE categorias.id_categoria = '$ca->id_categoria';";
                        $cat_ti = $conexion->cat_tip($consulta2);
                        ?>
                        <form action="../scripts/verproductos_cat.php" method="post">
                        <ul class="dropdown-menu">
                        <?php foreach ($cat_ti as $c) { ?>
                        
                              <li>
                              <?php echo "<a class='tcategoria'href='../scripts/verproductos_cat.php'>".$c->nombre_tipo_categoria."</a>"?>
                              </li>  
                   <?php } ?> 
                   
                   </ul>
                        </form>
                    
                      </li>
                    </ul>
                </div>
                    <?php
                }
                ?>
    
  </div>
</nav>

<!--Fin de los tipos de categoria-->

<!--Inicio de los productos-->
<div style="width: 100%;">
    <div class="row">
        <?php
        foreach ($tabla as $reg) { ?>
            <div class="col-lg-3 col-sm-12 grande chico" style="margin-top: 5px; margin-top:2rem;">
                <div class="card" style="height: 400px;">
                <a style="margin: auto;" href="../views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?> "><img href class="card-img-top pro" src="../img/productos/<?php echo $reg->imagen_detalle_producto; ?>" 

alt="..."></a>
                    <div class="card-body text-center">
                        <div class="icons card-title"></div>
                        <div class="card-text">
                        <a href="../views/verproducto.php?id=<?php echo $reg->id_detalle_producto ?>"><h4 class="product-title"><?php echo $reg->nombre_producto; ?> </h4></a>
                            <div class="price precio">
                                <?php echo '$' . $reg->precio_producto; ?>
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

<!--Fin de los productos-->
</div>
    <?php
        include "../templates/footer.php"
    ?>