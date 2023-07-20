<?php
include "../templates/header.php";
?>
<link rel="stylesheet" href="../css/calendario.css">
<div class="container">
    <?php
    session_start();
    if (isset($_SESSION["usuario"])) {
    ?>
    <h2>Aquí será la pestaña de agendar cita <i class="bi bi-archive"></i></h2>

    <div id="calendar" style="height: 25%;"></div>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.min.js"></script>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ["dayGrid", "timeGrid"], // Agrega el componente timeGrid
      selectable: true,
      select: function (info) {
        // Fecha seleccionada en el calendario
        var selectedDate = info.startStr;
        var startDate = info.startStr;
        var endDate = info.endStr;

        // Muestra una ventana emergente para elegir la hora
        var selectedHour = prompt("Elige la hora (formato HH:mm)", "09:00");

        // Verifica si se seleccionó una hora válida
        if (selectedHour !== null) {
          // Concatena la hora seleccionada a las fechas de inicio y fin
          startDate = startDate + "T" + selectedHour;
          endDate = endDate + "T" + selectedHour;

          // Aquí puedes realizar las acciones que desees con las fechas y horas seleccionadas
          // Por ejemplo, enviarlas a través de un formulario o hacer una solicitud AJAX

          // Alerta con las fechas y hora seleccionadas (para demostración)
          alert(
            "Fecha y hora seleccionadas:\nInicio: " +
              startDate +
              "\nFin: " +
              endDate
          );
        }
      },
    });
    calendar.render();
  });
</script>

    <?php
    } else {
        header("Location: ../views/login.php");
    }
    ?>
</div>


<?php
include "../templates/footer.php";
?>
