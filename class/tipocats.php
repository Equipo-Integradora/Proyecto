<?php
require 'database.php';
$conectar=new database();
$conectar->conectarDB();

extract($_POST);
$query="SELECT tipo_categorias.id_tipo_categoria,tipo_categorias.nombre_tipo_categoria
FROM tipo_categorias
where `tipo_categorias`.`categoria_tipo_catergoria_FK`=$categoria";
$tipos=$conectar->seleccionar($query);

header('Content-Type: application/json');
echo json_encode($tipos);
?>