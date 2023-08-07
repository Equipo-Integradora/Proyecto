<?php  
session_start();
if(isset($_SESSION["usuario"]))
{
    $perfil = false;
    include "../templates/header.php";
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();

    $PAC = "CALL historial_cita('{$_SESSION["id"]}');";
    $citas = $conexion->seleccionar($PAC);
?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/mis_citas.css">
<div style="margin-top: 4.5rem;">
<div class="cabecera">
<div style="position: relative;">
<h1 style="float: left;  width: 50%;">Mis <span>Citas</span></h1>

<button style="margin-top: 1rem; position: absolute;  top: 0;  right: 0;  width: 10rem;" type="button" class="btn historial" data-bs-toggle="modal" data-bs-target="#exampleModal">
             Mi historial
        </button>

</div> 

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
    <div class="mb-3 col-6">
        <label  class="form-label"><h3 class="fw-bold">Buscar por servicio</h3></label> 
        <input type="text" name="nombre_servicio" class="form-control mt-2">
    </div>
       

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
extract($_POST);
if ($_POST) {
    if (empty($estado) && empty($fecha_desde) && empty($fecha_hasta) && empty($nombre_servicio)) {
        echo "<p class='fw-bold text-center'>Ingresa algún criterio de búsqueda para ver resultados.</p>";
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

    if (!empty($nombre_servicio)) {
        $citas .= " AND tipos_servicio LIKE '%".$nombre_servicio."%'";
    }    
    $citas .= " AND id_usuario = '{$_SESSION["id"]}'";
    $citas .= " GROUP BY id_registro_cita";
    $tablac = $conexion->seleccionar($citas);
?>
                            <?php
                            if (empty($tablac)) 
                            {
                               echo "<tr><td colspan='12'><p class='fw-bold text-center'>No se encontraron resultados.</p></td></tr>";
                            }
                            else
                            {
                                ?>
                                
                <div class="table-responsive container-fluid">
                    <table class="table shadow-sm table-hover">
                        <thead>
                        <tr>
                               <th>ID cita</th>
                               <th>Cliente</th>
                               <th>Tipo de servicio</th>
                               <th>Descripcion</th>
                               <th>Precio</th>
                               <th>Fecha de registro</th>
                               <th>Fecha de la cita</th>
                               <th>Hora de la cita</th>
                               <th>Estado</th>
                               <th>Cancelar</th>
                               </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                                foreach($tablac as $reg)
                            {
                                echo "<tr>";
                                echo "<td> $reg->id_registro_cita</td>";
                                echo "<td> $reg->nombre_usuario</td>";
                                echo '<td>';
                                echo '<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse"  data-bs-target="#servicios-' . $reg->id_registro_cita . '">Ver servicios</button>';
                                echo '<div class="collapse" id="servicios-' . $reg->id_registro_cita . '">';
                                $servicios = explode(', ', $reg->tipos_servicio);
                                $precios = explode(', ', $reg->precio_cita);
                                $id_detalle = explode(', ', $reg->id_detalle_registro_cita);
                                echo '<ul>';
                                for ($i = 0; $i < count($servicios); $i++) {
                                    echo '<li>' . $servicios[$i];
                                    if (!empty($precios[$i])) {
                                        echo '<strong><br> $' . $precios[$i] . '</strong>';
                                    }
                                    echo '</li>';
                                    echo '<br>';
                                }
                                echo '</ul>';
                                echo '</div>';
                                echo '</td>';
                                echo "<td><button type='button' class='btn btn-secondary btn-sm btn-desc' data-bs-toggle='modal' data-bs-target='#exampleModal' data-descripcion='$reg->Descripcion'>Ver descripción</button></td>";
                                ?>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Descripcion</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body" id="descripcionModalBody">
                                            <?php
                                            echo "$reg->Descripcion"
                                            ?>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn boton" data-bs-dismiss="modal">Cerrar</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <?php
                                echo "<td> $$reg->precio_total_cita</td>";
                                echo "<td> $reg->fecha_creacion_registro_cita</td>";
                                echo "<td> $reg->fecha_cita_registro_cita</td>";
                                echo "<td> $reg->hora_registro_cita</td>";
                                if ($reg->estado_registro_cita == "Aceptada")
                                {
                                    echo "<td><span class='badge text-bg-success'>$reg->estado_registro_cita</span></td>";
                                    echo "<td>";?>
                                    <link rel="stylesheet" href="">
                                <form action="../scripts/cancelar_cita.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $reg->id_registro_cita?>">
                                <button type="submit" class="can">
                                <i class="bi bi-x-circle"></i>
                                </button>
                                </form>
                              <?php echo "</td>";
                                }
                                else if ($reg->estado_registro_cita == "Cancelada")
                                {
                                    echo "<td><span class='badge text-bg-danger'>$reg->estado_registro_cita</span></td>";
                                }
                                else if ($reg->estado_registro_cita == "Pendiente")
                                {
                                    echo "<td><span class='badge text-bg-secondary'>$reg->estado_registro_cita</span></td>";
                                    echo "<td>";?>
                                <form action="../scripts/cancelar_cita.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $reg->id_registro_cita?>">
                                <button type="submit" class="can">
                                <i class="bi bi-x-circle"></i>
                                </button>
                                </form>
                              <?php echo "</td>";
                                }
                                
                                echo "</tr>";
                            }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

<?php }?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
      </div>
      <div class="modal-body">
        Historial
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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
}
include "../templates/footer.php";
}
else
{
    header("Location: ../views/login.php");
}
?>




