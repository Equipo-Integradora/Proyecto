<?php
include "../templates/header.php";
?>

<div class="container">
<?php
    session_start();
    if(isset($_SESSION["usuario"]))
    {
        ?>
    <h2>Aquí será la pestaña de agendar cita <i class="bi bi-archive"></i></h2>






        <div id="calendar"></div>

    <?php
    
    }
    else
    {
        header("Location: ../views/login.php");
    }
    ?>
</div>



<?php
include "../templates/footer.php";
?>