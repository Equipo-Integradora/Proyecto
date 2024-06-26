
<?php  
session_start();
if(isset($_SESSION["usuario"]))
{
    $citas = true;
    $ordenes = false;
    $perfil = false;
    include "../templates/header.php";
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();
?>
 <!--Estilo para la informacion-->
    <style>
       .infoicon
       {
        color:black;
       }

       .infoicon:hover
       {
        color:#e84393;
       }
    </style>
    <!--Fin del estilo-->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/mis_citas.css">
<div>
<div class="cabecera">
<h1 class="mb-4" style="float: left;  width: 50%; margin-top: 7rem;">Mis <span>Citas</span>
<a class="infoicon" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
    <i class="bi bi-info-circle"></i>
</a>
</h1>
<!--Inicio de la guia-->

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel"><span style="color:#e84393;">Sweet</span> Beauty</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
        <div>
            <h5 class="offcanvas-title">Avisos</h5>
            <ul>
                <li>Aquí podrá ver sus citas.</li>
                <li>Podrá cancelar sus citas Pendientes y Aceptadas.</li>
                <li>Si cancela una cita, no la podrá activar y tendrá que agendar otra.</li>
            </ul>
        </div>
        <div>
            <h5 class="offcanvas-title">Guia</h5>
            Se puede filtrar sus citas:
            <ul>
                <li>Filtrar por fecha</li>
                <ol>
                    <li>Ingrese una fecha inicial</li>
                    <li>Ingrese una fecha final</li>
                    <li>Seleccione el boton de ver para filtrar por las fechas ingresadas</li>
                </ol>
                <li>Filtrar por estados:</li>
                <ol>
                    <li>Seleccione el estado por el que quiere ver sus citas</li>
                    <li>Seleccione el boton de ver para filtrar por las fechas ingresadas</li>
                </ol>
                <li>Se pueden filtrar sus citas usando los dos metodos mencionados</li>
            </ul>
            Se puede cancelar citas:
            <ol>
                <li>Busque las cita que quiere cancelar</li>
                <li>Seleccionar el icono de la tacha (<i class="bi bi-x"></i>)</li>
            </ol>
        </div>
      
    </div>
  </div>
</div>
<!--Fin de la guia-->


<!-- 
id_registro_cita
id_detalle_registro_cita
tipos_servicio
precio_cita
Descripcion
precio_total_cita
fecha_creacion_registro_cita
fecha_cita_registro_cita
hora_registro_cita
estado_registro_cita
-->

    
    <div class="container-fluid px-4 p-3">
    <form method="post">
       

        <div class="col-12 table-responsive">
        <label  class="form-label"><h3 class="fw-bold">Filtrar por</h3></label>
        <table class="table">
            <thead>
               <tr>
               <th>
                   <p class="fw-bold">Estado</p>
                   <select name="estado" class="form-control mt-2">
                   <option value="">Seleccionar</option>
                    <option value="Aceptada">Aceptadas</option>
                    <option value="Cancelada">Canceladas</option>
                    <option value="Pendiente">Pendientes</option>
                    </select>
                </th>
                <th>
                    <p class="fw-bold">Fecha Desde</p>
                    <input type="date" id="fecha_desde" name="fecha_desde" class="form-control mt-2">
                </th>
                <th>
                    <p class="fw-bold">Fecha Hasta</p>
                    <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control mt-2">
                </th>
                <th>
                    <div class="d-grid gap-2 mx-auto">
                    <button class="filtro" type="submit">Ver</button>
                    </div>
                </th>
               </tr>
            </thead>
        </table>
        </div>
    </form>
    </div>

<?php
$citas = "CALL historial_cita({$_SESSION["id"]});";

$con = 0;
extract($_POST);
if ($_POST) {
    if (empty($estado) && empty($fecha_desde) && empty($fecha_hasta)) {
        $con = 1;
        echo "<p class='fw-bold text-center'>Ingresa algún criterio para poder filtrar.</p>";
    } else {
        $citas = "SELECT *
        FROM sweet_beauty.`todas las citas`
        WHERE 1=1";

    if (!empty($estado)) {
        $citas .= " AND estado_registro_cita = '$estado'";
    } 

    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $citas .= " AND fecha_cita_registro_cita BETWEEN '$fecha_desde' AND '$fecha_hasta'";
    }
   
    $citas .= " AND id_usuario = '{$_SESSION["id"]}'";
    $citas .= " GROUP BY id_registro_cita";
        $con = 1;
    }
}
    $citas .= " ORDER BY fecha_cita_registro_cita ASC";
    $tablac = $conexion->seleccionar($citas);
    if (empty($tablac) && $con == 1) 
    {
       echo "<tr><td colspan='12'><p class='fw-bold text-center'>No se econtraron coincidencias .</p></td></tr>";
    }   
    if (empty($tablac) && $con == 0) 
    {
       echo "<tr><td colspan='12'><p class='fw-bold text-center'>Aún no cuentas con citas.</p></td></tr>";
        $con = 0;
    }
?>
<?php

?>
<section class="section-padding">
  <div class="container mb-4">
    <!--Inicio de los productos-->
<div style="width: 100%;">
    <div class="row">
        <?php
        $modal = 0;
        foreach ($tablac as $reg) {
            $servicios = explode(', ', $reg->tipos_servicio);
            $precios = explode(', ', $reg->precio_cita);
            ?>
            <div class="col-lg-3 col-sm-6 grande chico">
                <div class="card mb-4" style="height: 230px;">
                
                <div style="border-bottom-right-radius: 0; border-bottom-left-radius: 0; width: 100%;" class="<?php if ($reg->estado_registro_cita == "Aceptada") { echo 'badge text-bg-success';}else if ($reg->estado_registro_cita == "Cancelada"){ echo 'badge text-bg-danger';}else if ($reg->estado_registro_cita == "Pendiente"){echo 'badge text-bg-secondary';}?>">
                <div class="modal-header">
                   <h1 style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color: white;" class="modal-title fs-5" id="staticBackdropLabel">Cita: <?php echo $reg->fecha_cita_registro_cita?></h1>
                   <?php
                   if ($reg->estado_registro_cita == "Aceptada" OR $reg->estado_registro_cita == "Pendiente")
                    {?>
                    <form  action="../scripts/cancelar_cita.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $reg->id_registro_cita?>">
                   <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </form>
                    <?php
                    }
                    ?>
                 </div>  
                </div>
                
                <div>
                <!-- Button trigger modal -->
                <button style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; background-color: transparent;" type="button" data-bs-toggle="modal" data-bs-target="#modal<?php echo $modal?>">
                Ver mis servicios
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo $modal?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cita: <?php echo $reg->fecha_cita_registro_cita ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        


                    <?php for ($i = 0; $i < count($servicios); $i++) {
                        echo '<li>' . $servicios[$i];
                        if (!empty($precios[$i])) {
                            echo '<strong><br> $' . $precios[$i] . '</strong>';
                        }
                        echo '</li>';
                        echo '<br>';
                    }?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                    
                <button style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;" type="button" data-bs-toggle="modal" data-bs-target="#desc<?php echo $modal?>">
                Descripcion
                </button>
                <!-- Modal -->
                <div class="modal fade" id="desc<?php echo $modal?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cita: <?php echo $reg->fecha_cita_registro_cita ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        
                        <textarea class="text-left" style="width: 100%;" name="" id="" cols="0" rows="10" disabled><?php echo $reg->Descripcion;?></textarea>
                    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                Total a Pagar: $<div style="display: inline; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; text-decoration: underline;"><?php echo $reg->precio_total_cita?></div>
                </div>
                <div style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Hora: <?php echo $reg->hora_registro_cita?>
                </div>
                <div style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                    Estado: <span class="
                    <?php if ($reg->estado_registro_cita == "Aceptada") { echo ' text-success';}else 
                    if ($reg->estado_registro_cita == "Cancelada"){ echo ' text-danger';}else 
                    if ($reg->estado_registro_cita == "Pendiente"){echo ' text-secondary';}?>">
                        <?php echo $reg->estado_registro_cita?>
                    </span>
                </div>                
                </div>
                </div>
                
            </div>
        <?php
        $modal++;
        }
        $conexion->desconectarDB();
        ?>
    </div>
</div>
<!--Fin de los productos-->
</div>
</section>
                                

<?php ?>
</div>

<!--Scripts-->
<script>
        const fechaInicioInput = document.getElementById("fecha_desde");
        const fechaFinInput = document.getElementById("fecha_hasta");



        fechaInicioInput.addEventListener("change", function() {
            fechaFinInput.setAttribute("min", fechaInicioInput.value);
        });

        fechaFinInput.addEventListener("change", function() {
            fechaInicioInput.setAttribute("max", fechaFinInput.value);
        });
    </script>
<?php

include "../templates/footer.php";
}
else
{
    header("Location: ../views/login.php");
}
?>



