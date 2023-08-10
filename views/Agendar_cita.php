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
<section class="section-padding">
<div class="container info">
<h1 class="text-center fw-bold m-3">Seleccione los servicios que quiere</h1>
    <!--Servicios-->
    <form action="../scripts/ingresar_cita.php" method="post" id="myForm">
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
                <div class="col-lg-4 col-sm-12">
                    <div id="collapse<?php echo $conts;?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample<?php echo $contt;?>">
                        <div class="accordion-body">
                            <div class="card custom-card-style h-100">
                                <div class="servicio"><?php echo $ts->nombre_tipo_servicio?></div>
                                <div class="descripcion"><?php echo $ts->descripcion_tipo_servicio?></div>
                                <div class="price"><?php echo $ts->precio_tipo_servicio?> <span style="font-size: 10px; color:black; text-decoration:none; margin-left:2rem">Time aprox:<?php echo $ts->tiempo_aproximado_servicio?></span></div>
                                <input type="hidden" name="precio" value="<?php echo $ts->precio_tipo_servicio?>">
                                  <?php if (strstr($ts->nombre_tipo_servicio, "Uñas")) { ?>
                                    <input type="radio" id="<?php echo $ts->id_tipo_servicio ?>"name="servicio[]" value="<?php echo $ts->id_tipo_servicio ?>" class="">
                                    <label for="<?php echo $ts->id_tipo_servicio ?>" class="card-title btn botonescita mt-3" onclick="deseleccionarRadio()">Seleccionar</label>
                                    <?php }else{?>
                                <input type="checkbox" id="<?php echo $ts->id_tipo_servicio ?>" name="servicio[]" value="<?php echo $ts->id_tipo_servicio ?>" class="d-none">
                                <label for="<?php echo $ts->id_tipo_servicio ?>" class="card-title btn botonescita mt-3">Seleccionar</label>
                                <?php }?>
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
        <div class="col-md-12" style="margin-top: 1rem;">
            <div class="card custom-card">
             <h2 class="fw-bold">Selecciona la fecha y la hora</h2>
             <div class="date-input-container">
                <label class="date-input-label" for="selectedDate">Seleccione el icono del calendario en el recuadro y seleecione la fecha:</label>
                <input type="date" class="date-input" id="selectedDate" name="selectedDate" onkeydown="return false">
            </div>
            <br>
            <div class="time-input-container">
                <label class="time-input-label" for="selectedTime">Seleccionar hora:</label>
                <select class="date-input" name="selectedTime" id="selectedTime" style="width: 100%;">
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
                <label class="date-input-label" for="selectedDate">Puede ingreasar un comentario extra sobre su cita de su cita</label>
                <textarea class="date-input" name="descripcion" id="descripcion" cols="" rows="" style="max-height: 9rem; width: 100%;"></textarea>
            </div>
            <input class="submit-button botonescita2" type="submit" value="Agendar Cita" <?php
            if (isset($_SESSION["admin"])) { echo ' disabled';}?> 
            >
            </div>
    </form>

<!-- Fin de la opción de selección de fecha y hora -->
    </div>
</section>
    

  <!-- Botones de navegación -->
  
</div>

</div>

<!--Fin Contenido-->
<?php
include "../templates/footer.php";
$blockedDates = $_SESSION['dias'];
$blockedDatesJSON = json_encode($blockedDates);
?>
   
<!--Scripts-->
<script>
  document.getElementById('myForm').addEventListener('submit', function(event) {
    
    const selectedDate = document.getElementById('selectedDate').value;
    const checkboxes = document.querySelectorAll('input[name="servicio[]"]:checked');

    if (selectedDate === '' && checkboxes.length === 0) 
    {
      event.preventDefault(); 
      alert('Ingrese todos los datos por favor.');
    } else if (selectedDate === '') 
    {
      event.preventDefault(); 
      alert('Seleccione una fecha.');
    } else if (checkboxes.length === 0) 
    {
      event.preventDefault(); 
      alert('Seleccione un servicio.');
    }

  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
window.onload = function() {
    var inputDate = document.getElementById("selectedDate"); // Cambiado a "selectedDate"
    var blockedDates = <?php echo $blockedDatesJSON; ?>;

    var today = new Date();
    var maxDate = new Date();
    maxDate.setMonth(maxDate.getMonth() + 6);

    inputDate.setAttribute("min", today.toISOString().split('T')[0]);
    inputDate.setAttribute("max", maxDate.toISOString().split('T')[0]);

    function isDateBlocked(date) {
        return blockedDates.includes(date);
    }

    inputDate.addEventListener("input", function() {
        var selectedDate = inputDate.value;
        if (isDateBlocked(selectedDate)) {
            alert("Esta fecha está bloqueada.");
            inputDate.value = "";
        }
    });
};
</script>


<?php
} else 
{
    header("Location: ../views/login.php");
}
?>
