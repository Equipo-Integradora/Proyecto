<?php 
session_start();
include "../templates/sidebar.php";?>
    <form action="../scripts/editar_fechas.php" method="post">
        <label for="dia">Seleccione el día que quiere bloquear</label><br>
        <input type="date" name="dia" id="dia"><br>
        <input type="submit" name="bloquear" class="submit" value="Bloquar día"> 
    </form><br><br>
    <form action="../scripts/editar_fechas.php" method="post">
        <label for="dia">Seleccione el día que quiere desbloquear</label><br>
        <input type="date" name="diant" id="diant"><br>
        <input type="submit" name="desbloquear" class="submit" value="Desbloquar día"> 
    </form>
    
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
</body>

</html>
