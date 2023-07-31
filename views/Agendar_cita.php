<?php  
session_start();
if(isset($_SESSION["usuario"]))
{
    $perfil = false;
    include "../templates/header.php";
    include "../class/database.php";
    $conexion = new database();
    $conexion->conectarDB();
?>
<!--Contenido-->

        <!--Inicio Pagina 1-->
        <link rel="stylesheet" href="../css/calendario.css">
    <div class="container" style="margin-top: 73px;">
                    <h1>Seleccione los servicios que quiere</h1>
    <!--Servicios-->
    <form action="../scripts/ingresar_cita.php" method="post">
        <div class="accordion" id="accordionExample">
        <?php
        $consultas = "SELECT * FROM servicios;";
        $servicios = $conexion->seleccionar($consultas);
        $conts = 0;
        $contt = 0;
        foreach($servicios as $s)
        {
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $conts;?>" aria-expanded="true" aria-controls="collapse<?php echo $conts;?>">
                        <?php echo "$s->nombre_servicio";?>
                    </button>
                </h2>
    <!--Fin Servicios-->
                <!--Tipo de Servicios-->
                <div class="container" style="width: 100%;">
                <div class="row">
                <?php 
                $consultat = "SELECT * FROM tipos_servicio WHERE tipos_servicio.servicio_tipo_servicio_FK = $s->id_servicio";
                $tipo_servicio = $conexion->seleccionar($consultat);
                foreach($tipo_servicio as $ts)
                { 
                ?>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div id="collapse<?php echo $conts;?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample<?php echo $contt;?>">
                        <div class="accordion-body">
                            <div class="card custom-card-style h-100">
                                <div class="servicio"><?php echo $ts->nombre_tipo_servicio?></div>
                                <div class="descripcion"><?php echo $ts->descripcion_tipo_servicio?></div>
                                <div class="price"><?php echo $ts->precio_tipo_servicio?> <span style="font-size: 10px; color:black; text-decoration:none; margin-left:2rem">Time aprox:<?php echo $ts->tiempo_aproximado_servicio?></span></div>
                                <input type="hidden" name="precio" value="<?php echo $ts->precio_tipo_servicio?>">
                                <input type="hidden" name="precio" value="<?php echo "$ts->precio_tipo_servicio"?>">
                                <input type="checkbox" id="<?php echo $ts->id_tipo_servicio ?>" name="servicio[]" value="<?php echo $ts->id_tipo_servicio ?>" class="d-none">
                                <label for="<?php echo $ts->id_tipo_servicio ?>" class="card-title btn btn-outline-primary">Seleccionar</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                $contt++;
                }
                ?>
                <!--Fin Tipo de Servicios-->
                </div>
                </div>
            </div>
<?php
    $conts++;
        }
        ?>
        </div>

        
        <!--Fin Pagina 1-->
        <!--Inicio Fecha y Hora-->
        <?php
        $pdo = new PDO('mysql:host=localhost:3309;dbname=sweet_beauty', 'admin', '1234');
        $sql = "SELECT fecha_bloqueada FROM fechas_bloqueadas";
        $fechasBloqueadas = $conexion->cale($sql);
        ?>
        <div class="col-md-12" style="margin-top: 1rem;">
            <div class="card custom-card">
             <h2>Selecciona la fecha y la hora</h2>
             <div class="date-input-container">
                <label class="date-input-label" for="selectedDate">Seleccione el icono del calendario en el recuadro y seleecione la fecha:</label>
                <input type="date" class="date-input" id="selectedDate" name="selectedDate" onkeydown="return false">
            </div>
            <br>
            <div class="time-input-container">
                <label class="time-input-label" for="selectedTime">Seleccionar hora:</label>
                <select name="selectedTime" id="selectedTime" style="width: 100%;">
                    <option value="3:00:00">3:00</option>
                    <option value="4:00:00">4:00</option>
                    <option value="5:00:00">5:00</option>
                    <option value="6:00:00">6:00</option>
                    <option value="7:00:00">7:00</option>
                    <option value="8:00:00">8:00</option>
                    <option value="9:00:00">9:00</option>
                </select>
            </div>
            <div class="date-input-container">
                <label class="date-input-label" for="selectedDate">Detalles extras de su cita</label>
                <textarea name="descripcion" id="descripcion" cols="" rows="" style="max-height: 9rem; width: 100%;"></textarea>
            </div>
            <input class="submit-button" type="submit" value="Agendar Cita">
            </div>
    </form>

<!-- Fin de la opción de selección de fecha y hora -->
    </div>
    

  <!-- Botones de navegación -->
  
</div>

</div>

<!--Fin Contenido-->
<?php
include "../templates/footer.php";
?>
   
<!--Scripts-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  var fechaActual = new Date();
  var fechaMinima = new Date();
  fechaMinima.setDate(fechaMinima.getDate() + 3);
  var fechaMaxima = new Date();
  fechaMaxima.setMonth(fechaMaxima.getMonth() + 6);
  var fechaMinimaFormateada = fechaMinima.toISOString().slice(0, 10);
  var fechaMaximaFormateada = fechaMaxima.toISOString().slice(0, 10);
  
  document.getElementById("selectedDate").setAttribute("min", fechaMinimaFormateada);
  document.getElementById("selectedDate").setAttribute("max", fechaMaximaFormateada);

  
  document.getElementById("selectedDate").addEventListener("keydown", function(event) {
    if (event.keyCode === 8) { 
      event.preventDefault();
      return false;
    }
  });

  
  const fechasBloqueadas = <?php echo json_encode($fechasBloqueadas); ?>;

  document.getElementById('selectedDate').addEventListener('input', function() {
    const selectedDate = this.value;

    if (fechasBloqueadas.includes(selectedDate)) {
      this.value = ''; 
      alert('Esta fecha está bloqueada. Por favor, selecciona otra fecha.');
    }
  });
</script>
<?php
} else 
{
    header("Location: ../views/login.php");
}
?>
