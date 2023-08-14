<?php
session_start();
include "../templates/sidebar.php";
$conexion = new database();
$conexion->conectarDB();
$Servicios="SELECT * FROM `sweet_beauty`.`servicios`;";
$todoserv=$conexion->seleccionar($Servicios);
?>
    <div class="text-center">
        <h3 class="m-0">Servicios</h3>
    </div>
    <div class="container">
    <div class="row">
        <?php 
        foreach($todoserv as $serv){
        ?>
        <hr>
    <div class="col-12 text-center"><h4 class=""><?php echo $serv->nombre_servicio?></h4></div>



<?php }?>
    </div>
    </div>











</body>
</html>