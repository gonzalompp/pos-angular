-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2016 a las 03:10:08
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueos`
--

CREATE TABLE IF NOT EXISTS `arqueos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_user` int(11) NOT NULL,
  `id_garzon` int(11) NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `sistema_efectivo` decimal(8,2) NOT NULL,
  `sistema_credito` decimal(8,2) NOT NULL,
  `sistema_debito` decimal(8,2) NOT NULL,
  `sistema_cheque` decimal(8,2) NOT NULL,
  `registrado_efectivo` decimal(8,2) NOT NULL,
  `registrado_credito` decimal(8,2) NOT NULL,
  `registrado_debito` decimal(8,2) NOT NULL,
  `registrado_cheque` decimal(8,2) NOT NULL,
  `upflag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `arqueos`
--

INSERT INTO `arqueos` (`id`, `created_at`, `updated_at`, `id_user`, `id_garzon`, `fecha_desde`, `fecha_hasta`, `sistema_efectivo`, `sistema_credito`, `sistema_debito`, `sistema_cheque`, `registrado_efectivo`, `registrado_credito`, `registrado_debito`, `registrado_cheque`, `upflag`) VALUES
(1, '2016-01-13 20:48:41', '2016-01-13 20:48:41', 1, 1, '2016-01-13 00:00:00', '2016-01-13 23:59:00', '5000.00', '64800.00', '2500.00', '86000.00', '500.00', '456890.00', '340500.00', '984300.00', 0),
(2, '2016-01-13 21:54:58', '2016-01-13 21:54:58', 1, 1, '2016-01-13 00:00:00', '2016-01-13 23:59:00', '5000.00', '64800.00', '2500.00', '86000.00', '5500.00', '67000.00', '3000.00', '90000.00', 0),
(3, '2016-01-13 22:15:28', '2016-01-13 22:15:28', 1, 1, '2016-01-13 00:00:00', '2016-01-13 23:59:00', '5000.00', '64800.00', '2500.00', '86000.00', '600.00', '67777.00', '66666.00', '778567.00', 0),
(4, '2016-01-13 22:20:11', '2016-01-13 22:20:11', 1, 1, '2016-01-13 00:00:00', '2016-01-13 23:59:00', '5000.00', '64800.00', '2500.00', '86000.00', '6666.00', '0.00', '0.00', '0.00', 0),
(5, '2016-01-13 23:14:09', '2016-01-13 23:14:09', 1, 1, '2016-01-13 00:00:00', '2016-01-13 23:59:00', '5000.00', '64800.00', '2500.00', '86000.00', '0.00', '0.00', '0.00', '0.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `created_at`, `updated_at`, `nombre`, `orden`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sushi', 1),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bebidas', 2),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Promociones', 3),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ensaladas', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `codigo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `created_at`, `updated_at`, `codigo`, `valor`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'empresa.nombre', 'OM Gastronomía'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sucursal.nombre', 'Manquehue'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sucursal.direccion', 'Avda. Manquehue 3452, Las Condes'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sucursal.teléfono', '+56 02 66987854'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sucursal.email', 'contacto@omgastronomia.cl'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sucursal.codigo', 'DS3544G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE IF NOT EXISTS `detalles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(8,2) NOT NULL,
  `nombre_producto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `eliminado_por` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id`, `created_at`, `updated_at`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `nombre_producto`, `eliminado`, `eliminado_por`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 3, '1500.00', 'Kanikama Roll', 0, ''),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, 3, '1600.00', 'Mosutoro Roll', 0, ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 3, 5, '1700.00', 'Abocado Roll', 0, ''),
(4, '2016-01-13 18:16:42', '2016-01-13 18:16:42', 2, 1, 2, '4500.00', 'Kanikama Roll', 0, ''),
(5, '2016-01-13 18:16:42', '2016-01-13 18:16:42', 2, 2, 1, '5500.00', 'Mosutoro Roll', 0, ''),
(6, '2016-01-13 18:16:42', '2016-01-13 18:16:42', 2, 3, 2, '6600.00', 'Abocado Roll', 0, ''),
(7, '2016-01-13 18:17:41', '2016-01-13 18:17:41', 3, 9, 1, '20000.00', 'Promo 8 Rolls', 0, ''),
(8, '2016-01-13 18:17:41', '2016-01-13 18:17:41', 3, 10, 2, '23000.00', 'Promo 10 Rolls', 0, ''),
(9, '2016-01-13 18:18:06', '2016-01-13 18:18:06', 4, 1, 1, '4500.00', 'Kanikama Roll', 0, ''),
(10, '2016-01-13 18:18:06', '2016-01-13 18:18:06', 4, 2, 2, '5500.00', 'Mosutoro Roll', 0, ''),
(11, '2016-01-13 18:18:06', '2016-01-13 18:18:06', 4, 3, 1, '6600.00', 'Abocado Roll', 0, ''),
(12, '2016-01-13 18:18:06', '2016-01-13 18:18:06', 4, 9, 1, '20000.00', 'Promo 8 Rolls', 0, ''),
(13, '2016-01-13 18:18:30', '2016-01-13 18:18:30', 5, 1, 5, '4500.00', 'Kanikama Roll', 0, ''),
(14, '2016-09-08 06:03:12', '2016-09-08 06:03:12', 7, 4, 1, '1500.00', 'Cocacola', 0, ''),
(15, '2016-09-08 06:03:12', '2016-09-08 06:03:12', 7, 5, 1, '1500.00', 'Fanta', 0, ''),
(16, '2016-09-08 06:03:12', '2016-09-08 06:03:12', 7, 7, 1, '2500.00', 'Jugo Natural', 0, ''),
(17, '2016-09-08 06:04:14', '2016-09-08 06:04:14', 7, 2, 1, '5500.00', 'Mosutoro Roll', 0, ''),
(18, '2016-09-08 06:04:14', '2016-09-08 06:04:14', 7, 3, 2, '6600.00', 'Abocado Roll', 0, ''),
(19, '2016-09-08 06:04:14', '2016-09-08 06:04:14', 7, 12, 1, '2000.00', 'Tomate', 0, ''),
(20, '2016-09-08 06:04:14', '2016-09-08 06:04:14', 7, 11, 1, '4500.00', 'Chilena', 0, ''),
(21, '2016-09-08 06:04:41', '2016-09-08 06:04:41', 7, 0, 1, '-2000.00', 'Descuento', 0, ''),
(22, '2016-09-08 06:04:41', '2016-09-08 06:04:41', 7, 0, 1, '-5740.00', 'Descuento', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `created_at`, `updated_at`, `nombre`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pendiente'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pagado'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `puestos` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `created_at`, `updated_at`, `nombre`, `puestos`, `observaciones`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #1', 5, ''),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #2', 5, ''),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #3', 5, ''),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #4', 5, ''),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #5', 5, ''),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #6', 5, ''),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa #7', 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_11_180355_create_vendedores_table', 1),
('2015_12_14_192710_create_categorias_table', 1),
('2015_12_14_192728_create_productos_table', 1),
('2015_12_14_192737_create_pedidos_table', 1),
('2015_12_14_192751_create_detalles_table', 1),
('2015_12_15_200304_create_tipos_table', 1),
('2015_12_15_200317_create_estados_table', 1),
('2015_12_15_211649_create_mesas_table', 1),
('2016_01_07_173812_create_configs_table', 1),
('2016_01_07_193410_create_arqueos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subtotal` decimal(19,4) NOT NULL,
  `propina` decimal(19,4) NOT NULL,
  `total` decimal(19,4) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `despacho_direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `despacho_comuna` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `despacho_telefono` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_persona_retira` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `pago_efectivo` decimal(8,2) NOT NULL,
  `pago_credito` decimal(8,2) NOT NULL,
  `pago_debito` decimal(8,2) NOT NULL,
  `pago_cheque` decimal(8,2) NOT NULL,
  `upflag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `created_at`, `updated_at`, `subtotal`, `propina`, `total`, `id_cliente`, `id_tipo`, `id_estado`, `observaciones`, `despacho_direccion`, `despacho_comuna`, `despacho_telefono`, `nombre_persona_retira`, `id_mesa`, `pago_efectivo`, `pago_credito`, `pago_debito`, `pago_cheque`, `upflag`) VALUES
(1, '0000-00-00 00:00:00', '2016-01-13 18:17:33', '17800.0000', '1780.0000', '19580.0000', 0, 1, 2, '', '', '', '', '', 1, '0.00', '0.00', '17800.00', '0.00', 0),
(2, '2016-01-13 18:16:37', '2016-01-13 18:17:18', '27700.0000', '2770.0000', '30470.0000', 0, 1, 2, '', '', '', '', '', 2, '5000.00', '22700.00', '0.00', '0.00', 0),
(3, '2016-01-13 18:17:36', '2016-01-13 18:17:49', '66000.0000', '6600.0000', '72600.0000', 0, 1, 2, '', '', '', '', '', 5, '0.00', '0.00', '0.00', '66000.00', 0),
(4, '2016-01-13 18:17:52', '2016-01-13 18:18:06', '42100.0000', '4210.0000', '46310.0000', 0, 3, 2, '', '', '', '', '', 0, '0.00', '42100.00', '0.00', '0.00', 0),
(5, '2016-01-13 18:18:11', '2016-01-13 18:18:31', '22500.0000', '2250.0000', '24750.0000', 0, 1, 2, '', '', '', '', '', 3, '0.00', '0.00', '2500.00', '20000.00', 0),
(6, '2016-01-14 18:00:05', '2016-01-14 18:00:14', '0.0000', '0.0000', '0.0000', 0, 2, 2, '', '', '', '', '', 0, '0.00', '0.00', '0.00', '0.00', 0),
(7, '2016-01-14 20:15:22', '2016-09-08 06:04:49', '22960.0000', '2296.0000', '25256.0000', 0, 1, 1, '', '', '', '', '', 7, '0.00', '0.00', '0.00', '0.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `created_at`, `updated_at`, `nombre`, `orden`, `categoria_id`, `precio`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kanikama Roll', 1, 1, '4500.00'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mosutoro Roll', 2, 1, '5500.00'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Abocado Roll', 3, 1, '6600.00'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cocacola', 1, 2, '1500.00'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fanta', 2, 2, '1500.00'),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sprite', 3, 2, '1500.00'),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jugo Natural', 3, 2, '2500.00'),
(8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Promo 4 Rolls', 1, 3, '12000.00'),
(9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Promo 8 Rolls', 2, 3, '20000.00'),
(10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Promo 10 Rolls', 3, 3, '23000.00'),
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Chilena', 1, 4, '4500.00'),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tomate', 2, 4, '2000.00'),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lechuga', 3, 4, '2300.00'),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Repollo', 3, 4, '2650.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_corto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fa_icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `css_class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `created_at`, `updated_at`, `nombre`, `nombre_corto`, `tag`, `fa_icon`, `css_class`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa', 'Mesa', 'mesa', 'fa-circle', 'pedido_tipo_mesa'),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Despacho a domicilio', 'Despacho', 'despacho', 'fa-motorcycle', 'pedido_tipo_despacho'),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Retiro en local', 'Retiro', 'retiro', 'fa-home', 'pedido_tipo_retiro'),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mesa vacía', 'Mesa', 'mesa_vacia', 'fa-circle-thin', 'pedido_tipo_mesa_vacia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'caja1', '', '$2y$10$3FOmznGU/zCUayUmPTB4U..YSg3bz0yVF3y4s6qAZyMlo1e3WctoW', 'fXfTzClAY0jgSHnneenERbBX5RdE8pYb3eFST8IOdf38HQnjQE4z738tkdua', '0000-00-00 00:00:00', '2016-09-06 06:11:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `vigente` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `created_at`, `updated_at`, `nombre`, `codigo`, `observaciones`, `vigente`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gonzalo Pérez', '5412', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
