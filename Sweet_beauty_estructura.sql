#BASE DE DATOS
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3309
-- Tiempo de generación: 22-07-2023 a las 16:14:39
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sweet_beauty`
--
USE sweet_beauty;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(2, 'Herramientas De Maquillaje'),
(3, 'Makeup'),
(4, 'Skincare'),
(5, 'Cuidado Capilar'),
(6, 'Uñas'),
(7, 'Cuidado De Manos Y Pies'),
(8, 'Cuidado De Cejas Y Pestañas'),
(9, 'Proteccion Solar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(11) NOT NULL,
  `nombre_color` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `nombre_color`) VALUES
(0, 'Sin color'),
(1, 'Azul'),
(2, 'Rojo'),
(3, 'Verde'),
(4, 'Amarillo'),
(5, 'Naranja'),
(6, 'Morado'),
(7, 'Rosa'),
(8, 'Negro'),
(9, 'Cafe'),
(10, 'Azul'),
(11, 'Rojo'),
(12, 'Verde'),
(13, 'Amarillo'),
(14, 'Naranja'),
(15, 'Morado'),
(16, 'Rosa'),
(17, 'Negro'),
(18, 'Cafe'),
(19, 'Praline'),
(20, 'Daredevil'),
(21, 'Beige'),
(22, 'Espresso'),
(23, 'Multicolor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_registros_cita`
--

CREATE TABLE `detalles_registros_cita` (
  `id_detalle_registro_cita` int(11) NOT NULL,
  `registro_cita_detalle_registro_FK` int(11) NOT NULL,
  `tipo_servicio_registro_cita_FK` int(11) NOT NULL,
  `precio_registro_cita` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_venta`
--

CREATE TABLE `detalle_orden_venta` (
  `id_detalle_orden_venta` int(11) NOT NULL,
  `orden_venta_detalle_orden_FK` char(10) NOT NULL,
  `producto_orden_venta_FK` int(11) NOT NULL,
  `cantidad_producto_orden_venta` int(11) NOT NULL,
  `precio_detalle_orden` decimal(9,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_productos`
--

CREATE TABLE `detalle_productos` (
  `id_detalle_producto` int(11) NOT NULL,
  `detalle_producto_detalle_producto_FK` int(11) NOT NULL,
  `color_detalle_producto_FK` int(11) DEFAULT NULL,
  `existencias_detalle_producto` int(11) NOT NULL,
  `imagen_detalle_producto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_productos`
--

INSERT INTO `detalle_productos` (`id_detalle_producto`, `detalle_producto_detalle_producto_FK`, `color_detalle_producto_FK`, `existencias_detalle_producto`, `imagen_detalle_producto`) VALUES
(1, 1, 0, 19, 'Kuul_Reconstructor.jpg'),
(2, 2, 0, 202, 'Total_Remover.jpg'),
(3, 3, 0, 106, 'TRESemme_Acondicionador.jpg'),
(4, 4, 0, 105, 'NIVEA_SUN.jpg'),
(5, 5, 0, 8, 'JDenis_Kit_Cejas.jpg'),
(6, 6, 0, 54, 'Passini_Removedor_Cutícula.jpg'),
(7, 7, 0, 21, 'Republic_cosmetics_FAUX_MINK.jpg'),
(8, 8, 0, 12, 'Eucerin_Mascarilla.jpg'),
(9, 9, 0, 108, 'Garnier_Macarilla_vc.jpg'),
(10, 10, 8, 99, 'Revlon_Eyeliner_negro.jpg'),
(11, 11, 19, 101, 'Revlon_sombra_Praline.jpg'),
(12, 12, 20, 77, 'RevlonEsmalte_Daredevil.jpg'),
(13, 13, 0, 112, 'SerumRoseSublime.jpg'),
(14, 14, 0, 20, 'EucerinProtectorSolar.jpg'),
(15, 15, 21, 5, 'HASPINHOrganizador_Beige.jpg'),
(16, 16, 0, 115, 'RealTechniquesEsponja.jpg'),
(17, 17, 2, 200, 'LABELLOLabial_Rojo.jpg'),
(18, 18, 22, 117, 'GelCejasNyx_Espresso.jpg'),
(19, 19, 0, 10, 'Exfoliantepies.jpg'),
(20, 20, 0, 30, 'RevlonEyelash.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_venta`
--

CREATE TABLE `orden_venta` (
  `id_venta` char(10) NOT NULL,
  `cliente_orden_venta_FK` int(11) NOT NULL,
  `fecha_creacion_orden_venta` date NOT NULL,
  `fecha_entrega_orden_venta` date DEFAULT NULL,
  `estado_orden_venta` enum('Pendiente','Pagado','Cancelado','Caducado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_venta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL unique,
  `descripcion_producto` text DEFAULT NULL,
  `precio_producto` decimal(9,2) NOT NULL,
  `categoria_producto_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `categoria_producto_FK`) VALUES
(1, 'Kuul Reconstructor System 35.2oz by Kuul', '...', 240.00, 38),
(2, 'Total Remover 16oz', '...', 220.00, 25),
(3, 'TRESemme Acondicionador sin parabenos Detox Hidratacion con aguacate y macadamia 715 ml', '...', 90.00, 34),
(4, 'Nivea Sun protector Solar Facial Control de brillo Tono Medio (50ml) FPS 50+', '...', 200.00, 1),
(5, 'J. Denis-Kit Diseño De cejas', '...', 200.00, 9),
(6, 'Passini-liquido removedor de cuticula 115ML', '...', 160.00, 19),
(7, 'Republic cosmetics-3D FAUX MINK Un paquete con 5 pares de pestañas postizas (A5-045)', '...', 300.00, 13),
(8, 'Eucerin Mascarilla facial hidratante con Acido Hialuronico 1pz', '...', 250.00, 41),
(9, 'Garnier Mascarilla Facial tono uniforme con vitamina C Express Aclara', '...', 40.00, 42),
(10, 'Revlon Colorstay Eyeliner 0.28g', '...', 230.00, 51),
(11, 'Revlon Colorstay creme sombra de ojos, Praline', '...', 200.00, 50),
(12, 'Revlon Esmalte Ultra HD Nail Snap Daredevil', '...', 150.00, 24),
(13, 'Serum para manos La Rose Sublime', '...', 450.00, 17),
(14, 'Eucerin protector solar extra ligero FPS50+-1 x 150 ml', '...', 400.00, 2),
(15, 'HASPINH Organizador de maquillaje', '...', 260.00, 59),
(16, 'Real Techniques, Esponja Miracle Complexion Esponja de Maquillaje multifuncional 3 en 1, tecnologia ', '...', 200.00, 55),
(17, 'LABELLO Balsamo Labial Caring Beauty Red (4.8 g), Color intenso y Cuidado duradero', '...', 200.00, 52),
(18, 'Gel para cejas, Tinted Brow Mascara, Nyx Professional Makeup, Tono Espresso, 6.2g', '...', 270.00, 6),
(19, 'Exfoliante para pies Bioaqua Suaviza y remueve Callos al instante 200ml', '...', 160.00, 21),
(20, 'Revlon Eyelash Curler Na, 1 cuenta', '...', 150.00, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_cita`
--

CREATE TABLE `registros_cita` (
  `id_registro_cita` int(11) NOT NULL,
  `cliente_registro_cita_FK` int(11) NOT NULL,
  `fecha_creacion_registro_cita` date NOT NULL,
  `fecha_cita_registro_cita` date NOT NULL,
  `hora_registro_cita` time NOT NULL,
  `estado_registro_cita` enum('Pendiente','Aceptada','Cancelada') NOT NULL,
  `descripcion_registro_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros_cita`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL unique
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre_servicio`) VALUES
(1, 'Cabello'),
(2, 'Manicura'),
(3, 'Cejas'),
(4, 'Pestañas'),
(5, 'Paquetes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_servicio`
--

CREATE TABLE `tipos_servicio` (
  `id_tipo_servicio` int(11) NOT NULL,
  `nombre_tipo_servicio` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL unique,
  `descripcion_tipo_servicio` text DEFAULT NULL,
  `precio_tipo_servicio` decimal(9,2) NOT NULL,
  `servicio_tipo_servicio_FK` int(11) NOT NULL,
  `tiempo_aproximado_servicio` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_servicio`
--

INSERT INTO `tipos_servicio` (`id_tipo_servicio`, `nombre_tipo_servicio`, `descripcion_tipo_servicio`, `precio_tipo_servicio`, `servicio_tipo_servicio_FK`, `tiempo_aproximado_servicio`) VALUES
(1, 'Paquete diseño y planchado de cejas', '...', 100.00, 5, '00:40:00'),
(2, 'Aplicación de pestañas', '...', 100.00, 4, '01:00:00'),
(3, 'Rizado de pestañas', '...', 100.00, 4, '00:30:00'),
(4, 'Encerado', '...', 550.00, 1, '02:00:00'),
(5, 'Mechas', '...', 900.00, 1, '06:00:00'),
(6, 'Aplicación de tintes', '...', 300.00, 1, '02:00:00'),
(7, 'Balayage', '...', 1000.00, 1, '06:00:00'),
(8, 'Planchado', '...', 100.00, 1, '00:30:00'),
(9, 'Rizos', '...', 120.00, 1, '00:30:00'),
(10, 'Uñas minis', '...', 180.00, 2, '02:00:00'),
(11, 'Uñas medianas', '...', 220.00, 2, '02:00:00'),
(12, 'Uñas largas', '...', 270.00, 2, '03:00:00'),
(13, 'Gelish', '...', 100.00, 2, '00:40:00'),
(14, 'Paquete maquillaje y peinado', '...', 400.00, 5, '02:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_categorias`
--

CREATE TABLE `tipo_categorias` (
  `id_tipo_categoria` int(11) NOT NULL,
  `nombre_tipo_categoria` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL unique,
  `categoria_tipo_catergoria_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_categorias`
--

INSERT INTO `tipo_categorias` (`id_tipo_categoria`, `nombre_tipo_categoria`, `categoria_tipo_catergoria_FK`) VALUES
(1, 'Protector solar facial', 9),
(2, 'Protector solar corporal', 9),
(3, 'Protector solar en crema', 9),
(4, 'Protector solar resistente al agua', 9),
(5, 'Serums para el crecimiento de cejas', 8),
(6, 'Geles para cejas', 8),
(7, 'Lápices para cejas', 8),
(8, 'Plantillas para cejas', 8),
(9, 'Kit de cejas', 8),
(10, 'Pinzas para cejas', 8),
(11, 'Serums para el crecimiento de pestañas', 8),
(12, 'Rizadores de pestañas', 8),
(13, 'Pestañas postizas', 8),
(14, 'Adhesivos para pestañas postizas', 8),
(15, 'Removedor de adhesivo para pestañas', 8),
(16, 'Cremas hidratantes para manos', 7),
(17, 'Serums para manos', 7),
(18, 'Tratamientos para uñas frágiles', 7),
(19, 'Removedores de cutículas', 7),
(20, 'Cremas hidratantes para pies', 7),
(21, 'Exfoliantes para pies', 7),
(22, 'Serums para pies', 7),
(23, 'Tratamientos para callos y durezas', 7),
(24, 'Esmaltes de uñas', 6),
(25, 'Removedores de esmalte', 6),
(26, 'Aceites para uñas y cutículas', 6),
(27, 'Endurecedores de uñas', 6),
(28, 'Base coat', 6),
(29, 'Top coat', 6),
(30, 'Decoración de uñas', 6),
(31, 'Limas y pulidores de uñas', 6),
(32, 'Pinceles para nail art', 6),
(33, 'Champús', 5),
(34, 'Acondicionadores', 5),
(35, 'Serums capilares', 5),
(36, 'Aceites capilares', 5),
(37, 'Sprays para el cabello', 5),
(38, 'Tratamientos capilares', 5),
(39, 'Limpiadores faciales', 4),
(40, 'Serums faciales', 4),
(41, 'Cremas hidratantes faciales', 4),
(42, 'Mascarillas faciales', 4),
(43, 'Exfoliantes faciales', 4),
(44, 'Aceites faciales', 4),
(45, 'Contornos de ojos', 4),
(46, 'Bases de maquillaje', 3),
(47, 'Correctores', 3),
(48, 'Polvos compactos', 3),
(49, 'Rubores', 3),
(50, 'Sombras de ojos', 3),
(51, 'Eyeliners', 3),
(52, 'Labiales', 3),
(53, 'Brillos de labios', 3),
(54, 'Brochas de maquillaje', 2),
(55, 'Esponjas de maquillaje', 2),
(56, 'Pinceles para labios', 2),
(57, 'Espejos de maquillaje', 2),
(58, 'Paletas de mezcla de maquillaje', 2),
(59, 'Organizadores de maquillaje', 2),
(60, 'Aplicadores de maquillaje', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contraseña_usuario` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL UNIQUE,
  `telefono_usuario` char(10) NOT NULL,
  `fecha_nacimiento_usuario` date NOT NULL,
  `sexo_usuario` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `fecha_registro_usuario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `fecha_registro_cliente` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN

	if new.fecha_registro_usuario is null then
    set new.fecha_registro_usuario = now();
    End if ;

END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `detalles_registros_cita`
--
ALTER TABLE `detalles_registros_cita`
  ADD PRIMARY KEY (`id_detalle_registro_cita`),
  ADD KEY `registro_cita_detalle_registro_FK` (`registro_cita_detalle_registro_FK`),
  ADD KEY `tipo_servicio_registro_cita_FK` (`tipo_servicio_registro_cita_FK`);

--
-- Indices de la tabla `detalle_orden_venta`
--
ALTER TABLE `detalle_orden_venta`
  ADD PRIMARY KEY (`id_detalle_orden_venta`),
  ADD KEY `orden_venta_detalle_orden_FK` (`orden_venta_detalle_orden_FK`),
  ADD KEY `producto_orden_venta_FK` (`producto_orden_venta_FK`);

--
-- Indices de la tabla `detalle_productos`
--
ALTER TABLE `detalle_productos`
  ADD PRIMARY KEY (`id_detalle_producto`),
  ADD KEY `detalle_producto_detalle_producto_FK` (`detalle_producto_detalle_producto_FK`),
  ADD KEY `color_detalle_producto_FK` (`color_detalle_producto_FK`);

--
-- Indices de la tabla `orden_venta`
--
ALTER TABLE `orden_venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `cliente_orden_venta_FK` (`cliente_orden_venta_FK`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_producto_FK` (`categoria_producto_FK`);

--
-- Indices de la tabla `registros_cita`
--
ALTER TABLE `registros_cita`
  ADD PRIMARY KEY (`id_registro_cita`),
  ADD KEY `cliente_registro_cita_FK` (`cliente_registro_cita_FK`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `tipos_servicio`
--
ALTER TABLE `tipos_servicio`
  ADD PRIMARY KEY (`id_tipo_servicio`),
  ADD KEY `servicio_tipo_servicio_FK` (`servicio_tipo_servicio_FK`);

--
-- Indices de la tabla `tipo_categorias`
--
ALTER TABLE `tipo_categorias`
  ADD PRIMARY KEY (`id_tipo_categoria`),
  ADD KEY `categoria_tipo_catergoria_FK` (`categoria_tipo_catergoria_FK`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `detalles_registros_cita`
--
ALTER TABLE `detalles_registros_cita`
  MODIFY `id_detalle_registro_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `detalle_orden_venta`
--
ALTER TABLE `detalle_orden_venta`
  MODIFY `id_detalle_orden_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `detalle_productos`
--
ALTER TABLE `detalle_productos`
  MODIFY `id_detalle_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `registros_cita`
--
ALTER TABLE `registros_cita`
  MODIFY `id_registro_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipos_servicio`
--
ALTER TABLE `tipos_servicio`
  MODIFY `id_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_categorias`
--
ALTER TABLE `tipo_categorias`
  MODIFY `id_tipo_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_registros_cita`
--
ALTER TABLE `detalles_registros_cita`
  ADD CONSTRAINT `detalles_registros_cita_ibfk_1` FOREIGN KEY (`registro_cita_detalle_registro_FK`) REFERENCES `registros_cita` (`id_registro_cita`),
  ADD CONSTRAINT `detalles_registros_cita_ibfk_2` FOREIGN KEY (`tipo_servicio_registro_cita_FK`) REFERENCES `tipos_servicio` (`id_tipo_servicio`);

--
-- Filtros para la tabla `detalle_orden_venta`
--
ALTER TABLE `detalle_orden_venta`
  ADD CONSTRAINT `detalle_orden_venta_ibfk_1` FOREIGN KEY (`orden_venta_detalle_orden_FK`) REFERENCES `orden_venta` (`id_venta`),
  ADD CONSTRAINT `detalle_orden_venta_ibfk_2` FOREIGN KEY (`producto_orden_venta_FK`) REFERENCES `detalle_productos` (`id_detalle_producto`);

--
-- Filtros para la tabla `detalle_productos`
--
ALTER TABLE `detalle_productos`
  ADD CONSTRAINT `detalle_productos_ibfk_1` FOREIGN KEY (`detalle_producto_detalle_producto_FK`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `detalle_productos_ibfk_2` FOREIGN KEY (`color_detalle_producto_FK`) REFERENCES `colores` (`id_color`);

--
-- Filtros para la tabla `orden_venta`
--
ALTER TABLE `orden_venta`
  ADD CONSTRAINT `orden_venta_ibfk_1` FOREIGN KEY (`cliente_orden_venta_FK`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_producto_FK`) REFERENCES `tipo_categorias` (`id_tipo_categoria`);

--
-- Filtros para la tabla `registros_cita`
--
ALTER TABLE `registros_cita`
  ADD CONSTRAINT `registros_cita_ibfk_1` FOREIGN KEY (`cliente_registro_cita_FK`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tipos_servicio`
--
ALTER TABLE `tipos_servicio`
  ADD CONSTRAINT `tipos_servicio_ibfk_1` FOREIGN KEY (`servicio_tipo_servicio_FK`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `tipo_categorias`
--
ALTER TABLE `tipo_categorias`
  ADD CONSTRAINT `tipo_categorias_ibfk_1` FOREIGN KEY (`categoria_tipo_catergoria_FK`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



#VISTAS
#1.	Productos generales
CREATE VIEW `productos generales` AS
SELECT detalle_productos.id_detalle_producto, productos.id_producto, productos.nombre_producto, colores.nombre_color, productos.precio_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto
    FROM colores RIGHT JOIN detalle_productos ON detalle_productos.color_detalle_producto_FK = colores.id_color
  	INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
    INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
    Where detalle_productos.existencias_detalle_producto > 0
    GROUP BY productos.nombre_producto, productos.precio_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.imagen_detalle_producto;


#2.	Productos sin existencias Administrador
CREATE VIEW `productos_sin_existencias` AS
SELECT detalle_productos.id_detalle_producto, productos.id_producto, productos.nombre_producto, colores.nombre_color, productos.precio_producto, tipo_categorias.nombre_tipo_categoria, detalle_productos.imagen_detalle_producto
FROM detalle_productos
INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
LEFT JOIN colores ON detalle_productos.color_detalle_producto_FK = colores.id_color
WHERE detalle_productos.existencias_detalle_producto = 0;
    
#3. Citas
CREATE VIEW `citas recientes` AS
    SELECT 
        `registros_cita`.`hora_registro_cita` AS `hora_registro_cita`,
        `registros_cita`.`id_registro_cita` AS `id_registro_cita`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        `usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        `registros_cita`.`descripcion_registro_cita` AS `Descripcion`,
        GROUP_CONCAT(`tipos_servicio`.`nombre_tipo_servicio`
            SEPARATOR ', ') AS `tipos_servicio`,
        `registros_cita`.`fecha_cita_registro_cita` AS `fecha_cita_registro_cita`,
        `registros_cita`.`estado_registro_cita` AS `estado_registro_cita`
    FROM
        (((`tipos_servicio`
        JOIN `detalles_registros_cita` ON (`detalles_registros_cita`.`tipo_servicio_registro_cita_FK` = `tipos_servicio`.`id_tipo_servicio`))
        JOIN `registros_cita` ON (`detalles_registros_cita`.`registro_cita_detalle_registro_FK` = `registros_cita`.`id_registro_cita`))
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `registros_cita`.`cliente_registro_cita_FK`))
    WHERE
        `registros_cita`.`fecha_cita_registro_cita` BETWEEN CURRENT_TIMESTAMP() - INTERVAL 7 DAY AND CAST(CURRENT_TIMESTAMP() AS DATE)
            AND (`registros_cita`.`estado_registro_cita` = 'Pendiente'
            OR `registros_cita`.`estado_registro_cita` = 'Aceptada')
    GROUP BY `registros_cita`.`id_registro_cita`;

#4. VISTA PARA CONSULTA DE ORDENES
CREATE VIEW `consulta_ordenes` AS
    SELECT 
        `detalles`.`nombre_color` AS `color`,
        `detalles`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
        `orden_venta`.`id_venta` AS `id_venta`,
        `detalles`.`nombre_producto` AS `productos`,
        `detalle_orden_venta`.`cantidad_producto_orden_venta` AS `cantidad_producto_orden_venta`,
        `detalles`.`precio_producto` AS `precio_producto`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        `detalle_orden_venta`.`precio_detalle_orden` AS `precio_detalle_orden`,
        `orden_venta`.`estado_orden_venta` AS `estado_orden_venta`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`));

 #5. VISTA CITAS DETALLADAS
CREATE VIEW `todas las citas` AS
    SELECT 
        `usuarios`.`id_usuario` AS `id_usuario`,
        `registros_cita`.`id_registro_cita` AS `id_registro_cita`,
        GROUP_CONCAT(`detalles_registros_cita`.`id_detalle_registro_cita`
            SEPARATOR ', ') AS `id_detalle_registro_cita`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        `usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        GROUP_CONCAT(`tipos_servicio`.`nombre_tipo_servicio`
            SEPARATOR ', ') AS `tipos_servicio`,
        `registros_cita`.`descripcion_registro_cita` AS `Descripcion`,
        GROUP_CONCAT(`detalles_registros_cita`.`precio_registro_cita`
            SEPARATOR ', ') AS `precio_cita`,
        SUM(`detalles_registros_cita`.`precio_registro_cita`) AS `precio_total_cita`,
        `registros_cita`.`fecha_creacion_registro_cita` AS `fecha_creacion_registro_cita`,
        `registros_cita`.`fecha_cita_registro_cita` AS `fecha_cita_registro_cita`,
        `registros_cita`.`hora_registro_cita` AS `hora_registro_cita`,
        `registros_cita`.`estado_registro_cita` AS `estado_registro_cita`
    FROM
        (((`registros_cita`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `registros_cita`.`cliente_registro_cita_FK`))
        LEFT JOIN `detalles_registros_cita` ON (`detalles_registros_cita`.`registro_cita_detalle_registro_FK` = `registros_cita`.`id_registro_cita`))
        LEFT JOIN `tipos_servicio` ON (`detalles_registros_cita`.`tipo_servicio_registro_cita_FK` = `tipos_servicio`.`id_tipo_servicio`))
    GROUP BY `registros_cita`.`id_registro_cita`;


#6. VISTA ORDENES DETALLADAS
CREATE VIEW `todas las ordenes` AS
    SELECT 
        `orden_venta`.`id_venta` AS `id_venta`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`detalles`.`nombre_color`
            SEPARATOR ', ') AS `color`,
        GROUP_CONCAT(`detalles`.`nombre_producto`
            SEPARATOR '| ') AS `productos`,
        `detalles`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
        GROUP_CONCAT(`detalle_orden_venta`.`cantidad_producto_orden_venta`
            SEPARATOR ', ') AS `cantidades`,
        SUM(`detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `cantidad_total`,
        SUM(`detalles`.`precio_producto` * `detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `precio_total`,
        `orden_venta`.`fecha_creacion_orden_venta` AS `fecha_creacion_orden_venta`,
        `orden_venta`.`fecha_entrega_orden_venta` AS `fecha_entrega_orden_venta`,
        `orden_venta`.`estado_orden_venta` AS `estado_orden_venta`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
    GROUP BY `orden_venta`.`id_venta`;


#7. Productos sin detallado
CREATE VIEW `productos sin detalle` AS
SELECT productos.id_producto, productos.nombre_producto, productos.descripcion_producto, productos.precio_producto, tipo_categorias.nombre_tipo_categoria
FROM tipo_categorias INNER JOIN productos ON productos.categoria_producto_FK = tipo_categorias.id_tipo_categoria
LEFT JOIN detalle_productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
WHERE detalle_productos.detalle_producto_detalle_producto_FK IS NULL; 

#8. Productos generales para seguir detallando
CREATE VIEW `productos para seguir detallando` AS
    SELECT 
        detalle_productos.id_detalle_producto,
        productos.id_producto,
        productos.nombre_producto,
        colores.nombre_color,
        productos.precio_producto,
        tipo_categorias.nombre_tipo_categoria,
        detalle_productos.existencias_detalle_producto
    FROM
        tipo_categorias
            INNER JOIN
        productos ON productos.categoria_producto_FK = tipo_categorias.id_tipo_categoria
            LEFT JOIN
        detalle_productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
            LEFT JOIN
        colores ON colores.id_color = detalle_productos.color_detalle_producto_FK
    WHERE
        colores.nombre_color <> 'Sin color'
    GROUP BY productos.nombre_producto , productos.precio_producto , tipo_categorias.nombre_tipo_categoria;
    
    CREATE VIEW `mis_ordenes` AS
    SELECT 
        `usuarios`.`id_usuario` AS `id_usuario`,
        `orden_venta`.`id_venta` AS `id_venta`,
        GROUP_CONCAT(`detalles`.`id_detalle_producto`
            SEPARATOR '| ') AS `id_productos`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`detalles`.`nombre_color`
            SEPARATOR ', ') AS `color`,
        GROUP_CONCAT(`detalles`.`nombre_producto`
            SEPARATOR '| ') AS `productos`,
        GROUP_CONCAT(`detalles`.`imagen_detalle_producto`
            SEPARATOR '| ') AS `imagen_detalle_producto`,
        GROUP_CONCAT(`detalle_orden_venta`.`cantidad_producto_orden_venta`
            SEPARATOR ', ') AS `cantidades`,
        SUM(`detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `cantidad_total`,
        GROUP_CONCAT(`detalles`.`precio_producto`
            SEPARATOR '| ') AS `Precios`,
        SUM(`detalles`.`precio_producto` * `detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `precio_total`,
        `orden_venta`.`fecha_creacion_orden_venta` AS `fecha_creacion_orden_venta`,
        `orden_venta`.`fecha_entrega_orden_venta` AS `fecha_entrega_orden_venta`,
        `orden_venta`.`estado_orden_venta` AS `estado_orden_venta`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
    GROUP BY `orden_venta`.`id_venta`;
 
 
#TRIGGERS
#1.	Tener un periodo de antelación de 3 días, para que el cliente reserve una cita
DELIMITER //
CREATE TRIGGER periodo_antelacion_citas
BEFORE INSERT ON registros_cita
FOR EACH ROW
BEGIN
	IF new.fecha_cita_registro_cita < DATE_ADD(NOW(), INTERVAL 1 DAY) THEN
 	   SIGNAL SQLSTATE'45000'
  	      SET message_text = 'Las citas deben ser con un mínimo de 1 día de reservación';
   	END IF;
END //
DELIMITER ;

#2.	Cambiar el estado de una orden de venta a pendiente, al momento de que se genere la orden
DELIMITER //
CREATE TRIGGER estado_default_orden_venta
BEFORE INSERT ON orden_venta
FOR EACH ROW
BEGIN
IF new.estado_orden_venta IS NULL
THEN SET new.estado_orden_venta = 1;
END IF ;
END //
DELIMITER ;

#3.	Cambiar el estado de una cita de venta a sin asignar, al momento de que se genere la cita
DELIMITER //
CREATE TRIGGER estado_default_registro_cita
BEFORE INSERT ON registros_cita
FOR EACH ROW
BEGIN
IF new.estado_registro_cita IS NULL
THEN SET new.estado_registro_cita = 1;
END IF ;
END //
DELIMITER ;

#4.	Limitar registros a personas que sean mayores de edad
DELIMITER //
CREATE TRIGGER mayor_de_edad
BEFORE INSERT ON usuarios
FOR EACH ROW
BEGIN
    IF new.fecha_nacimiento_usuario >= DATE_ADD(NOW(), INTERVAL -18 YEAR) THEN
    SIGNAL SQLSTATE'45000'
        SET message_text = 'El cliente debe ser mayor de edad';
    END IF;
END //
DELIMITER ;

#5. Registrar la fecha en la que se registro el usuario
	DELIMITER //
	CREATE TRIGGER fecha_reg_user
	BEFORE INSERT ON usuarios
	FOR EACH ROW
	BEGIN
		IF NEW.fecha_registro_usuario = '00-00-0000' THEN
		SET NEW.fecha_registro_usuario = NOW();
		END IF;
	END //
	DELIMITER ;
    
#6. Registrar la fecha en la que se registra una orden
DELIMITER //
	CREATE TRIGGER fecha_reg_orden
	BEFORE INSERT ON orden_venta
	FOR EACH ROW
	BEGIN
		IF NEW.fecha_creacion_orden_venta = '00-00-0000' THEN
		SET NEW.fecha_creacion_orden_venta = NOW();
		END IF;
	END //
	DELIMITER ;
    
#7. Registrar la fecha en la que se registra una venta
DELIMITER //
	CREATE TRIGGER fecha_reg_cita
	BEFORE INSERT ON registros_cita
	FOR EACH ROW
	BEGIN
		IF NEW.fecha_creacion_registro_cita = '00-00-0000' THEN
		SET NEW.fecha_creacion_registro_cita = NOW();
		END IF;
	END //
	DELIMITER ;
    
#8. Sintaxis correcta para un correo
DELIMITER //
CREATE TRIGGER Val_correo
BEFORE INSERT ON usuarios
FOR EACH ROW
BEGIN
IF new.email_usuario NOT LIKE '%@%.%' THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'El correo no tiene una sintaxis correcta';
END IF;
END //

DELIMITER //
CREATE TRIGGER Val_correo_Actualizacion
BEFORE UPDATE ON usuarios
FOR EACH ROW
BEGIN
IF new.email_usuario NOT LIKE '%@%.%' THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'El correo no tiene una sintaxis correcta';
END IF;
END //

#9. Precio default detalle cita
DELIMITER //
CREATE TRIGGER precio_de_citas
BEFORE INSERT ON detalles_registros_cita
FOR EACH ROW
BEGIN
    DECLARE v_precio DECIMAL(9, 2);
    SELECT precio_tipo_servicio INTO v_precio FROM tipos_servicio WHERE id_tipo_servicio = NEW.tipo_servicio_registro_cita_FK;
	SET NEW.precio_registro_cita = v_precio;
END;
//
DELIMITER ;


#10. precio de productos en detalles
DELIMITER //
CREATE TRIGGER precio_de_productos
BEFORE INSERT ON detalle_orden_venta
FOR EACH ROW
BEGIN
    DECLARE v_precio DECIMAL(9, 2);
    SELECT precio_producto INTO v_precio 
    FROM productos left join detalle_productos 
    on id_producto=detalle_producto_detalle_producto_FK 
    WHERE id_detalle_producto = NEW.producto_orden_venta_FK;
	SET NEW.precio_detalle_orden = v_precio;
END;
//
DELIMITER ;

#11. Cuando una orden se haga, restar la cantidad de productos comprados
DELIMITER //
CREATE TRIGGER restar_productos_venta
AFTER INSERT ON detalle_orden_venta
FOR EACH ROW
BEGIN

	UPDATE detalle_productos
    SET existencias_detalle_producto = (existencias_detalle_producto - New.cantidad_producto_orden_venta)
    WHERE id_detalle_producto = New.producto_orden_venta_FK;

END //
DELIMITER ;

#12. Cuando una orden se cancele o caduque, sumar la cantidad de productos comprados
DELIMITER //
CREATE TRIGGER sumar_productos_venta
AFTER UPDATE ON orden_venta
FOR EACH ROW
BEGIN
	IF New.estado_orden_venta = 'Cancelado' OR New.estado_orden_venta = 'Caducado' THEN
		UPDATE detalle_productos 
        	INNER JOIN detalle_orden_venta ON detalle_productos.id_detalle_producto = detalle_orden_venta.producto_orden_venta_FK
            
		SET existencias_detalle_producto = (existencias_detalle_producto + cantidad_producto_orden_venta)
		WHERE id_detalle_producto = detalle_orden_venta.producto_orden_venta_FK AND detalle_orden_venta.orden_venta_detalle_orden_FK = Old.id_venta;
	END IF;
END //
DELIMITER ;


#BITACORAS
#1. Productos que hayan recibido cambio de precio
CREATE TABLE cambio_precio_producto
(
	id_cambio_p_p INT PRIMARY KEY AUTO_INCREMENT,
    producto_modificado VARCHAR(100) NOT NULL,
    precio_viejo DECIMAL (9,2),
    precio_nuevo DECIMAL (9,2),
    fecha_cambio_p_p DATE
);

DELIMITER //
CREATE TRIGGER bitacora_producto_cambio_precio
AFTER UPDATE ON productos
FOR EACH ROW
BEGIN
	IF NEW.precio_producto <> OLD.precio_producto THEN
		INSERT INTO cambio_precio_producto (producto_modificado, precio_viejo, precio_nuevo, fecha_cambio_p_p) 
        VALUES (NEW.nombre_producto, OLD.precio_producto, NEW.precio_producto, CURDATE());
	  END IF;
END //
DELIMITER ;

#2. Tipos de servicio que hayan recibido cambio de precio
CREATE TABLE cambio_precio_servicio
(
	id_cambio_p_s INT PRIMARY KEY AUTO_INCREMENT,
    servicio_modificado VARCHAR(100) NOT NULL,
    servicio_viejo DECIMAL (9,2),
    servicio_nuevo DECIMAL (9,2),
    fecha_cambio_p_s DATE
);
DELIMITER //
CREATE TRIGGER bitacora_servicio_cambio_precio
AFTER UPDATE ON tipos_servicio
FOR EACH ROW
BEGIN
	IF NEW.precio_tipo_servicio <> OLD.precio_tipo_servicio THEN
		INSERT INTO cambio_precio_servicio (servicio_modificado, servicio_viejo, servicio_nuevo, fecha_cambio_p_s) 
        VALUES (NEW.nombre_tipo_servicio, OLD.precio_tipo_servicio, NEW.precio_tipo_servicio, CURDATE());
	  END IF;
END //
DELIMITER ;

#3. Control de inventario
CREATE TABLE existencias_productos
(
	id_existencias INT PRIMARY KEY AUTO_INCREMENT,
    producto VARCHAR(100) NOT NULL,
    existencias_nuevas INT, 
    movimiento ENUM('Ingresado','Retirado'),
    fecha_cambio_inventario date
);

DELIMITER //
CREATE TRIGGER bitacora_productos_existencias_compradas_ins
AFTER INSERT ON detalle_productos
FOR EACH ROW
BEGIN
	
    INSERT INTO existencias_productos (producto, existencias_nuevas, movimiento, fecha_cambio_inventario) VALUES (
    (SELECT productos.nombre_producto
    FROM productos
     WHERE productos.id_producto = NEW.detalle_producto_detalle_producto_FK), NEW.existencias_detalle_producto, 1, NOW());

END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER bitacora_productos_existencias_compradas_upt
AFTER UPDATE ON detalle_productos
FOR EACH ROW
BEGIN

IF NEW.existencias_detalle_producto > OLD.existencias_detalle_producto THEN
	
    INSERT INTO existencias_productos (producto, existencias_nuevas, movimiento, fecha_cambio_inventario) VALUES (
    (SELECT productos.nombre_producto
    FROM productos
     WHERE productos.id_producto = OLD.detalle_producto_detalle_producto_FK), NEW.existencias_detalle_producto, 1, NOW());
    END IF ;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER bitacora_productos_existencias_vendidas_upt
AFTER UPDATE ON detalle_orden_venta
FOR EACH ROW
BEGIN
	
    INSERT INTO existencias_productos (producto, existencias_nuevas, movimiento, fecha_cambio_inventario) VALUES (
    (SELECT productos.nombre_producto
    FROM productos INNER JOIN detalle_productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
     WHERE detalle_productos.id_detalle_producto = OLD.producto_orden_venta_FK), 
        (SELECT (detalle_productos.existencias_detalle_producto-NEW.cantidad_producto_orden_venta)
    FROM detalle_productos
     WHERE detalle_productos.id_detalle_producto = New.producto_orden_venta_FK),
        2, NOW());
    
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER bitacora_productos_existencias_vendidas_ins
AFTER INSERT ON detalle_orden_venta
FOR EACH ROW
BEGIN
	
    INSERT INTO existencias_productos (producto, existencias_nuevas, movimiento, fecha_cambio_inventario) VALUES (
    (SELECT productos.nombre_producto
    FROM productos INNER JOIN detalle_productos ON detalle_productos.detalle_producto_detalle_producto_FK = productos.id_producto
     WHERE detalle_productos.id_detalle_producto = NEW.producto_orden_venta_FK), 
        (SELECT (detalle_productos.existencias_detalle_producto-NEW.cantidad_producto_orden_venta)
    FROM detalle_productos
     WHERE detalle_productos.id_detalle_producto = New.producto_orden_venta_FK),
        2, NOW());
    
END //
DELIMITER ;

        
        
#PROCEDIMIENTOS ALMACENADOS
#1.	Historial de compra de un cliente
#CALL historial_compras(1);
DELIMITER //
CREATE PROCEDURE `historial_compras`(IN id_cliente INT)
BEGIN
SELECT 
        `orden_venta`.`id_venta` AS `id_venta`,
        GROUP_CONCAT(`detalles`.`nombre_producto`
            SEPARATOR '| ') AS `productos`,
        GROUP_CONCAT(`detalles`.`imagen_detalle_producto`
            SEPARATOR '| ') AS `imagen_detalle_producto`,
        GROUP_CONCAT(`detalles`.`nombre_color`
            SEPARATOR ', ') AS `color`,
        GROUP_CONCAT(`detalle_orden_venta`.`cantidad_producto_orden_venta`
            SEPARATOR ', ') AS `cantidades`,
		SUM(`detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `cantidad_total`,
        GROUP_CONCAT(`detalle_orden_venta`.`precio_detalle_orden`
            SEPARATOR ', ') AS `precio_individual`,
        SUM(`detalles`.`precio_producto` * `detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `precio_total`,
        `orden_venta`.`fecha_creacion_orden_venta` AS `fecha_de_compra`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
    WHERE id_usuario = id_cliente
	 GROUP BY `orden_venta`.`id_venta`;
END //
DELIMITER ;


#2.	Generar cita
#CALL agregar_cita('1','2023-08-20','8:00:00', '...');
DELIMITER //
CREATE PROCEDURE `agregar_cita`(IN cliente INT, IN fecha DATE, IN hora TIME, IN des TEXT)
BEGIN
INSERT INTO registros_cita(cliente_registro_cita_FK, fecha_cita_registro_cita, hora_registro_cita, descripcion_registro_cita) VALUES
(cliente, fecha, hora, des);
END //
DELIMITER ;

#3.	Dar de alta un producto
#CALL agregar_producto('Labial Yuya', '...', '20', 1);
DELIMITER //
CREATE PROCEDURE `agregar_producto` (in producto VARCHAR(100), in des TEXT, in precio DECIMAL(9,2), in catego INT)
BEGIN
INSERT INTO productos(nombre_producto, descripcion_producto, precio_producto, categoria_producto_FK) VALUES
(producto, des, precio, catego);
END //
DELIMITER ;

#4. Detallar un producto
#CALL agregar_detalle_producto(21,3,5,'labialrojo.jpg');
DELIMITER //
CREATE PROCEDURE `agregar_detalle_producto` (in producto INT, in color INT, in existencia INT, in img VARCHAR(100))
BEGIN
INSERT INTO detalle_productos(detalle_producto_detalle_producto_FK, color_detalle_producto_FK, existencias_detalle_producto, imagen_detalle_producto) VALUES
(producto, color, existencia, img);
END //
DELIMITER ;

#5.	Actualizar existencias 
#CALL actualizar_exitencia(21,51);
DELIMITER //
CREATE PROCEDURE `actualizar_exitencia`(in producto INT, in existencian INT)
BEGIN
UPDATE detalle_productos
SET existencias_detalle_producto = existencian
WHERE id_detalle_producto = producto;
END //
DELIMITER ;

#6.	Registrar un cliente
#CALL agregar_usuario('Victor Mata Silva', '1234', 'vitor@gmail.com', '1234567890', '2004-07-20', 1);
DELIMITER //
CREATE PROCEDURE `agregar_usuario` (IN cliente VARCHAR(70), IN pass VARCHAR(500), IN mail VARCHAR(50), IN tel CHAR(10), IN nacimiento DATE, IN sex INT)
BEGIN
INSERT INTO usuarios(nombre_usuario, contraseña_usuario, email_usuario, telefono_usuario, fecha_nacimiento_usuario, sexo_usuario) VALUES
(cliente, pass, mail, tel, naciminto, sex);
END //
DELIMITER ;

#7.	Edita número de teléfono
#CALL nuevo_telefono(1, '8713719607');
DELIMITER //
CREATE PROCEDURE nuevo_telefono(
    IN id INT,
    IN nuevo_telefono CHAR(10)
)
BEGIN
    UPDATE usuarios
    SET telefono_usuario = nuevo_telefono
    WHERE id_usuario = id;
END //
DELIMITER ;

#8. Editar correo
#CALL nuevo_correo(1,'guapa@gmail.com');
DELIMITER //
CREATE PROCEDURE nuevo_correo(
    IN id INT,
    IN nuevo_correo VARCHAR(50)
)
BEGIN
    UPDATE usuarios
    SET email_usuario = nuevo_correo
    WHERE id_usuario = id;
END //
DELIMITER ;

#9. Editar contraseña
#CALL nueva_contra(1, 'fer');
DELIMITER //
CREATE PROCEDURE nueva_contra(
    IN id INT,
    IN nueva_contrasena VARCHAR(30)
)
BEGIN
    UPDATE usuarios
    SET contraseña_usuario = nueva_contrasena
    WHERE id_usuario = id;
END //
DELIMITER ;

#10 Buscar producto por tipo de categorías
#CALL BuscarProductosPorTipoCategoria('Tratamientos capilares');
DELIMITER //
CREATE PROCEDURE BuscarProductosPorTipoCategoria(
    IN nombre VARCHAR(50)
)
BEGIN
    SELECT bd2.id_producto, bd2.nombre_producto, bd2.descripcion_producto, bd2.precio_producto
	FROM tipo_categorias INNER JOIN (
    SELECT *
    FROM detalle_productos INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
    INNER JOIN tipo_categorias ON productos.categoria_producto_FK = tipo_categorias.id_tipo_categoria
    WHERE detalle_productos.existencias_detalle_producto >0
) AS bd2 ON tipo_categorias.nombre_tipo_categoria = bd2.nombre_tipo_categoria
WHERE tipo_categorias.nombre_tipo_categoria =  nombre;

END //
DELIMITER ;

#11. Buscar producto por colores y por nombre
#CALL busca_producto_color_nom('Kuu');
DELIMITER //
CREATE PROCEDURE busca_producto_color_nom(
    IN busca VARCHAR(50)
)
BEGIN
SET @busca = CONCAT('%', busca, '%');
   SELECT productos.nombre_producto, productos.precio_producto, bd6.imagen_detalle_producto
FROM productos INNER JOIN
(
    SELECT productos.id_producto, productos.nombre_producto, productos.precio_producto, detalle_productos.existencias_detalle_producto, detalle_productos.imagen_detalle_producto, colores.nombre_color
	FROM detalle_productos
	INNER JOIN productos ON productos.id_producto = detalle_productos.detalle_producto_detalle_producto_FK
	INNER JOIN tipo_categorias ON tipo_categorias.id_tipo_categoria = productos.categoria_producto_FK
	LEFT JOIN colores ON detalle_productos.color_detalle_producto_FK = colores.id_color
	Where detalle_productos.existencias_detalle_producto > 0
) AS bd6 ON productos.id_producto = bd6.id_producto
WHERE bd6.nombre_producto LIKE @busca OR bd6.nombre_color LIKE @busca;
END //
DELIMITER ;


#12. Cambiar el estado a pagado de una orden de venta
#CALL confirmar_venta('ORN103');
DELIMITER //
CREATE PROCEDURE confirmar_venta(IN orden CHAR(10)
)
BEGIN
    UPDATE orden_venta
	SET estado_orden_venta = 'Pagado', fecha_entrega_orden_venta = NOW()
	WHERE id_venta = orden;
END //
DELIMITER ;

#13. Cambiar el estado a cancelado de una orden de venta
#CALL cancelar_venta('ORN001');
DELIMITER //
CREATE PROCEDURE cancelar_venta(IN orden CHAR(10)
)
BEGIN
    UPDATE orden_venta
SET estado_orden_venta = 'Cancelado'
WHERE id_venta = orden;
END //
DELIMITER ;

#14. Actualizar orden
#CALL actualizar_orden('ORN012', '2023-08-01', 'Pagado');
DELIMITER //
CREATE PROCEDURE `actualizar_orden`(in id_orden char(10),in fecha_entrega date ,in nuevo_estado enum('Pendiente', 'Pagado', 'Cancelado', 'Caducado'))
BEGIN
UPDATE orden_venta
SET fecha_entrega_orden_venta = fecha_entrega, estado_orden_venta = nuevo_estado
WHERE id_venta = id_orden;
END //
DELIMITER ;

#15. Actualizar estado de la cita
#call actualizar_estado_cita(20, 'Aceptada');
DELIMITER //
CREATE PROCEDURE `actualizar_estado_cita`(in id_cita INT, in nuevo_estado enum('Pendiente', 'Aceptada', 'Cancelada'))
BEGIN
UPDATE registros_cita 
SET estado_registro_cita = nuevo_estado
WHERE id_registro_cita = id_cita;
END //
DELIMITER ;

#16. Filtro para bitacora de cambio de precio de unn producto
#CALL Filtro_cambio_precio_producto('2023-08-01', '2023-08-20');
DELIMITER //
CREATE PROCEDURE `Filtro_cambio_precio_producto`(IN Fecha_inicial DATE, IN Fecha_final DATE)
BEGIN
SELECT producto_modificado, precio_viejo, precio_nuevo, fecha_cambio_p_p
FROM cambio_precio_producto
WHERE fecha_cambio_p_p BETWEEN Fecha_inicial AND Fecha_final;
END //
DELIMITER ;

#17. Filtro para bitacora cambio de precio de un servicio
#CALL Filtro_cambio_precio_servicio('2023-08-01', '2023-08-20');
DELIMITER //
CREATE PROCEDURE `Filtro_cambio_precio_servicio`(IN Fecha_inicial DATE, IN Fecha_final DATE)
BEGIN
SELECT servicio_modificado, servicio_viejo AS 'Precio anterior', servicio_nuevo AS 'Nuevo precio', fecha_cambio_p_s AS 'Fecha del cambio'
FROM cambio_precio_servicio
WHERE fecha_cambio_p_s BETWEEN Fecha_inicial AND Fecha_final;
END //
DELIMITER ;

#18. Consultar una orden pendiente
#CALL Consultar_orden('ORN001');
DELIMITER //
CREATE PROCEDURE `Consultar_orden`(IN Codigo char(10))
BEGIN
SELECT 
        `orden_venta`.`id_venta` AS `id_venta`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        `detalles`.`nombre_producto` AS `productos`,
        `detalles`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
        `detalles`.`nombre_color` AS `color`,
        `detalle_orden_venta`.`cantidad_producto_orden_venta` AS `cantidad_producto_orden_venta`,
        `detalle_orden_venta`.`precio_detalle_orden` AS `precio_detalle_orden`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
    WHERE `orden_venta`.`estado_orden_venta` = 'Pendiente' AND id_venta = Codigo;
END //
DELIMITER ;

#19. Historial Citas
#CALL historial_cita(14);
DELIMITER //
CREATE PROCEDURE `historial_cita`(IN id_cliente INT)
BEGIN
SELECT 
        `registros_cita`.`id_registro_cita` AS `id_registro_cita`,
        GROUP_CONCAT(`detalles_registros_cita`.`id_detalle_registro_cita`
            SEPARATOR ', ') AS `id_detalle_registro_cita`,
        GROUP_CONCAT(`tipos_servicio`.`nombre_tipo_servicio`
            SEPARATOR ', ') AS `tipos_servicio`,
            GROUP_CONCAT(`detalles_registros_cita`.`precio_registro_cita`
            SEPARATOR ', ') AS `precio_cita`,
		`registros_cita`.`descripcion_registro_cita` AS `Descripcion`,
        SUM(`detalles_registros_cita`.`precio_registro_cita`) AS `precio_total_cita`,
        `registros_cita`.`fecha_creacion_registro_cita` AS `fecha_creacion_registro_cita`,
        `registros_cita`.`fecha_cita_registro_cita` AS `fecha_cita_registro_cita`,
        `registros_cita`.`hora_registro_cita` AS `hora_registro_cita`,
        `registros_cita`.`estado_registro_cita` AS `estado_registro_cita`
    FROM
        (((`registros_cita`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `registros_cita`.`cliente_registro_cita_FK`))
        LEFT JOIN `detalles_registros_cita` ON (`detalles_registros_cita`.`registro_cita_detalle_registro_FK` = `registros_cita`.`id_registro_cita`))
        LEFT JOIN `tipos_servicio` ON (`detalles_registros_cita`.`tipo_servicio_registro_cita_FK` = `tipos_servicio`.`id_tipo_servicio`))
        WHERE cliente_registro_cita_FK = id_cliente
    GROUP BY `registros_cita`.`id_registro_cita`
    ORDER BY registros_cita.fecha_cita_registro_cita DESC;
END //
DELIMITER ;

#20. Cambio de precio para el servicio de una cita
#CALL cambio_precio_servicio_cita(1, 150);
DELIMITER //
CREATE PROCEDURE `cambio_precio_servicio_cita`(IN ids TEXT, IN precios TEXT)
BEGIN
    DECLARE i INT;
    DECLARE nuevo_precio DECIMAL(9, 2);
    DECLARE id_detalle INT;

    SET i = 1;

    WHILE i <= LENGTH(ids) - LENGTH(REPLACE(ids, ',', '')) + 1 DO
        SET id_detalle = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(ids, ',', i), ',', -1) AS UNSIGNED);
        SET nuevo_precio = CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(precios, ',', i), ',', -1) AS DECIMAL(9, 2));
        
        UPDATE detalles_registros_cita
        SET precio_registro_cita = nuevo_precio
        WHERE id_detalle_registro_cita = id_detalle;

        SET i = i + 1;
    END WHILE;
END //
DELIMITER ;

#21. Cancelar una cita
#CALL cancelar_cita(1);
DELIMITER //
CREATE PROCEDURE `cancelar_cita`(in id_cita INT)
BEGIN
UPDATE registros_cita 
SET estado_registro_cita = 'Cancelada'
WHERE id_registro_cita = id_cita;
END //
DELIMITER ;

#22. Cambiar nombre de usuario
#CALL nuevo_nombre(14, 'Veronica Domínguez Gonzalez');
DELIMITER //
CREATE PROCEDURE `nuevo_nombre`(IN id_usr INT, IN nom VARCHAR(100))
BEGIN
UPDATE usuarios
SET nombre_usuario = nom
WHERE id_usuario = id_usr;
END //
DELIMITER ;

#23. Cambiar fecha de nacimiento de usuario
#CALL nueva_fecha(14, '1973-02-03');
DELIMITER //
CREATE PROCEDURE `nueva_fecha`(IN id_usr INT, IN fecha VARCHAR(100))
BEGIN
UPDATE usuarios 
SET fecha_nacimiento_usuario = fecha
WHERE id_usuario = id_usr;
END //
DELIMITER ;

#24. Cambiar sexo de usuario
#CALL nuevo_sexo(13, 3);
DELIMITER //
CREATE PROCEDURE `nuevo_sexo`(IN id_usr INT, IN sexo CHAR(10))
BEGIN
UPDATE usuarios
SET sexo_usuario = sexo
WHERE id_usuario = id_usr;
END //
DELIMITER ;

#25. Agregar detalle de la cita
#CALL agregar_detalle_cita(31, 1);
DELIMITER //
CREATE PROCEDURE `agregar_detalle_cita`(IN reg INT, IN tip INT)
BEGIN

	INSERT INTO detalles_registros_cita(registro_cita_detalle_registro_FK, tipo_servicio_registro_cita_FK) VALUES
    (reg, tip);

END //
DELIMITER ;
                               
#26. Agregar orden de venta
#CALL agregar_orden('ORN100', 1);
DELIMITER //
CREATE PROCEDURE `agregar_orden`(IN orden CHAR(10), IN usr INT)
BEGIN

	INSERT INTO orden_venta(id_venta, cliente_orden_venta_FK) VALUES
	(orden, usr);

END //
DELIMITER ;

#27. Agregar detalle orden venta
#CALL agregar_detalle_orden('ORN100', 1, 3);
DELIMITER //
CREATE PROCEDURE `agregar_detalle_orden`(IN ord CHAR(10), IN pro INT, IN can INT)
BEGIN

	INSERT INTO detalle_orden_venta(orden_venta_detalle_orden_FK, producto_orden_venta_FK, cantidad_producto_orden_venta) VALUES
    (ord, pro, can);

END //
DELIMITER ;

#28. Agregar colores
#CALL agregar_colores('Lila');
DELIMITER //
CREATE PROCEDURE `agregar_colores`(IN color VARCHAR(100))
BEGIN

	INSERT INTO colores(nombre_color) VALUES (color);

END //
DELIMITER ;

#29. Agregar servicios
#CALL agregar_servicios('Maquillaje');
DELIMITER //
CREATE PROCEDURE `agregar_servicios`(IN ser VARCHAR(100))
BEGIN

	INSERT INTO servicios(nombre_servicio) VALUES(ser);

END //
DELIMITER ;

#30. Agregar tipos de servicios
#CALL agregar_tipos_servicios('De Bodas', '...', 250, '1:00:00', 6);
DELIMITER //
CREATE PROCEDURE `agregar_tipos_servicios`(IN nom VARCHAR(100), IN des TEXT, IN pre DECIMAL(9,2), IN tim TIME, IN ser INT)
BEGIN

	INSERT INTO tipos_servicio(nombre_tipo_servicio, descripcion_tipo_servicio, precio_tipo_servicio, servicio_tipo_servicio_FK, tiempo_aproximado_servicio) VALUES (nom, des, pre, ser, tim);

END //
DELIMITER ;

#31. Agregar categorias
#CALL agregar_categorias('Accesorios');
DELIMITER //
CREATE PROCEDURE `agregar_categorias`(IN nom VARCHAR(100))
BEGIN

	INSERT INTO categorias(nombre_categoria) VALUES (nom);

END //
DELIMITER ;

#32. Agregar tipo de categorias
#CALL agregar_tipo_categorias('Lentes', 10);
DELIMITER //
CREATE PROCEDURE `agregar_tipo_categorias`(IN nom VARCHAR(100), IN cat INT)
BEGIN

	INSERT INTO tipo_categorias(nombre_tipo_categoria, categoria_tipo_catergoria_FK) VALUES
    (nom, cat);

END //
DELIMITER ;

#33. Filtro ordenes
#CALL Filtros_ordenes('2023-07-15','2023-07-17','','Maria Guadalupe Orona Valero');
DELIMITER //
CREATE PROCEDURE `Filtros_ordenes`(IN Fecha_inicial DATE, IN Fecha_final DATE, IN Estado varchar(30), IN Cliente VARCHAR(70))
BEGIN
SET @cliente_param = CONCAT('%', Cliente, '%');
set @estado_param= concat('%' , Estado , '%');
if (Fecha_inicial = '0000-00-00' and Fecha_final= '0000-00-00') then
SELECT 
		`usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        `orden_venta`.`id_venta` AS `id_venta`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`detalles`.`nombre_color`
            SEPARATOR ', ') AS `color`,
        GROUP_CONCAT(`detalles`.`nombre_producto`
            SEPARATOR '| ') AS `productos`,
        `detalles`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
        GROUP_CONCAT(`detalle_orden_venta`.`cantidad_producto_orden_venta`
            SEPARATOR ', ') AS `cantidades`,
        SUM(`detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `cantidad_total`,
        SUM(`detalles`.`precio_producto` * `detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `precio_total`,
        `orden_venta`.`fecha_creacion_orden_venta` AS `fecha_creacion_orden_venta`,
        `orden_venta`.`fecha_entrega_orden_venta` AS `fecha_entrega_orden_venta`,
        `orden_venta`.`estado_orden_venta` AS `estado_orden_venta`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
         WHERE estado_orden_venta  like @estado_param and usuarios.nombre_usuario LIKE @cliente_param
    GROUP BY `orden_venta`.`id_venta`;
    else
    SELECT 
		`usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        `orden_venta`.`id_venta` AS `id_venta`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`detalles`.`nombre_color`
            SEPARATOR ', ') AS `color`,
        GROUP_CONCAT(`detalles`.`nombre_producto`
            SEPARATOR '| ') AS `productos`,
        `detalles`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
        GROUP_CONCAT(`detalle_orden_venta`.`cantidad_producto_orden_venta`
            SEPARATOR ', ') AS `cantidades`,
        SUM(`detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `cantidad_total`,
        SUM(`detalles`.`precio_producto` * `detalle_orden_venta`.`cantidad_producto_orden_venta`) AS `precio_total`,
        `orden_venta`.`fecha_creacion_orden_venta` AS `fecha_creacion_orden_venta`,
        `orden_venta`.`fecha_entrega_orden_venta` AS `fecha_entrega_orden_venta`,
        `orden_venta`.`estado_orden_venta` AS `estado_orden_venta`
    FROM
        (((`orden_venta`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `orden_venta`.`cliente_orden_venta_FK`))
        JOIN `detalle_orden_venta` ON (`orden_venta`.`id_venta` = `detalle_orden_venta`.`orden_venta_detalle_orden_FK`))
        LEFT JOIN (SELECT 
            `productos`.`id_producto` AS `id_producto`,
                `productos`.`nombre_producto` AS `nombre_producto`,
                `productos`.`descripcion_producto` AS `descripcion_producto`,
                `productos`.`precio_producto` AS `precio_producto`,
                `productos`.`categoria_producto_FK` AS `categoria_producto_FK`,
                `detalle_productos`.`id_detalle_producto` AS `id_detalle_producto`,
                `detalle_productos`.`detalle_producto_detalle_producto_FK` AS `detalle_producto_detalle_producto_FK`,
                `detalle_productos`.`color_detalle_producto_FK` AS `color_detalle_producto_FK`,
                `detalle_productos`.`existencias_detalle_producto` AS `existencias_detalle_producto`,
                `detalle_productos`.`imagen_detalle_producto` AS `imagen_detalle_producto`,
                `colores`.`id_color` AS `id_color`,
                `colores`.`nombre_color` AS `nombre_color`
        FROM
            ((`productos`
        JOIN `detalle_productos` ON (`productos`.`id_producto` = `detalle_productos`.`detalle_producto_detalle_producto_FK`))
        LEFT JOIN `colores` ON (`colores`.`id_color` = `detalle_productos`.`color_detalle_producto_FK`))) `detalles` ON (`detalle_orden_venta`.`producto_orden_venta_FK` = `detalles`.`id_producto`))
         WHERE orden_venta.fecha_entrega_orden_venta BETWEEN Fecha_inicial AND Fecha_final and estado_orden_venta like @estado_param and usuarios.nombre_usuario LIKE @cliente_param
    GROUP BY `orden_venta`.`id_venta`;
    end if;
END //
DELIMITER ;

#35. Filtro registros
#CALL Filtros_citas('2023-07-20','2023-07-22','','Maria Guadalupe Orona Valero');
DELIMITER //
CREATE PROCEDURE `Filtros_citas`(IN Fecha_inicial DATE, IN Fecha_final DATE, IN Estado varchar(30), IN Cliente VARCHAR(70))
BEGIN
SET @cliente_param = CONCAT('%', Cliente , '%');
set @estado_param= concat('%', Estado ,'%');
if (Fecha_inicial = '0000-00-00' and Fecha_final= '0000-00-00') then
SELECT 
		`usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        `registros_cita`.`id_registro_cita` AS `id_registro_cita`,
        GROUP_CONCAT(`detalles_registros_cita`.`id_detalle_registro_cita`
            SEPARATOR ', ') AS `id_detalle_registro_cita`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`tipos_servicio`.`nombre_tipo_servicio`
            SEPARATOR ', ') AS `tipos_servicio`,
            GROUP_CONCAT(`detalles_registros_cita`.`precio_registro_cita`
            SEPARATOR ', ') AS `precio_cita`,
		`registros_cita`.`descripcion_registro_cita` AS `Descripcion`,
        SUM(`detalles_registros_cita`.`precio_registro_cita`) AS `precio_total_cita`,
        `registros_cita`.`fecha_creacion_registro_cita` AS `fecha_creacion_registro_cita`,
        `registros_cita`.`fecha_cita_registro_cita` AS `fecha_cita_registro_cita`,
        `registros_cita`.`hora_registro_cita` AS `hora_registro_cita`,
        `registros_cita`.`estado_registro_cita` AS `estado_registro_cita`
    FROM
        (((`registros_cita`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `registros_cita`.`cliente_registro_cita_FK`))
        inner JOIN `detalles_registros_cita` ON (`detalles_registros_cita`.`registro_cita_detalle_registro_FK` = `registros_cita`.`id_registro_cita`))
        inner JOIN `tipos_servicio` ON (`detalles_registros_cita`.`tipo_servicio_registro_cita_FK` = `tipos_servicio`.`id_tipo_servicio`))
        where registros_cita.estado_registro_cita like @estado_param AND usuarios.nombre_usuario LIKE @cliente_param
    GROUP BY `registros_cita`.`id_registro_cita`;
    
    else 
    
    SELECT 
		`usuarios`.`email_usuario` AS `email`,
        `usuarios`.`telefono_usuario` AS `telefono`,
        `registros_cita`.`id_registro_cita` AS `id_registro_cita`,
        GROUP_CONCAT(`detalles_registros_cita`.`id_detalle_registro_cita`
            SEPARATOR ', ') AS `id_detalle_registro_cita`,
        `usuarios`.`nombre_usuario` AS `nombre_usuario`,
        GROUP_CONCAT(`tipos_servicio`.`nombre_tipo_servicio`
            SEPARATOR ', ') AS `tipos_servicio`,
            GROUP_CONCAT(`detalles_registros_cita`.`precio_registro_cita`
            SEPARATOR ', ') AS `precio_cita`,
		`registros_cita`.`descripcion_registro_cita` AS `Descripcion`,
        SUM(`detalles_registros_cita`.`precio_registro_cita`) AS `precio_total_cita`,
        `registros_cita`.`fecha_creacion_registro_cita` AS `fecha_creacion_registro_cita`,
        `registros_cita`.`fecha_cita_registro_cita` AS `fecha_cita_registro_cita`,
        `registros_cita`.`hora_registro_cita` AS `hora_registro_cita`,
        `registros_cita`.`estado_registro_cita` AS `estado_registro_cita`
    FROM
        (((`registros_cita`
        JOIN `usuarios` ON (`usuarios`.`id_usuario` = `registros_cita`.`cliente_registro_cita_FK`))
        inner JOIN `detalles_registros_cita` ON (`detalles_registros_cita`.`registro_cita_detalle_registro_FK` = `registros_cita`.`id_registro_cita`))
        inner JOIN `tipos_servicio` ON (`detalles_registros_cita`.`tipo_servicio_registro_cita_FK` = `tipos_servicio`.`id_tipo_servicio`))
        where registros_cita.fecha_cita_registro_cita BETWEEN Fecha_inicial AND Fecha_final and  registros_cita.estado_registro_cita like @estado_param AND usuarios.nombre_usuario LIKE @cliente_param
    GROUP BY `registros_cita`.`id_registro_cita`;
    end if;
END //
DELIMITER ;

SELECT 'Ya quedo pai <3' AS Mensaje;