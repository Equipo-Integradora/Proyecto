
<?php

include "../class/database.php";
    $instancia = new database();
    
    $dias=$instancia->Expreso;

$longitud = count($dias);
extract($_POST);
if (isset($_POST['bloquear'])) {

    if (!in_array($dia, $dias)) {
        $dias[] = $dia;
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-success'>Fecha bloqueada</div>";
    }
    else
    {   
    echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
    echo "<div class='alert alert-danger'>La fecha ya está bloqueada</div>";
    }

    $instancia->Expreso = $dias; 

    header("refresh:2; ../views/calendario.php");
}

if (isset($_POST['desbloquear'])) {

    $fechaDesbloquear = $_POST['diant'];

    if (($key = array_search($fechaDesbloquear, $dias)) !== false) {

        unset($dias[$key]);
        $instancia->Expreso = $dias; 
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-success'>Fecha desbloqueada</div>";
    } else {
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>"; 
        echo "<div class='alert alert-danger'>La fecha seleccionada no está bloqueada</div>";
    }
    echo $instancia->Expreso;
    header("refresh:2; ../views/calendario.php");
}
?>
