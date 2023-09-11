-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 11-09-2023 a las 19:16:30
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `latrece`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_compra`
--

DROP TABLE IF EXISTS `carrito_compra`;
CREATE TABLE IF NOT EXISTS `carrito_compra` (
  `ID_CARRITO_COMPRA` int(5) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `ESTADO_CARRITO_COMPRA` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_CARRITO_COMPRA`),
  KEY `FK_RELATIONSHIP_7` (`ID_CLIENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrito_compra`
--

INSERT INTO `carrito_compra` (`ID_CARRITO_COMPRA`, `ID_CLIENTE`, `ESTADO_CARRITO_COMPRA`) VALUES
(108, 2, 'PENDIENTE'),
(109, 2, 'PENDIENTE'),
(110, 2, 'PENDIENTE'),
(111, 2, 'PENDIENTE'),
(112, 2, 'PENDIENTE'),
(113, 2, 'PENDIENTE'),
(114, 2, 'PENDIENTE'),
(115, 2, 'PENDIENTE'),
(116, 2, 'PENDIENTE'),
(117, 2, 'PENDIENTE'),
(118, 1, 'PENDIENTE'),
(119, 1, 'PENDIENTE'),
(120, 1, 'PENDIENTE'),
(121, 1, 'PENDIENTE'),
(122, 1, 'PENDIENTE'),
(123, 1, 'PENDIENTE'),
(124, 1, 'PENDIENTE'),
(125, 1, 'PENDIENTE'),
(126, 1, 'PENDIENTE'),
(127, 1, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `ID_PRODUCTO_CATEGORIA` int(5) NOT NULL AUTO_INCREMENT,
  `NOMBRE_CATEGORIA` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCTO_CATEGORIA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`ID_PRODUCTO_CATEGORIA`, `NOMBRE_CATEGORIA`) VALUES
(1, 'LAPIZ'),
(2, 'CARPETA'),
(3, 'CUADERNO'),
(4, 'MOCHILA'),
(5, 'COMBOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `ID_CLIENTE` int(5) NOT NULL AUTO_INCREMENT,
  `NOMBRE_CLIENTE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `APELLIDO_CLIENTE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CEDULA_CLIENTE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CORREO_CLIENTE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USUARIO_CLIENTE` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CONTRASENA_CLIENTE` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ROL` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENTE`),
  UNIQUE KEY `CEDULA_CLIENTE` (`CEDULA_CLIENTE`),
  UNIQUE KEY `CORREO_CLIENTE` (`CORREO_CLIENTE`),
  UNIQUE KEY `USUARIO_CLIENTE` (`USUARIO_CLIENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `NOMBRE_CLIENTE`, `APELLIDO_CLIENTE`, `CEDULA_CLIENTE`, `CORREO_CLIENTE`, `USUARIO_CLIENTE`, `CONTRASENA_CLIENTE`, `ROL`) VALUES
(1, 'CRISTIAN', 'BONILLA', '1312109893', 'cristianbonillamoreira@gmail.com', 'cristianbm02', '$2y$10$s/55X3OZeokw6MsMbhFH5uWJHYQDFNGq1FPImA0ri4oBvoYjwLGVC', 'CLIENTE'),
(2, 'CROSO', 'SAPE', '1234567890', 'mcgiver_360@hotmail.com', 'croso', '$2y$10$nr4cYBlkaBivkDKkpCkr1OG4mAbp3r7oqGBv3a.i2X7p9pbo7RDYa', 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combo_producto`
--

DROP TABLE IF EXISTS `combo_producto`;
CREATE TABLE IF NOT EXISTS `combo_producto` (
  `ID_COMBO_PRODUCTO` int(5) NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO` int(11) NOT NULL,
  `PRO_ID_PRODUCTO` int(11) NOT NULL,
  PRIMARY KEY (`ID_COMBO_PRODUCTO`),
  KEY `FK_ID_PRODUCTO` (`ID_PRODUCTO`),
  KEY `FK_PRO_ID_PRODUCTO` (`PRO_ID_PRODUCTO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `combo_producto`
--

INSERT INTO `combo_producto` (`ID_COMBO_PRODUCTO`, `ID_PRODUCTO`, `PRO_ID_PRODUCTO`) VALUES
(1, 7, 2),
(2, 7, 4),
(3, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_compra`
--

DROP TABLE IF EXISTS `detalle_orden_compra`;
CREATE TABLE IF NOT EXISTS `detalle_orden_compra` (
  `ID_DETALLE_ORDEN_COMPRA` int(5) NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO` int(11) NOT NULL,
  `ID_ORDEN_COMPRA` int(11) NOT NULL,
  PRIMARY KEY (`ID_DETALLE_ORDEN_COMPRA`),
  KEY `FK_RELATIONSHIP_6` (`ID_PRODUCTO`),
  KEY `FK_RELATIONSHIP_9` (`ID_ORDEN_COMPRA`)
) ENGINE=InnoDB AUTO_INCREMENT=521 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_orden_compra`
--

INSERT INTO `detalle_orden_compra` (`ID_DETALLE_ORDEN_COMPRA`, `ID_PRODUCTO`, `ID_ORDEN_COMPRA`) VALUES
(457, 7, 109),
(458, 2, 109),
(459, 2, 109),
(460, 2, 109),
(461, 2, 109),
(462, 4, 109),
(463, 7, 110),
(464, 2, 110),
(465, 2, 110),
(466, 2, 110),
(467, 2, 110),
(468, 4, 110),
(469, 7, 111),
(470, 2, 111),
(471, 2, 111),
(472, 2, 111),
(473, 2, 111),
(474, 4, 111),
(475, 7, 112),
(476, 2, 112),
(477, 2, 112),
(478, 2, 112),
(479, 2, 112),
(480, 4, 112),
(481, 4, 113),
(482, 4, 114),
(483, 4, 115),
(484, 4, 116),
(485, 4, 117),
(486, 3, 118),
(487, 3, 119),
(488, 3, 120),
(489, 3, 121),
(490, 3, 122),
(491, 5, 123),
(492, 3, 124),
(493, 5, 124),
(494, 7, 124),
(495, 1, 124),
(496, 1, 124),
(497, 1, 124),
(498, 1, 124),
(499, 7, 125),
(500, 5, 125),
(501, 5, 125),
(502, 5, 125),
(503, 5, 125),
(504, 5, 125),
(505, 1, 125),
(506, 1, 125),
(507, 1, 125),
(508, 1, 125),
(509, 1, 125),
(510, 4, 125),
(511, 4, 125),
(512, 8, 126),
(513, 8, 126),
(514, 8, 126),
(515, 8, 127),
(516, 5, 127),
(517, 5, 127),
(518, 7, 127),
(519, 7, 127),
(520, 3, 127);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
CREATE TABLE IF NOT EXISTS `metodo_pago` (
  `ID_METODO_PAGO` int(7) NOT NULL AUTO_INCREMENT,
  `NOMBRE_METODO_PAGO` char(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_METODO_PAGO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `metodo_pago`
--

INSERT INTO `metodo_pago` (`ID_METODO_PAGO`, `NOMBRE_METODO_PAGO`) VALUES
(1, 'DEUNA'),
(2, 'TRANSFERENCIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

DROP TABLE IF EXISTS `orden_compra`;
CREATE TABLE IF NOT EXISTS `orden_compra` (
  `ID_ORDEN_COMPRA` int(5) NOT NULL AUTO_INCREMENT,
  `ID_CARRITO_COMPRA` int(11) NOT NULL,
  `ID_METODO_PAGO` int(11) NOT NULL,
  `TELEFONO` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIPO_ENTREGA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FECHA` datetime DEFAULT CURRENT_TIMESTAMP,
  `DIRECCION` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'No hay direccion',
  `SUBTOTAL_ORDEN_COMPRA` decimal(7,2) DEFAULT NULL,
  `RECARGO` decimal(7,2) DEFAULT '0.00',
  `IVA_ORDEN_COMPRA` decimal(7,2) DEFAULT NULL,
  `TOTAL_ORDEN_COMPRA` decimal(7,2) DEFAULT NULL,
  `ESTADO_ORDEN` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_ORDEN_COMPRA`),
  KEY `FK_RELATIONSHIP_10` (`ID_METODO_PAGO`),
  KEY `FK_RELATIONSHIP_8` (`ID_CARRITO_COMPRA`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`ID_ORDEN_COMPRA`, `ID_CARRITO_COMPRA`, `ID_METODO_PAGO`, `TELEFONO`, `TIPO_ENTREGA`, `FECHA`, `DIRECCION`, `SUBTOTAL_ORDEN_COMPRA`, `RECARGO`, `IVA_ORDEN_COMPRA`, `TOTAL_ORDEN_COMPRA`, `ESTADO_ORDEN`) VALUES
(109, 108, 1, '0986314641', 'DELIVERY', '2023-01-16 17:21:34', '0', '21.00', '3.00', '2.52', '26.52', 'PENDIENTE'),
(110, 109, 1, '0986314641', 'DELIVERY', '2023-01-16 17:25:41', '0', '21.00', '3.00', '2.52', '29.52', 'PENDIENTE'),
(111, 110, 1, '0986314641', 'DELIVERY', '2023-01-16 17:28:15', 'calle 31 avenida flavio reyes Referencia: casa blamca de 3 pisos', '21.00', '3.00', '2.52', '32.52', 'PENDIENTE'),
(112, 111, 1, '0986314641', 'DELIVERY', '2023-01-16 17:55:27', 'calle 31 avenida flavio reyes Referencia: casa blamca de 3 pisos', '21.00', '3.00', '2.52', '35.52', 'PENDIENTE'),
(113, 112, 2, '08546456', 'PICKUP', '2023-01-16 17:56:12', '', '2.00', '0.00', '0.24', '2.24', 'PENDIENTE'),
(114, 113, 2, '08546456', 'PICKUP', '2023-01-16 18:04:49', '', '2.00', '0.00', '0.24', '2.24', 'PENDIENTE'),
(115, 115, 2, '08546456', 'PICKUP', '2023-01-16 18:20:27', 'No hay dirección', '2.00', '0.00', '0.24', '2.24', 'PENDIENTE'),
(116, 116, 2, '08546456', 'PICKUP', '2023-01-16 18:21:42', 'No hay direccion', '2.00', '0.00', '0.24', '2.24', 'PENDIENTE'),
(117, 117, 2, '24527257', 'PICKUP', '2023-01-16 19:30:02', 'No hay direccion', '2.00', '0.00', '0.24', '2.24', 'PENDIENTE'),
(118, 118, 2, '66563653', 'PICKUP', '2023-01-16 19:31:28', 'No hay direccion', '15.00', '0.00', '1.80', '16.80', 'PENDIENTE'),
(119, 119, 2, '5254546', 'PICKUP', '2023-01-16 19:34:53', 'No hay direccion', '15.00', '0.00', '1.80', '16.80', 'PENDIENTE'),
(120, 120, 2, 'hftggfhfgh', 'PICKUP', '2023-01-16 19:37:20', 'No hay direccion', '15.00', '0.00', '1.80', '16.80', 'PENDIENTE'),
(121, 121, 1, 'fsdf', 'PICKUP', '2023-01-16 19:37:53', 'No hay direccion', '15.00', '0.00', '1.80', '16.80', 'PENDIENTE'),
(122, 122, 2, 'gtghdfdg', 'PICKUP', '2023-01-16 19:41:38', 'No hay direccion', '15.00', '0.00', '1.80', '16.80', 'PENDIENTE'),
(123, 123, 2, 'asdfsdf', 'PICKUP', '2023-01-16 20:20:07', 'No hay direccion', '1.50', '0.00', '0.18', '1.68', 'PENDIENTE'),
(124, 124, 2, 'dfgdfg', 'PICKUP', '2023-01-16 20:24:50', 'No hay direccion', '27.50', '0.00', '3.30', '30.80', 'PENDIENTE'),
(125, 125, 2, '0986314641', 'PICKUP', '2023-01-16 22:04:24', 'No hay direccion', '23.50', '0.00', '2.82', '26.32', 'PENDIENTE'),
(126, 126, 1, '0986447754', 'DELIVERY', '2023-01-16 22:06:50', 'calle 31 avenida flavio reyes Referencia: frente al hostal canarias', '3000.00', '3.00', '360.00', '3363.00', 'PENDIENTE'),
(127, 127, 2, '0521141514', 'DELIVERY', '2023-01-16 23:21:23', 'Calle 69 Avenida wasi Referencia: diagonal a chaval menudo lol', '1032.00', '3.00', '123.84', '1158.84', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `ID_PRODUCTO` int(5) NOT NULL AUTO_INCREMENT,
  `ID_PRODUCTO_CATEGORIA` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRECIO_PRODUCTO` decimal(7,2) DEFAULT NULL,
  `DESCRIPCION_PRODUCTO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LIMITE_ITEMS` int(11) DEFAULT NULL,
  `EXISTE_PRODUCTO` tinyint(1) DEFAULT NULL,
  `IMAGEN_PRODUCTO` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  KEY `FK_RELATIONSHIP_1` (`ID_PRODUCTO_CATEGORIA`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `ID_PRODUCTO_CATEGORIA`, `NOMBRE_PRODUCTO`, `PRECIO_PRODUCTO`, `DESCRIPCION_PRODUCTO`, `LIMITE_ITEMS`, `EXISTE_PRODUCTO`, `IMAGEN_PRODUCTO`) VALUES
(1, 1, 'LAPIZ MONGOL H1', '1.00', 'LAPIZ MONGOL WASEEE', 20, 1, 'lapiz-mongol-triangular.png'),
(2, 2, 'CUADERNO ESTILO UNIVERSITARIO', '3.00', 'CUADERNO SUPER BACAN ESTILO', 5, 1, 'cuaderno-universitario-estilo.png'),
(3, 4, 'MOCHILA VANS VERDE', '15.00', 'MOCHILERA MAS QUE CHATO', 3, 1, 'mochila-vans-verde.png'),
(4, 3, 'CARPETA ESTILO PASTA DURA', '2.00', 'UFFF TREMENDA CARPETA PAPU LINCE :V', 5, 1, 'carpeta-pasta-dura.png'),
(5, 1, 'LAPIZ WASE', '1.50', 'ESTE LAPIZ ESTA WASE', 10, 1, 'lapiz-wase.png'),
(6, 4, 'MOCHILA BACAN', '5.00', 'LA MOCHILA MAS BACAN DEL MERCADO', 3, 1, 'mochila-bacan.png'),
(7, 5, 'COMBO MOCHILA BACANA', '7.00', '1 MOCHILA BACAN + 1 CARPETA + 1 CUADERNO', 3, 1, 'cod-bo2.png'),
(8, 5, 'COMBO MENUDO LOL', '1000.00', 'MENUDO LOL ESTE COMBO, CUALQUIER COSA...', 20, 1, 'cs.png');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `combo_producto`
--
ALTER TABLE `combo_producto`
  ADD CONSTRAINT `combo_producto_ibfk_1` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`),
  ADD CONSTRAINT `combo_producto_ibfk_2` FOREIGN KEY (`PRO_ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
