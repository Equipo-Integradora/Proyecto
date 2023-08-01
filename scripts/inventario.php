<?php
session_start();
include "../templates/sidebar.php";

$conexion = new database();
$conexion->conectarDB();
?>
    <style>
        .productito
        {
          height: 30px;
          width: 30px;
          padding: auto;
        }

        .mod
        {
          text-align: right;
        }

        .bot
        {
            color: #e84393;
            padding: 1rem;
        }

        .sexarea
        {
            width: 100%;
            max-height: 150px; 
            resize: vertical; 
        }
        
        a
        {
            text-decoration: none;
            color: #e84393;
        }
        
    </style>

    <link rel="stylesheet" href="../css/login.css">
    
    <div class="text-center">
        <h3 class="m-0">Inventario</h3>
    </div>
    <div class="mod px-4 p-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn boton" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Ingresar Producto
    </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Producto Nuevo</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../scripts/ingresar_producto.php" method="post">
                        <div class="input-field">
                            <label for="producto">Nombre del Producto</label>
                            <input type="text" class="input" name="producto" required autocomplete="off">
                        </div>
                        <div class="input-field">
                            <label for="descripcion">Descripción del Producto</label>
                            <textarea name="descripcion" class="sexarea" id="miTextarea" cols="30" rows="5" required></textarea> 
                        </div>
                        <div class="input-field">
                            <label for="precio">Precio del Producto</label>
                            <input type="text" class="input" name="precio" required>
                        </div>
                        <div class="input-field">
                        <label for="cat" class="form-label">Tipo de Categoria</label>
                        <?php
                        $cat = "SELECT * FROM sweet_beauty.tipo_categorias;";
                        $tabla = $conexion->seleccionar($cat);
                        ?>

                            <select class="form-select form-select-md" name="cat" id="">
                                <?php foreach ($tabla as $cate) { ?>
                                <option value="<?php echo $cate->id_tipo_categoria ?>"> <?php echo $cate->nombre_tipo_categoria ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="input-field" style="margin-top: 1rem;">
                            <input type="submit" class="submit" value="Ingresar Producto">      
                        </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container-fluid px-4 p-3">
    <form method="post">


        <div class="col-12">
        <label  class="form-label"><h3 class="fw-bold">Filtros por</h3></label>
        <table class="table">
            <thead>
               <tr>
               <th>
                   <select name="produc" class="form-control mt-2" >
                    <option value="exitencias">Con existencias</option>
                    <option value="notexistencias">Sin existencias</option>
                    <option value="sindetalle">Sin detalle</option>
                    </select>
                </th>
                <th>
                    <div class="d-grid gap-2 mx-auto">
                    <button class="btn boton" type="submit">Ver</button>
                    </div>
                </th>
               </tr>
            </thead>
        </table>
        </div>
    </form>
    </div>

    <?php
    extract($_POST);
    if ($_POST)
    {
        if($produc == "exitencias")
        {
            $productos = "SELECT * FROM sweet_beauty.`productos generales`;";
            $tablap = $conexion->seleccionar($productos);
            {?>
            <div class="table-responsive container-fluid">
                    <table class="table shadow-sm table-hover">
                        <thead>
                        <tr>
                               <th>Producto</th>
                               <th>Color</th>
                               <th>Precio</th>
                               <th>Categoria</th>
                               <th>Existencias</th>
                               <th>Imagen</th>
                               <th>Editar Producto</th>
                               </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            $modale = 0;
                                foreach($tablap as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->nombre_producto</td>";
                                echo "<td> $reg->nombre_color</td>";
                                echo "<td> $reg->precio_producto</td>";
                                echo "<td> $reg->nombre_tipo_categoria</td>";
                                echo "<td> $reg->existencias_detalle_producto</td>";
                                echo "<td> <img class='productito' src='../img/productos/".$reg->imagen_detalle_producto."' alt'".$reg->imagen_detalle_producto."'></td>";
                                echo "<td>";?>
                                    
                                            <!-- Button trigger modal -->
                                            <button type="button" class="bot" data-bs-toggle="modal" data-bs-target="#EexampleModal<?php echo $modale?>">
                                              Editar Producto
                                            </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="EexampleModal<?php echo $modale?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="modal-title fs-5" style="color: #e84393;">Edición De</span> <?php echo "$reg->nombre_producto"?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="../scripts/actualizar_producto.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="producto" value="<?php echo "$reg->id_producto"?>">
                                                                <input type="hidden" name="detallproducto" value="<?php echo "$reg->id_detalle_producto"?>">
                                                                <div class="input-field">
                                                                    <label for="nombre">Nombre del producto</label>
                                                                    <input type="text" class="input" name="nombre">
                                                                </div>
                                                                <div class="input-field">
                                                                     <label for="descripcion">Descripción del Producto</label>
                                                                     <textarea name="descripcion" class="sexarea" id="miTextarea" cols="30" rows="5"></textarea> 
                                                                 </div>
                                                                <div class="input-field">
                                                                    <label for="precio">Precio del producto</label>
                                                                    <input type="number" class="input" name="precio">
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="categoria">Tipo de Categoria</label>
                                                                    <?php
                                                                    $cat = "SELECT * FROM sweet_beauty.tipo_categorias;";
                                                                    $tabla = $conexion->seleccionar($cat);
                                                                    ?>

                                                                        <select class="form-select form-select-md" name="categoria" id="categoria">
                                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                                            <?php foreach ($tabla as $cate) { ?>
                                                                            <option value="<?php echo $cate->id_tipo_categoria ?>"> <?php echo $cate->nombre_tipo_categoria ?></option>
                                                                            <?php } ?>
                                                                        </select><br>
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="color">Color</label>
                                                                    <?php
                                                                    $cat = "SELECT * FROM sweet_beauty.colores;";
                                                                    $tabla = $conexion->seleccionar($cat);
                                                                    ?>

                                                                        <select class="form-select form-select-md" name="color" id="color">
                                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                                            <?php foreach ($tabla as $cate) { ?>
                                                                            <option value="<?php echo $cate->id_color ?>"> <?php echo $cate->nombre_color ?></option>
                                                                            <?php } ?>
                                                                        </select><br>
                                                                </div>                                                                
                                                                <div class="input-field">
                                                                    <label for="existencias">Existencias</label>
                                                                    <input type="number" class="input" name="existencias">
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="ima">Imagen</label>
                                                                    <input type="file" name="ima" id="ima" accept="image/jpg" required>
                                                                </div>
                                                                <div class="input-field" style="margin-top: 1rem;">
                                                                    <input type="submit" class="submit" value="Ingresar Producto">      
                                                                </div>
                                                    </form>
                                                        <?php $modale++; ?>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    <?php "</td>";
                                echo "<tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
        }else if($produc == "notexistencias")
        {
            $productos = "SELECT * FROM sweet_beauty.productos_sin_existencias;";
            $tablap = $conexion->seleccionar($productos);
            {?>
                <div class="table-responsive container-fluid">
                        <table class="table shadow-sm table-hover">
                            <thead>
                            <tr>
                                   <th>Producto</th>
                                   <th>Color</th>
                                   <th>Precio</th>
                                   <th>Categoria</th>
                                   <th>Imagen</th>
                                   <th>Editar Producto</th>
                                   </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $modals = 0;
                                    foreach($tablap as $reg)
                                {
                                    echo "<tr>";
                                    echo "<td> $reg->nombre_producto</td>";
                                    echo "<td> $reg->nombre_color</td>";
                                    echo "<td> $reg->precio_producto</td>";
                                    echo "<td> $reg->nombre_tipo_categoria</td>";
                                    echo "<td> <img class='productito' src='../img/productos/".$reg->imagen_detalle_producto."' alt'".$reg->imagen_detalle_producto."'></td>";
                                    echo "<td>";?>
                                    
                                            <!-- Button trigger modal -->
                                            <button type="button" class="bot" data-bs-toggle="modal" data-bs-target="#SexampleModal<?php echo $modals?>">
                                              Editar Producto
                                            </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="SexampleModal<?php echo $modals?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="modal-title fs-5" style="color: #e84393;">Edición De</span> <?php echo "$reg->nombre_producto"?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                  <form action="../scripts/actualizar_producto.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="producto" value="<?php echo "$reg->id_producto"?>">
                                                                <input type="hidden" name="detallproducto" value="<?php echo "$reg->id_detalle_producto"?>">
                                                                <div class="input-field">
                                                                    <label for="nombre">Nombre del producto</label>
                                                                    <input type="text" class="input" name="nombre">
                                                                </div>
                                                                <div class="input-field">
                                                                     <label for="descripcion">Descripción del Producto</label>
                                                                     <textarea name="descripcion" class="sexarea" id="miTextarea" cols="30" rows="5"></textarea> 
                                                                 </div>
                                                                <div class="input-field">
                                                                    <label for="precio">Precio del producto</label>
                                                                    <input type="number" class="input" name="precio">
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="categoria">Tipo de Categoria</label>
                                                                    <?php
                                                                    $cat = "SELECT * FROM sweet_beauty.tipo_categorias;";
                                                                    $tabla = $conexion->seleccionar($cat);
                                                                    ?>

                                                                        <select class="form-select form-select-md" name="categoria" id="categoria">
                                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                                            <?php foreach ($tabla as $cate) { ?>
                                                                            <option value="<?php echo $cate->id_tipo_categoria ?>"> <?php echo $cate->nombre_tipo_categoria ?></option>
                                                                            <?php } ?>
                                                                        </select><br>
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="color">Color</label>
                                                                    <?php
                                                                    $cat = "SELECT * FROM sweet_beauty.colores;";
                                                                    $tabla = $conexion->seleccionar($cat);
                                                                    ?>

                                                                        <select class="form-select form-select-md" name="color" id="color">
                                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                                            <?php foreach ($tabla as $cate) { ?>
                                                                            <option value="<?php echo $cate->id_color ?>"> <?php echo $cate->nombre_color ?></option>
                                                                            <?php } ?>
                                                                        </select><br>
                                                                </div>                                                                
                                                                <div class="input-field">
                                                                    <label for="existencias">Existencias</label>
                                                                    <input type="number" class="input" name="existencias">
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="ima">Imagen</label>
                                                                    <input type="file" name="ima" id="ima">
                                                                </div>
                                                                <div class="input-field" style="margin-top: 1rem;">
                                                                    <input type="submit" class="submit" value="Ingresar Producto">      
                                                                </div>
                                                    </form>
                                                        <?php $modals++; ?>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    <?php "</td>";
                                echo "<tr>";
                                    echo "<tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
            
        }else if($produc == "sindetalle")
        {
            $productos = "SELECT * FROM sweet_beauty.`productos sin detalle`;";
            $tablap = $conexion->seleccionar($productos);
            {?>
                <div class="table-responsive container-fluid">
                        <table class="table shadow-sm table-hover">
                            <thead>
                            <tr>
                                   <th>Producto</th>
                                   <th>Decripción</th>
                                   <th>Precio</th>
                                   <th>Categoria</th>
                                   <th>Detallar Producto</th>
                                   </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                
                                    $modal = 0;
                                    foreach($tablap as $reg)
                                {
                                    echo "<tr>";
                                    echo "<td> $reg->nombre_producto</td>";
                                    echo "<td> $reg->descripcion_producto</td>";
                                    echo "<td> $reg->precio_producto</td>";
                                    echo "<td> $reg->nombre_tipo_categoria</td>";
                                    echo "<td>";?>
                                    
                                            <!-- Button trigger modal -->
                                            <button type="button" class="bot" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $modal?>">
                                              Detallar Producto
                                            </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $modal?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detallar <?php echo "$reg->nombre_producto"?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                  <form id="miFormulario" action="../scripts/detallar_productos.php" method="post" onsubmit="enviarFormulario(event)" enctype="multipart/form-data">
                                                    <div id="mensaje-confirmacion" style="display: none;"></div>
                                                                    <input type="hidden" name="producto" value="<?php echo "$reg->id_producto"?>">
                                                                <div class="input-field">
                                                                    <label for="existencias">Existencias</label>
                                                                    <input type="number" class="input" name="existencias" required>
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="color">Color</label>
                                                                    <?php
                                                                    $cat = "SELECT * FROM sweet_beauty.colores;";
                                                                    $tabla = $conexion->seleccionar($cat);
                                                                    ?>

                                                                        <select class="form-select form-select-md" name="color" id="">
                                                                            <option value="" disabled selected>Selecciona una opción</option>
                                                                            <?php foreach ($tabla as $cate) { ?>
                                                                            <option value="<?php echo $cate->id_color ?>"> <?php echo $cate->nombre_color ?></option>
                                                                            <?php } ?>
                                                                        </select><br>
                                                                </div>
                                                                <div class="input-field">
                                                                    <label for="color">Imagen</label>
                                                                    <input type="file" name="ima" id="ima">
                                                                </div>
                                                                 
                                                                
                                                                </div>
                                                                        
                                                                <div class="input-field" style="margin-bottom: 1rem; margin-top: 1rem;">
                                                                    <input type="submit" class="submit" value="Ingresar Producto">      
                                                                </div>
                                                    </form>
                                                        <?php $modal++; ?>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    <?php "</td>";
                                    echo "<tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
            
        }
    
    }
    ?>
    
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function enviarFormulario(event) {
    event.preventDefault(); 

    var formData = new FormData(document.getElementById('miFormulario'));

    $.ajax({
      url: $('#miFormulario').attr('action'),
      type: $('#miFormulario').attr('method'),
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json', 
      success: function(response) {
        
        $('#mensaje-confirmacion').text(response.message).show();

        $('#miFormulario')[0].reset();
      },
      error: function() {
        alert('El producto se ha subido.');
      }
    });
  }
</script>
<script src="../prueba/js/clock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body> 