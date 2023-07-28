<?php
$perfil = false;
include "../templates/header.php";
?>

<link rel="stylesheet" href="../css/calendario.css">
<div class="container">
    <?php
    session_start();
    if (isset($_SESSION["usuario"])) {
    ?>

    <?php
    if (!isset($_POST["mostrar_calendario"])) {
    ?>
    <form action="" method="post">
        <h2 style="padding: 3%;">Seleccione el servicio que desea.</h2>
        <div class="row">
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Paquete diseño y planchado de cejas</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$100.00</div>
                    <input type="checkbox" name="opcion1" value="Opción 1" id="opcion1" autocomplete="off" class="d-none">
                    <label for="opcion1" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>

            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Aplicación de pestañas</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$100.00</div>
                    <input type="checkbox" name="opcion2" value="Opción 2" id="opcion2" autocomplete="off" class="d-none">
                    <label for="opcion2" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Rizado de pestañass</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$100.00</div>
                    <input type="checkbox" name="opcion3" value="Opción 3" id="opcion3" autocomplete="off" class="d-none">
                    <label for="opcion3" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Encerado</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$550.00</div>
                    <input type="checkbox" name="opcion4" value="Opción 4" id="opcion4" autocomplete="off" class="d-none">
                    <label for="opcion4" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Mechas</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$900.00</div>
                    <input type="checkbox" name="opcion5" value="Opción 5" id="opcion5" autocomplete="off" class="d-none">
                    <label for="opcion5" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Aplicación de tintes</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$300.00</div>
                    <input type="checkbox" name="opcion6" value="Opción 6" id="opcion6" autocomplete="off" class="d-none">
                    <label for="opcion6" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <div class="col-md-4" style="padding: 2%;">
                <div class="card custom-card-style h-100">
                    <div class="servicio">Balayage</div>
                    <div class="descripcion">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat necessitatibus nostrum repellendus illum asperiores, sapiente incidunt impedit atque maxime tempore odit in id rerum tenetur obcaecati velit harum corrupti hic?</div>
                    <div class="price">$1000.00</div>
                    <input type="checkbox" name="opcion7" value="Opción 7" id="opcion7" autocomplete="off" class="d-none">
                    <label for="opcion7" class="card-title btn btn-outline-primary">Seleccionar</label>
                </div>
            </div>
            <!-- Agrega más tarjetas si lo necesitas -->
        </div>
        <input class="submit-button" type="submit" name="mostrar_calendario" value="Mostrar calendario" style="align-items: center;">
    </form>
    <?php
} else {
?>
<div class="col-md-4" style="padding: 2%;">
    <div class="card custom-card">
        <h2>Selecciona la fecha y la hora</h2>
        <div class="date-input-container">
            <label class="date-input-label" for="selectedDate">Seleccionar fecha:</label>
            <input class="date-input" type="date" id="selectedDate">
        </div>
        <br>
        <div class="time-input-container">
            <label class="time-input-label" for="selectedTime">Seleccionar hora:</label>
            <input class="time-input" type="time" id="selectedTime">
        </div>
        <input class="submit-button" type="submit" name="mostrar_calendario" value="Mostrar calendario">
    </div>
</div>

<!-- Fin de la opción de selección de fecha y hora -->
</div>
</div>
<?php
}
?>
    <?php
    } else {
        header("Location: ../views/login.php");
    }
    ?>
</div>

<?php
include "../templates/footer.php";
?>
