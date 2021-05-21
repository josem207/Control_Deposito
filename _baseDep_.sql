-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2019 a las 01:08:58
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base_datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `cod_configuracion` int(20) NOT NULL,
  `cuit_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_empresa` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `dni_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_gerente` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`cod_configuracion`, `cuit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `correo_empresa`, `dni_gerente`, `nombre_gerente`, `correo_gerente`) VALUES
(1, '20-11222333-0', 'ControlDeposito', 'Lavaisse 610', '342-460-1579', 'control@deposito.com', '37685454', 'jose martinez', 'jose.martinez.slb@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo_almacen`
--

CREATE TABLE `consumo_almacen` (
  `id_consumo` int(11) NOT NULL,
  `cod_consumo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_consumo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_consumo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_consumo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `consumo_almacen`
--

INSERT INTO `consumo_almacen` (`id_consumo`, `cod_consumo`, `cod_producto`, `producto_consumo`, `cantidad_consumo`, `fecha_consumo`) VALUES
(3, 'C001', '001', 'bobina cable', '20', '2019-07-24'),
(4, 'C002', '003', 'Arris Sb6141', '30', '2019-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compras`
--

CREATE TABLE `orden_compras` (
  `id_orden_compras` int(11) NOT NULL,
  `cod_compra` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `precio_orden` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_compra` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `orden_compras`
--

INSERT INTO `orden_compras` (`id_orden_compras`, `cod_compra`, `cod_producto`, `producto`, `precio_orden`, `cantidad_compra`, `cuit_proveedor`, `fecha_ingreso`) VALUES
(1, 'I001', '001', 'bobina cable ', '32000', '20', '00-22333555-0', '2019-07-24'),
(2, 'I002', '002', 'fichas rg6 ', '9000', '20', '00-22333555-0', '2019-07-24'),
(3, 'I003', '003', 'Arris Sb6141', '47000', '10', '00334445550', '2019-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `cod_pedido` int(11) NOT NULL,
  `cod_producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto_pedido` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad_pedido` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_pedido` date NOT NULL,
  `cuit_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`cod_pedido`, `cod_producto`, `producto_pedido`, `cantidad_pedido`, `fecha_pedido`, `cuit_proveedor`) VALUES
(1, '003', 'Cablemodem SURFboard SBG6700', '150', '2019-07-24', '00334445550'),
(2, '005', 'divisor 4bocas rg6', '250', '2019-07-24', '00334445550');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_almacen`
--

CREATE TABLE `producto_almacen` (
  `id_producto_almacen` int(11) NOT NULL,
  `cod_producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `existencia` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ubicacion_deposito` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_producto` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto_almacen`
--

INSERT INTO `producto_almacen` (`id_producto_almacen`, `cod_producto`, `producto`, `precio`, `existencia`, `ubicacion_deposito`, `estado_producto`, `cuit_proveedor`, `fecha_ingreso`) VALUES
(1, '001', 'bobina cable rg6 x 152m', '1599', '80', 'deposito-santa fe', 'activo', '00-11222333-0', '2019-07-24'),
(2, '003', 'Cablemodem Arris Sb6141 ', '4700', '70', 'deposito-santa fe', 'activo', '00-11222333-0', '2019-07-24'),
(3, '002', 'fichas rg6 x50u', '450', '120', 'deposito-santa fe', 'ACTIVO', '00334445550', '2019-07-24'),
(4, '004', 'decodificador HD m&m', '1500', '120', 'deposito-santa fe', 'ACTIVO', '00334445550', '2019-07-24'),
(5, '005', 'divisor 4 bocas', '180', '100', 'deposito-santa fe', 'activo', '00-22333555-0', '2019-07-24'),
(6, '005', 'divisor 3 bocas', '170', '100', 'deposito-santa fe', 'ACTIVO', '00-11222333-0', '2019-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `cod_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `cuit_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `direc_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `email_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `tel_proveedor` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`cod_proveedor`, `nombre_proveedor`, `cuit_proveedor`, `ciudad_proveedor`, `direc_proveedor`, `email_proveedor`, `tel_proveedor`, `fecha_ingreso`) VALUES
(3, 'indeca', '00-11222333-0', 'San martín, buenos aires', 'Hipólito Yrigoyen 4442', 'info@indeca.com.ar', '11122233', '2019-07-24'),
(4, 'cableparts', '00-22333555-0', 'capital federal', 'Av. Corrientes 848 3º \"303\"', 'info@cableparts.com.ar', '011 4444-6666', '2019-07-24'),
(5, 'munred', '00334445550', 'Olivos, Buenos aires', 'FRAY JUSTO SARMIENTO 3540', 'info@munred.com.ar', '011 11122233', '2019-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `sector` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `password2` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nivel` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `dni`, `sector`, `usuario`, `password`, `password2`, `nivel`, `fecha_ingreso`) VALUES
(6, 'administrador', '11222333', 'deposito', 'admin', '20207', '20207', 'administrador', '2019-07-24'),
(7, 'empleado', '11000222', 'área técnica', 'empleado', '20207', '20207', 'empleado', '2019-07-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`cod_configuracion`);

--
-- Indices de la tabla `consumo_almacen`
--
ALTER TABLE `consumo_almacen`
  ADD PRIMARY KEY (`id_consumo`);

--
-- Indices de la tabla `orden_compras`
--
ALTER TABLE `orden_compras`
  ADD PRIMARY KEY (`id_orden_compras`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`cod_pedido`);

--
-- Indices de la tabla `producto_almacen`
--
ALTER TABLE `producto_almacen`
  ADD PRIMARY KEY (`id_producto_almacen`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`cod_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `cod_configuracion` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `consumo_almacen`
--
ALTER TABLE `consumo_almacen`
  MODIFY `id_consumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `orden_compras`
--
ALTER TABLE `orden_compras`
  MODIFY `id_orden_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto_almacen`
--
ALTER TABLE `producto_almacen`
  MODIFY `id_producto_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
