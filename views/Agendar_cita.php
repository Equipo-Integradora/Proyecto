<?php
include "../templates/header.php";
?>

<style>
/* Estilo personalizado para los cards */
.custom-card-style {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 15px;
}

/* Estilo para el checkbox cuando está seleccionado */
.custom-card-style input[type="checkbox"]:checked + label {
    background-color: #ff69b4; /* Cambia el color a rosa (#ff69b4) cuando está seleccionado */
    color: #fff; /* Cambia el color del texto a blanco cuando está seleccionado */
}

/* Estilo para el elemento con la clase "servicio" */
.custom-card-style .servicio {
    font-size: 20px;
    font-weight: bold;
    color: #333; /* Cambia el color del texto del servicio */
}

/* Estilo para el elemento con la clase "descripcion" */
.custom-card-style .descripcion {
    font-size: 14px;
    color: #777; /* Cambia el color del texto de la descripción */
}
.check
{
    margin: auto;
    padding-bottom: 2px;
    size: 80px;
}
/* Estilo para el calendario */
#calendarioo {
    max-width: 600px;
    margin: 0 auto;
}

/* Estilo para el componente timeGrid */
.fc-time-grid {
    min-height: 100px;
}

/* Estilo para el botón "Guardar citas" */
#guardar-citas {
    display: block;
    margin-top: 10px;
    padding: 8px 16px;
    background-color: #ff69b4;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#guardar-citas:hover {
    background-color: #ff6aa1;
}
</style>
<link rel="stylesheet" href="../css/calendario copy 3.css">
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
        <input type="submit" name="mostrar_calendario" value="Mostrar calendario">
    </form>
    <?php
    } else {
    ?>
<div id="calendarioo">
    <div id="calendar"></div>

    <div id="citas-container">
        <h3>Fecha(s) seleccionada(s):</h3>
        <ul id="citas-list"></ul>
        <button id="guardar-citas">Guardar citas</button>
        <div id="mensaje"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var calendarEl = document.getElementById("calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ["dayGrid", "timeGrid"],
            header: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            height: "auto", // Ajustar automáticamente el alto del calendario
            defaultView: "timeGridWeek", // Vista predeterminada
            selectable: true,
            select: function (info) {
                var selectedDate = info.startStr; // Fecha seleccionada en el calendario
                var selectedDateTime = prompt("Elige la hora (formato HH:mm)", "09:00");

                if (selectedDateTime !== null) {
                    var li = document.createElement("li");
                    li.textContent = selectedDate + "T" + selectedDateTime;
                    document.getElementById("citas-list").appendChild(li);
                    document.getElementById("mensaje").textContent = "";
                    calendar.unselect();
                }
            },
        });
        calendar.render();

        document.getElementById("guardar-citas").addEventListener("click", function () {
            var citas = document.getElementById("citas-list").getElementsByTagName("li");
            if (citas.length > 0) {
                // Aquí puedes realizar acciones para guardar las citas en el servidor o en una base de datos
                alert("Citas guardadas correctamente.");
            } else {
                document.getElementById("mensaje").textContent = "Sin citas agendadas.";
            }
        });
    });
    </script>
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
