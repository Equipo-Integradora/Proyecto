<?php
session_start();
if(isset($_SESSION["admin"]))
    {
        include "../class/diasbloc.php";
        include "../templates/sidebar.php";
?>
<div class="row">
    
   <div class="col-8">
   <div class="container-fluid px-4 p-3">
   <form method="post" id="myForm">
   <div style="width: 100%;" class="col-6 table-responsive">
   <label  class="form-label"><h3 class="fw-bold">Seleccione el día que quiere bloquear</h3></label>
   <table class="table">
    <tr>
        <th>
        <input id="selectedDate" type="date" name="dia" class="m-2">
        <input type="submit" name="bloquear" class="submit btn btn-sm boton" value="Bloquear día"> 
        </th>
    </tr>
   </table>
   </div>
    </form>
    </div>


    <div class="container-fluid px-4 p-3">
    <form method="post" id="myForm">
   <div style="width: 100%;" class="col-6 table-responsive">
   <label  class="form-label"><h3 class="fw-bold">Seleccione el día que quiere desbloquear</h3></label>
   <table class="table">
    <tr>
        <th>
        <input id="selectedDate" type="date" name="diant" class="m-2">
        <input type="submit" name="desbloquear" class="submit btn btn-sm boton" value="Desbloquear día"> 
        </th>
    </tr>
   </table>
   </div>
    </form>
    </div>
   </div>
   <?php 
   
   $admin = new Admin();
   $fechas = $admin->obtenerFechas();
   $largotote = count($fechas);
   if($largotote > 0)
   {
   ?>
   <div class="col-4">
        <table>
            <thead>
                <tr>
                <th>Días Bloqueados</th>
                </tr>
            </thead>
            <tbody>

            
        <?php
            foreach($fechas as $d)
            {   echo "<tr>";
                echo "<td> $d </td>";
                echo "</td>";
            }
        ?>
        </tbody>
        </table>  
        <?php   
        ?>
    </div>

   <?php
   }
    extract($_POST);
    if ($_POST) 
    {
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";

        if(!empty($dia))
        {
            if (!in_array($dia, $fechas)) {
                $admin->agregarFecha("$dia");
                ?>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Fecha bloqueada',
                  showConfirmButton: false,
                  timer: 3000
                });
                setTimeout(function() {
                window.location.href = '../views/calendario.php'
                }, 1300);
                </script>
                <?php
            } else {?>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                  icon: 'warning',
                  title: 'La fecha ya está bloqueada',
                  showConfirmButton: false,
                  timer: 3000
                });
                setTimeout(function() {
                window.location.href = '../views/calendario.php'
                }, 1300);
                </script>
                <?php
            }
        }

        if(!empty($diant))
        {
            if (($key = array_search($diant, $fechas)) !== false) {
                $admin->borrarFecha("$diant");?>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                  icon: 'success',
                  title: 'Fecha desbloqueada',
                  showConfirmButton: false,
                  timer: 3000
                });
                setTimeout(function() {
                window.location.href = '../views/calendario.php'
                }, 1300);
                </script>
                <?php
            } else {?>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                Swal.fire({
                  icon: 'warning',
                  title: 'La fecha seleccionada no está bloqueada',
                  showConfirmButton: false,
                  timer: 3000
                });
                setTimeout(function() {
                window.location.href = '../views/calendario.php'
                }, 1300);
                </script>
                <?php
            }
        }
    }   
    
    ?>

    
</div>
    
<!-- SCRIPTS -->
<script src="../js/clock.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
<script>
window.onload = function() {
    const inputDates = document.querySelectorAll("input[type='date']");

    const today = new Date();
    const todayISO = today.toISOString().split('T')[0];

    inputDates.forEach(function(inputDate) {
        inputDate.setAttribute("min", todayISO);
        
    });
};

</script>
</body>

</html>

<?php

}else
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    Swal.fire({
      icon: 'warning',
      title: 'Sitio solo para personal autorizado',
      showConfirmButton: false,
      timer: 5000
    });
    setTimeout(function() {
    window.location.href = "../index.php";
}, 2000);
    </script>
</body>
</html>

<?php
}

?>