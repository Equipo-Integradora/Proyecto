<!-- Estilos CSS -->
<style>
    /* Estilos para los cards */
    .custom-card-style {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        height: 100%;
    }

    .servicio {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .descripcion {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .price {
        font-size: 16px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 15px;
    }

    .card-title {
        margin-top: 10px;
        cursor: pointer;
        display: block;
        text-align: center;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 2px 5px;
        transition: background-color 0.3s;
    }

    .card-title:hover {
        background-color: #0056b3;
    }

    /* Estilos para el contenedor de los cards */
    .card-container {
        display: flex;
        width: 200px;
        height: 200px;
        justify-content: space-between;
        gap: 10px; 
    }

    /* Estilos para el contenedor de la página */
    .container {
        padding: 20px;
    }
</style>

<!-- Contenedor de la página -->
<div class="container">
    <h2>Servicios disponibles</h2>
    <!-- Aquí incluyes tu archivo de conexión a la base de datos -->
    <?php include '../class/database.php'; ?>

    <?php
    // Crea una instancia de la clase database
    $db = new database();

    // Llama al método conectarDB() para establecer la conexión
    $db->conectarDB();

    // Consulta para obtener los servicios desde la base de datos
    $consulta = "SELECT * FROM tipos_servicio";
    $datos_servicios = $db->seleccionar($consulta);

    // Generación de las tarjetas con estilo y sistema de cuadrícula de Bootstrap
    if (!empty($datos_servicios)) {
        echo '<div class="card-container">';
        foreach ($datos_servicios as $fila) {
            echo '<div class="col-md-4">';
            echo '    <div class="card custom-card-style">';
            echo '        <div class="servicio">' . $fila->nombre_tipo_servicio . '</div>';
            echo '        <div class="descripcion">' . $fila->descripcion_tipo_servicio . '</div>';
            echo '        <div class="price">$' . $fila->precio_tipo_servicio . '</div>';
            echo '        <input type="checkbox" name="servicio[]" value="' . $fila->id_tipo_servicio . '" id="opcion' . $fila->id_tipo_servicio . '" autocomplete="off" class="d-none">';
            echo '        <label for="opcion' . $fila->id_tipo_servicio . '" class="card-title">Seleccionar</label>';
            echo '    </div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No se encontraron servicios disponibles.</p>';
    }
    // Cierra la conexión a la base de datos
    $db->desconectarDB();
    ?>
</div>
