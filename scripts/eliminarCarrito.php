<?php
session_start();
$arreglo=$_SESSION['carrito'];
for($i=0;$i<count($arreglo); $i++)
{
    if($arreglo[$i]['Id']!=$_POST['id'])
    {
        $arregloNuevo[]=array(
            'Id'=>$arreglo[$i]['Id'],
            'Nombre'=>$arreglo[$i]['Nombre'],
            'Precio'=>$arreglo[$i]['Precio'],
            'Imagen'=>$arreglo[$i]['Imagen'],
            'Cantidad'=>$arreglo[$i]['Cantidad'],
            'Color'=>$arreglo[$i]['Color'],
            'Maximo'=>$arreglo[$i]['Maximo']
        );
    }
}
if(isset($arregloNuevo)){
    $_SESSION['carrito']=$arregloNuevo;
}
else{
    unset($_SESSION['carrito']);
}
echo "Listo";
// NO USAR header("Location: ../views/carrito2.php");

?>