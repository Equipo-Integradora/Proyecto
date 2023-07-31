
<?php
session_start();

if (!isset($_SESSION['dias'])) {
    $_SESSION['dias'] = array(); 
    $con = 0;
}

$dias = $_SESSION['dias'];

if (isset($_POST['bloquear'])) 
{

extract($_POST);
for($m = 0; $m >= $con; $m++)
{
    for($i = 0; $i >= $longitud; $i++)
    {
        if( $dias[$con] = $bloquear)
        {
            $dias[$con] =  $bloquear;
        }
    }
}


echo "<div class='alert alert-success'>Fecha bloqueada</div>";
header("refresh:2; ../scripts/inventario.php");
}

if (isset($_POST['desbloquear'])) 
{
    extract($_POST);

    $longitud = count($dias);
     
    for($i = 0; $i >= $longitud; $i++)
    {
        if( $dias[$i] = $desbloquear)
        {
            $dias[$i] =  $desbloquear;
        }
    }

    echo "<div class='alert alert-success'>Fecha desbloqueada</div>";
    header("refresh:2; ../scripts/inventario.php");
}
?>