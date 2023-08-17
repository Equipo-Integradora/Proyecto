<?php
session_start();
include "../templates/sidebar.php";

$conexion = new database();
$conexion->conectarDB();
if(!isset($_SESSION["admin"])){

    header("../index.php");
    exit;
 }
?>
<style>
    .productito {
        height:30%;
        width: 30%;
        padding: auto;
    }

    .mod {
        text-align: right;
    }

    .bot {
        color: #e84393;
        padding: 1rem;
        background-color: transparent;
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
        th, td {
            
            text-align: left;
            white-space: normal; /* Permite que el contenido fluya hacia abajo */
            overflow: hidden; /* Oculta el contenido que excede el ancho */
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
    <button type="button" class="btn boton" id="nuevocolor">
        Nuevo color
    </button>
</div>

<!-- Modal de ingreso -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Producto Nuevo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../scripts/ingresar_producto.php" method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="producto">Nombre del Producto</label>
                        <input type="text" class="input" name="producto" maxLength="100" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <label for="descripcion">Descripción del Producto</label>
                        <textarea name="descripcion" class="sexarea" id="miTextarea" maxLength="1000" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="input-field">
                        <label for="precio">Precio del Producto</label>
                        <input type="number" class="input" name="precio" required>
                    </div>
                    <div class="input-field">
                        <label for="categoria" class="form-label">Categoria</label>
                        <?php
                        $cat = "SELECT * FROM sweet_beauty.categorias;";
                        $tabla = $conexion->seleccionar($cat);
                        ?>

                        <select class="form-select form-select-md" name="categoria" id="categorias" required>
                            <?php foreach ($tabla as $cate) { ?>
                                <option value="<?php echo $cate->id_categoria ?>"> <?php echo $cate->nombre_categoria ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="tipocatcat" class="form-label">Tipo de Categoria</label>

                        <select class="form-select form-select-md" name="tipocat" id="tipocat" required>   
                                
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="colors">Color</label>
                        <?php
                        $cat = "SELECT * FROM sweet_beauty.colores;";
                        $tabla = $conexion->seleccionar($cat);
                        ?>

                        <select class="form-select form-select-md" name="colors" id="colors" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <?php foreach ($tabla as $cate) { ?>
                                <option value="<?php echo $cate->id_color ?>"> <?php echo $cate->nombre_color ?></option>
                            <?php } ?>
                        </select><br>
                    </div>
                
                    <div class="input-field">
                        <label for="existencias">Existencias</label>
                        <input type="number" class="input" name="existenciass" id="existenciass" min="1" required>
                    </div>
                   
                    <div class="input-field">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" required>
                    </div>

                    <div class="input-field" style="margin-top: 1rem;">
                        <input style="margin-bottom: .5rem;" type="submit" class="submit" value="Ingresar Producto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 p-3">
    <form method="post">
    <div class="col-6">
                <label for="buscar"><h3 class="fw-bold">Buscar Producto</h3></label> <br>
                    <input type="text" name="busqueda" placeholder="buscar..." class="form-control mt-2 ">
            </div>
                                <br>

        <div class="col-12">
            <label class="form-label">
                <h3 class="fw-bold">Filtros por <a href=""><span class="bi bi-info-square"></span></a></h3>
            </label>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <select name="produc" class="form-control mt-2">
                                <option value="exitencias">Con existencias </option>
                                <option value="notexistencias">Sin existencias </option>
                                <option value="MasDetalles">Mas detalles </option>
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
if ($_POST) {
    if ($produc == "exitencias") {
        $productos = " SELECT * FROM sweet_beauty.`productos generales`right join 
        (select id_detalle_producto as idetalle, id_color as id_color, `descripcion_producto` as descripcion,
         `categoria_producto_FK` as id_tipo_cat from
         productos inner join detalle_productos on id_producto=`detalle_producto_detalle_producto_FK` inner join
        colores on id_color= `color_detalle_producto_FK`) as luk on luk.idetalle=id_detalle_producto";
    }else if($produc == "notexistencias"){
        $productos = "SELECT * FROM sweet_beauty.productos_sin_existencias";
    }else if($produc=="MasDetalles"){
        $productos="SELECT * FROM sweet_beauty.`productos para seguir detallando` inner join (select
        id_producto as id, descripcion_producto from productos) as luky on luky.id=id_producto";
    }
    $ostia=" WHERE nombre_producto like '$busqueda%'";
    if(isset($busqueda)){
        $productos=$productos.$ostia;
    }
    $productos=$productos."GROUP BY nombre_producto";
        $tablap = $conexion->seleccionar($productos);  
        if(empty($tablap))
        {
            echo "<p class='text-center'>No se encontraron resultados</p>";
        }else
        {
        ?>
            <div class="table-responsive container-fluid">
                <table class="table shadow-sm table-hover">
                    <thead>
                        <tr>
                       <?php if($produc== "MasDetalles"){  ?>
                            <th>Producto</th>
                            <th>Decripción</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Detallar Producto</th>
                
                           <?php }else{?>
                            <th>Producto</th>
                            <th>Color</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <?php if($produc=="exitencias"){?>
                            <th>Existencias</th>
                            <?php }?>
                            <th>Imagen</th>
                            <th>Editar Producto</th>
                            
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                   <?php foreach ($tablap as $reg) { ?>
                    <?php if($produc== "MasDetalles"){  

                    echo "<tr>";
                    echo "<td > $reg->nombre_producto</td>";
                    echo "<td> $reg->descripcion_producto</td>";
                    echo "<td> $$reg->precio_producto</td>";
                    echo "<td> $reg->nombre_tipo_categoria</td>";
                    echo "<td>"; ?>
                           <?php }else { 
                   
                            echo "<tr>";
                            echo "<td> $reg->nombre_producto</td>";
                            echo "<td> $reg->nombre_color</td>";
                             echo "<td> $$reg->precio_producto</td>";
                            echo "<td> $reg->nombre_tipo_categoria</td>";
                            if($produc=="exitencias"){
                            echo "<td> $reg->existencias_detalle_producto</td>";
                            }
                         echo "<td> <img class='productito' src='../img/productos/" . $reg->imagen_detalle_producto . "' alt'" . $reg->imagen_detalle_producto . "'></td>";
                            echo "<td>"; 
                           }?>
                            <!-- Button trigger modal -->
                            <?php
                            if($produc== "MasDetalles"){
                            ?>
             <button type="button" class="bot btn-detallar" 
             data-bs-toggle="modal" data-bs-target="#detalleModal"
             data-idproducto="<?php echo $reg->id_producto; ?>">
                        Detallar Producto
                    </button>
                            <?php
                            }else if($produc=="exitencias"){
                            ?>
                            <button type="button" class="bot btn-edit" 
                            data-bs-toggle="modal" 
                            data-bs-target="#EexampleModal"
                            data-nombre="<?php echo $reg->nombre_producto ?>"
                            data-color="<?php echo $reg->id_color ?>"
                            data-descripcion="<?php echo $reg->descripcion?>"
                            data-precio="<?php echo $reg->precio_producto ?>"
                            data-tipocat="<?php echo $reg->id_tipo_cat ?>"
                            data-existencias="<?php echo $reg->existencias_detalle_producto ?>"
                            data-idproducto="<?php echo $reg->id_producto ?>"
                            data-idetalles="<?php echo $reg->idetalle ?>"
                            >
                                Editar Producto
                            </button>
                            <?php
                           } else{ ?>
             <button type="button" class="bot btn-surt" 
             data-bs-toggle="modal" data-bs-target="#surtir"
             data-idetalle="<?php echo $reg->id_detalle_producto; ?>">
                        Surtir
                    </button>
                            <?php
                           } }?>
            </div>

        </td>

<tr>  
<?php } 
}?>    
        </tbody>
        </table>
        </div>
<!-- Modal De edicion chide-->
<div class="modal fade" id="EexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="modal-title fs-5" style="color: #e84393;">Edición De </span>Producto </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../scripts/actualizar_producto.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="producto" id="id_producto">
                    <input type="hidden" name="detallproducto" id="id_detallepro">
                    <div class="input-field">
                        <label for="nombre">Nombre del producto</label>
                        <input type="text" class="input" name="nombre" id="nombre" maxlength="100">
                    </div>
                    <div class="input-field">
                        <label for="descripcion">Descripción del Producto</label>
                        <textarea name="descripcion" class="sexarea" id="descripcion" cols="30" rows="5"></textarea>
                    </div>
                    <div class="input-field">
                        <label for="precio">Precio del producto</label>
                        <input type="number" class="input" name="precio" id="precio">
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
                        <input type="number" class="input" name="existencias" min="0" id="existencias">
                    </div>
                   
                    <div class="input-field">
                        <label for="ima">Imagen</label>
                        <input type="file" name="ima" id="ima" accept="image/*">
                    </div>
                   
                    <div class="input-field" style="margin-top: 1rem;">
                        <input style="margin-bottom: .5rem;" type="submit" name="actualizar" class="submit" value="Guardar">
                        
                          
                    </div>
                </form>
          
            </div>
        </div>
    </div>
</div>

    <!-- Modal De detallado -->
    <div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detallar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="miFormulario" action="../scripts/detallar_productos.php" method="post" enctype="multipart/form-data">
                        <div id="mensaje-confirmacion" style="display: none;"></div>
                        <input type="hidden" name="producto" id="iddeproducto">
                        <div class="input-field">
                            <label for="existencias">Existencias</label>
                            <input type="number" class="input" name="existencias" min="1" required>
                        </div>
                        <div class="input-field">
                            <label for="color">Color</label>
                            <?php
                            $cat = "SELECT * FROM sweet_beauty.colores;";
                            $tabla = $conexion->seleccionar($cat);
                            ?>
                            <select class="form-select form-select-md" name="color" id="" required>
                                <option value="" disabled selected>Selecciona una opción</option>
                                <?php foreach ($tabla as $cate) { ?>
                                    <option value="<?php echo $cate->id_color ?>"> <?php echo $cate->nombre_color ?></option>
                                <?php } ?>
                            </select><br>
                        </div>
                        <div class="input-field">
                            <label for="ima">Imagen</label>
                            <input type="file" name="ima" id="ima" accept="image/*" required>
                        </div>
                </div>
                <div class="input-field" style="margin-top: 1rem;">
                    <input style="margin-bottom: .5rem;" type="submit" class="submit" value="Ingresar Producto">
                </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Modal De surtido -->
        <div class="modal fade" id="surtir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">repuesto de Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formsurt" action="../scripts/actualizar_producto.php" method="post">
                        <input type="hidden" name="productor" id="iddeproductos">
                        <div class="input-field">
                            <label for="surt">Existencias</label>
                            <input type="number" class="input" name="surt" min="1" id="na" required>
                        </div>
                </div>
                <div class="input-field" style="margin-top: 1rem;">
                    <input style="margin-bottom: .5rem;" type="submit" name="surtir" class="submit" value="Surtir">
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>
<script>    
$('.btn-detallar').on('click',function (){
var id_producto=$(this).data('idproducto');
$('#iddeproducto').val(id_producto);
$('#detalleModal').modal('show');
});
</script>

<script>
        $('.btn-edit').on('click', function () {
            var id_producto = $(this).data('idproducto');
            var id_detalle = $(this).data('idetalles');
            var nombreproducto = $(this).data('nombre');
            var precio = $(this).data('precio');
            var descripcion = $(this).data('descripcion');
            var existencias = $(this).data('existencias');
            var tipocat = $(this).data('tipocat');
            var color = $(this).data('color');

            $('#id_producto').val(id_producto);
            $('#id_detallepro').val(id_detalle);
            $('#nombre').val(nombreproducto);
            $('#categoria').val(tipocat);
            $('#precio').val(precio);
            $('#descripcion').val(descripcion);
            $('#existencias').val(existencias);
            $('#color').val(color);

            $('#EexampleModal').modal('show');
        });
</script>
<!--script para que se pongan los tipos de categorias-->
<script>
    function actualizarsub(categoria){
        $.ajax({
      type: 'POST',
      url: '../class/tipocats.php',
      data: { categoria: categoria }, // Enviar el valor de la categoría seleccionada
      dataType: 'json',
      success: function(data) {
        // En caso de éxito, actualizar el select de Subcategorías con las opciones recibidas
        $('#tipocat').show();
        $('#tipocat').empty(); // Limpiar opciones anteriores
        $.each(data, function(key, value) {
          $('#tipocat').append('<option value="' + value.id_tipo_categoria + '">' + value.nombre_tipo_categoria + '</option>');
        });
      },
      error: function() {
        // En caso de error, mostrar un mensaje de error 
        alert('Ha ocurrido un error al obtener las subcategorías.');
      }
    });
    };
$('#categorias').change(function(){
var categorias =$(this).val();
actualizarsub(categorias);
});
$(document).ready(function() {
    var categoriaSelected = $('#categorias').val();
    actualizarsub(categoriaSelected);
  });
</script>

<script>
    $('.btn-surt').on('click',function(){
      var iddd=$(this).data('idetalle');
      $('#iddeproductos').val(iddd);
    });
</script>
<script>
    function actualizarsub(categoria){
        $.ajax({
      type: 'POST',
      url: '../class/tipocats.php',
      data: { categoria: categoria }, // Enviar el valor de la categoría seleccionada
      dataType: 'json',
      success: function(data) {
        // En caso de éxito, actualizar el select de Subcategorías con las opciones recibidas
        $('#tipocat').show();
        $('#tipocat').empty(); // Limpiar opciones anteriores
        $.each(data, function(key, value) {
          $('#tipocat').append('<option value="' + value.id_tipo_categoria + '">' + value.nombre_tipo_categoria + '</option>');
        });
      },
      error: function() {
        // En caso de error, mostrar un mensaje de error 
        alert('Ha ocurrido un error al obtener las subcategorías.');
      }
    });
    };
$('#categorias').change(function(){
var categorias =$(this).val();
actualizarsub(categorias);
});
$(document).ready(function() {
    var categoriaSelected = $('#categorias').val();
    actualizarsub(categoriaSelected);
  });
</script>
<script>
document.getElementById('nuevocolor').addEventListener('click', function() {
    Swal.fire({
        title: 'Ingrese su nuevo color:',
        html: '<input type="text" id="newcolor" class="swal2-input">',
        confirmButtonText: 'Guardar',
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {
            return document.getElementById('newcolor').value;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const informacion = result.value;
            guardarInformacion(informacion);
        }
    });
});

function guardarInformacion(informacion) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../scripts/ingresar_producto.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const respuesta = xhr.responseText; // Obtener la respuesta del servidor
            if (respuesta==="error") {

                Swal.fire('Error', 'Ya existe ese color', 'error');
                
            } else{

                Swal.fire('¡Guardado!', 'Color guardado correctamente', 'success');
                
            }
        } else {
            Swal.fire('Error', 'Ha ocurrido un error al intentar guardar la información.', 'error');
        }
    };
    
    xhr.send('informacion=' + encodeURIComponent(informacion));
}
</script>
</body>