
<?php
session_start();

if (!isset($_SESSION['dias'])) {
    $_SESSION['dias'] = array(); 
}

$dias = $_SESSION['dias'];

$longitud = count($dias);

if (isset($_POST['bloquear'])) {
    extract($_POST);

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

    $_SESSION['dias'] = $dias; 

    header("refresh:2; ../views/calendario.php");
}

if (isset($_POST['desbloquear'])) {

    $fechaDesbloquear = $_POST['diant'];

    if (($key = array_search($fechaDesbloquear, $dias)) !== false) {

        unset($dias[$key]);
        $_SESSION['dias'] = $dias; 
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-success'>Fecha desbloqueada</div>";
    } else {
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>"; 
        echo "<div class='alert alert-danger'>La fecha seleccionada no está bloqueada</div>";
    }
    header("refresh:2; ../views/calendario.php");
}
?>
