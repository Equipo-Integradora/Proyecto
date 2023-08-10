<?php
session_start();
if(isset($_SESSION["admin"]))
    {

        
include "../templates/sidebar.php";
?>
<div class="row">
    
   <div class="col-8">
   <div class="container-fluid px-4 p-3">
   <form action="../scripts/editar_fechas.php" method="post">
   <div style="width: 100%;" class="col-6 table-responsive">
   <label  class="form-label"><h3 class="fw-bold">Seleccione el día que quiere bloquear</h3></label>
   <table class="table">
    <tr>
        <th>
        <input id="selectedDate" type="date" name="dia" id="dia" class="m-2">
        <input type="submit" name="bloquear" class="submit btn btn-sm boton" value="Bloquar día"> 
        </th>
    </tr>
   </table>
   </div>
    </form>
    </div>

    <div class="container-fluid px-4 p-3">
    <form action="../scripts/editar_fechas.php" method="post">
   <div style="width: 100%;" class="col-6 table-responsive">
   <label  class="form-label"><h3 class="fw-bold">Seleccione el día que quiere desbloquear</h3></label>
   <table class="table">
    <tr>
        <th>
        <input id="selectedDate" type="date" name="dia" id="dia" class="m-2">
        <input type="submit" name="desbloquear" class="submit btn btn-sm boton" value="Desbloquar día"> 
        </th>
    </tr>
   </table>
   </div>
    </form>
    </div>
   </div>

    <div class="col-4">
        <?php
        if(!empty($_SESSION["dias"]))
        {?>
          
        <table>
            <thead>
                <tr>
                <th>Días Bloqueados</th>
                </tr>
            </thead>
            <tbody>

            
        <?php
        $dias = $_SESSION["dias"];

            foreach($dias as $dias)
            {   echo "<tr>";
                echo "<td> $dias </td>";
                echo "</td>";
            }
        ?>
        </tbody>
        </table>  
        <?php
        }
        ?>
    </div>
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
    var inputDate = document.getElementById("selectedDate"); 

    var today = new Date();

    inputDate.setAttribute("min", today.toISOString().split('T')[0]);

    function isDateBlocked(date) {
        return blockedDates.includes(date);
    }

    
    
};
</script>
</body>

</html>

<?php

}
?>
