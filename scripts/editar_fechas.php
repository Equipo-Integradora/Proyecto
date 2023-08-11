<?php
session_start();
include "../class/diasbloc.php";
$conexion = new Admin();

$dias = array();
$dias = $conexion->obtenerFechas();


if (isset($_POST['bloquear'])) {
    $dia1 = $_POST['dia'];  

    if (!in_array($dia1, $dias)) {
        $conexion->agregarFecha($dia1);
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-success'>Fecha bloqueada</div>";
    } else {
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-danger'>La fecha ya está bloqueada</div>";
    }
}


if (isset($_POST['desbloquear'])) {

    $dia2 = $_POST['diant'];
    if (($key = array_search($dia2, $dias)) !== false) {

        $conexion->borrarFecha($dia2);
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>";
        echo "<div class='alert alert-success'>Fecha desbloqueada</div>";
    } else {
        echo "<link rel='stylesheet' href='../css/bootstrap.min.css'>"; 
        echo "<div class='alert alert-danger'>La fecha seleccionada no está bloqueada</div>";
    }
}


header("refresh:2; ../views/calendario.php");
?>