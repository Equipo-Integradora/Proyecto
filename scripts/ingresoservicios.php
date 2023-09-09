<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso exitoso</title>
</head>
<body>
<?php
include "../class/database.php";
$urss = new database();
$urss->conectarDB();
extract($_POST);
if(isset($cambiar)){

  $ola="UPDATE `sweet_beauty`.`tipos_servicio` 
  SET `nombre_tipo_servicio` = '$tiposer',
   `descripcion_tipo_servicio` = '$desc',
    `precio_tipo_servicio` = '$precio', 
    `tiempo_aproximado_servicio` = '$tiempo' 
    WHERE (`id_tipo_servicio` = '$id_serv');";
  $urss->ejecuta($ola);
  $urss->desconectarDB();
      echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
      echo "<script>";
      echo "Swal.fire({";
      echo "  icon: 'success',";
      echo "  title: 'Guardado',";
      echo "  showConfirmButton: false,";
      echo "  timer: 1500";
      echo "});";
      echo "</script>";
      header("refresh:2; ../scripts/serviciosadmin.php");
        exit;
      }else if(isset($agregar)){

        if($urss->tipos($nameservice)){
          echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
          echo "<script>";
          echo "Swal.fire({";
          echo "  icon: 'error',";
          echo "  title: 'No es posible agregar otro servicio igual',";
          echo "  showConfirmButton: false,";
          echo "  timer: 3000";
          echo "});";
          echo "</script>";
          header("refresh:2; ../scripts/serviciosadmin.php");
          $urss->desconectarDB();
          exit;
        
        }else if(isset($agregar)){

          $olis="INSERT INTO `sweet_beauty`.`tipos_servicio` (`nombre_tipo_servicio`, `descripcion_tipo_servicio`, `precio_tipo_servicio`, `servicio_tipo_servicio_FK`, `tiempo_aproximado_servicio`) VALUES ('$nameservice', '$discr', '$price', '$service', '$time');";
            $urss->ejecuta($olis);

            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>";
            echo "Swal.fire({";
            echo "  icon: 'success',";
            echo "  title: 'Servicio agregado',";
            echo "  showConfirmButton: false,";
            echo "  timer: 1500";
            echo "});";
            echo "</script>";
            header("refresh:2; ../scripts/serviciosadmin.php");
              exit;

        }
      }else{
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({";
        echo "  icon: 'warning',";
        echo "  title: 'Saquese',";
        echo "  showConfirmButton: false,";
        echo "  timer: 1500";
        echo "});";
        echo "</script>";
        header("refresh:2; ../index.php");
          exit;
      }

?>
</body>
</html>