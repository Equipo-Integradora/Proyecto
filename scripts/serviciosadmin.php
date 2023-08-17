
<?php
session_start();
include "../templates/sidebar.php";
$Servicios="SELECT * FROM `sweet_beauty`.`servicios`;";
$todoserv=$conexion->seleccionar($Servicios);
?>
<style>
        .sexarea
        {
            width: 100%;
            max-height: 150px; 
            resize: vertical; 
        }
        
        a
        {
            text-decoration: none;
            color: #e84393;
        }
    </style>
    <div class="text-center" >
        <div class="row" >
            <div class="col-lg-3 col-3 ">
            <button type="button" class="btn boton" data-bs-toggle="modal" data-bs-target="#nuevo_servicio" >Agregar Servicios</button>
            </div>
            <div class="col-lg-6 col-6">
            <h3 class="m-0">Servicios</h3> 
            </div>
            <div class="col-lg-3 col-2">
            <button type="button" class="btn boton" data-bs-toggle="modal" data-bs-target="#nuevotipo" >Agregar Categoria</button>
            </div>
        </div>

    </div>
    <div class="container">
    <div class="row" >
        <?php 
        foreach($todoserv as $serv){
        ?>
        <hr>
    <div class="col-12 col-sm-12 text-center"><h4 class=""><?php echo $serv->nombre_servicio?></h4></div>
    <?php
    $tiposerv="SELECT * FROM tipos_servicio where `servicio_tipo_servicio_FK`='$serv->id_servicio'";
    $feo=$conexion->seleccionar($tiposerv);
            ?>
                    <?php
    foreach($feo as $ts){
    ?>
   
    <div class="col-lg-4 col-sm-4 col-6">
    <form action="">
                            <div class="card " style="margin-bottom: 2rem;">
                                <div class="text-center fw-bold" style="background-color: #e84393; color:white; font-family:Arial, Helvetica, sans-serif;"><?php echo $ts->nombre_tipo_servicio?></div>
                                
                                <div class=""><p><?php echo $ts->descripcion_tipo_servicio?></p></div>
                                
                                <div class="" style="color: #e84393;">$<?php echo $ts->precio_tipo_servicio?>
                                <br> <span style="font-size: 10px; color:black; text-decoration:none; margin-left:2rem">Tiempo aprox:<?php echo $ts->tiempo_aproximado_servicio?></span></div>
                                <button type="button" class="btn boton envio" data-bs-toggle="modal" data-bs-target="#tiposervicos" 
                                data-serv="<?php echo $ts->nombre_tipo_servicio?>" 
                                data-precio="<?php echo $ts->precio_tipo_servicio?>"
                                data-desc="<?php echo $ts->descripcion_tipo_servicio?>"
                                data-tiempo="<?php echo $ts->tiempo_aproximado_servicio?>"
                                data-id="<?php echo $ts->id_tipo_servicio?>">Editar</button>
                            </div>
                            </form>
                </div>

                <?php }?>
<?php }?>
    </div>
</div>
<!--Modal para insertar categorias-->
<div class="modal fade" id="nuevotipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar servicios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>    
      <form action="" id="categoris">
      <div class="modal-body">
            <div class="input-field">
                <label for="tiposer">Servicio</label> <br>
                <input type="text" class="input" name="cates" id="cates">
            </div>
            <br>
      </div>
      <div class="input-field text-center" style="margin-top: 1rem;">
         <input style="margin-bottom: .5rem;" type="submit" class="submit btn boton" value="Cambiar">
    </div>
      </form>
    </div>
  </div>
</div>

<!--MODAL PARA EDITAR SERVICIOS-->
    <div class="modal fade" id="tiposervicos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar servicios</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>    
      <form action="">
      <div class="modal-body">
        <input type="hidden" id="id_serv">
            <div class="input-field">
                <label for="tiposer">Servicio</label> <br>
                <input type="text" class="input" name="tiposer" id="tiposer">
            </div>
            <br>
            <div class="input-field">
        <label for="desc">Descripcion</label> <br>
        <textarea name="desc" id="desc" cols="40" class="sexarea" rows="5"></textarea>
            </div>
            <br>
            <div class="input-field">
            <label for="precio">Precio</label> <br>
                <input type="text" class="input" name="precio" id="precio">
            </div>
            <br>
            <div class="input-field">
            <label for="tiempo">Tiempo Aproximado</label> <br>
                <input type="text" class="input" name="tiempo" id="tiempo" oninput="formatTime()" maxlength="8">
            </div>
      </div>
      <div class="input-field text-center" style="margin-top: 1rem;">
         <input style="margin-bottom: .5rem;" type="submit" class="submit btn boton" value="Cambiar">
    </div>
      </form>
    </div>
  </div>
</div>

    <!--Modal para agregar un servicio-->
<div class="modal fade" id="nuevo_servicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar sevicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>    
      <form action="">
      <div class="modal-body">
            <div class="input-field">
                <label for="nameser">Nombre servicio</label> <br>
                <input type="text" class="input" name="nameserv" id="seer" placeholder="Nombre de servicio">
            </div>
            <br>
            <div class="input-field">
                <label for="service">Categoria</label> <br>
                <select name="service" class="form-select form-select-md" id="">
                <?php foreach($todoserv as $ni){
                ?>
                    <option value="<?php echo $ni->id_servicio?>"><?php echo $ni->nombre_servicio?></option>

                    <?php }?>
                </select>
            </div>
            <br>
            <div class="input-field">
                <label for="price">precio</label> <br>
                <input type="number" class="input" name="price" id="seer" placeholder="Coloque precio Max en caso de variaciones">
            </div>
            <br>
            <div class="input-field">
                <label for="time">Tiempo estimado de servicio</label> <br>
                <input type="text" class="input" name="time" id="time" placeholder="00:00:00" oninput="formatTime()" maxlength="8">
            </div>
            <div class="input-field">
                <label for="desc">Descripcion</label> <br>
                <textarea name="discr" id="discr" class="sexarea" rows="10" placeholder="Describa el servicio"></textarea>
            </div>
            <br>
      <div class="input-field text-center" style="margin-top: 1rem;">
         <input style="margin-bottom: .5rem;" type="submit" class="submit btn boton" value="Agregar">
    </div>
      </form>
    </div>
  </div>
</div>
   



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
        $('.envio').on('click', function () {
            var serv = $(this).data('serv');
            var descripcion = $(this).data('desc');
            var tiemp = $(this).data('tiempo');
            var precio = $(this).data('precio');
            var id_serv=$(this).data('id');

            $('#tiposer').val(serv);
            $('#desc').val(descripcion);
            $('#tiempo').val(tiemp);
            $('#precio').val(precio);
            $('#id_serv').val(id_serv);

            $('#tiposervicos').modal('show');
        });
</script>


<script>
        function formatTime() {
            const input = document.getElementById("time");
            let value = input.value.replace(/\D/g, ""); // Elimina caracteres no numéricos
            
            if (value.length > 2) {
                value = value.slice(0, 2) + ":" + value.slice(2); // Agrega el primer ':' después de 2 caracteres
            }
            
            if (value.length > 5) {
                value = value.slice(0, 5) + ":" + value.slice(5); // Agrega el segundo ':' después de 5 caracteres
            }
            
            input.value = value.slice(0, 8); // Limita el valor a 8 caracteres (HH:MM:SS)
        }
</script>
<!--Pa que jale esa uwu-->
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");
    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>
<script>
        function formatTime() {
            const input = document.getElementById("tiempo");
            let value = input.value.replace(/\D/g, ""); // Elimina caracteres no numéricos
            
            if (value.length > 2) {
                value = value.slice(0, 2) + ":" + value.slice(2); // Agrega el primer ':' después de 2 caracteres
            }
            
            if (value.length > 5) {
                value = value.slice(0, 5) + ":" + value.slice(5); // Agrega el segundo ':' después de 5 caracteres
            }
            
            input.value = value.slice(0, 8); // Limita el valor a 8 caracteres (HH:MM:SS)
        }
</script>

</body>
</html>