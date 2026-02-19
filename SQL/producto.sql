-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2026 a las 11:50:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comercio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idPRODUCTO` int(11) NOT NULL,
  `NOMBRE_PRODUCTO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(150) DEFAULT NULL,
  `PRECIO` float NOT NULL,
  `STOCK` int(11) NOT NULL COMMENT 'Número de unidades disponibles',
  `FOTO` varchar(250) DEFAULT NULL COMMENT 'Enlace de la foto',
  `PAIS` varchar(45) NOT NULL COMMENT 'País de procedencia',
  `idPROVEEDOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idPRODUCTO`, `NOMBRE_PRODUCTO`, `DESCRIPCION`, `PRECIO`, `STOCK`, `FOTO`, `PAIS`, `idPROVEEDOR`) VALUES
(1, 'Muebles', 'Muebles para decorar la casa', 363, 25, 'Muebles.png', 'China', 1),
(2, 'Movil', 'Móviles de última generación', 700, 67, 'Movil.png', 'Estados Unidos', 2),
(3, 'Ventilador', 'Ventiladores de techo', 250, 10, 'Ventilador.png', 'Brasil', 3),
(4, 'Impresoras', 'Impresoras modernas', 80, 75, 'Impresoras.png', 'España', 4),
(5, 'Camisetas', 'Camisetas de buena calidad', 12, 100, 'Camiseta.png', 'España', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idPRODUCTO`),
  ADD KEY `fk_PRODUCTO_PROVEEDOR_idx` (`idPROVEEDOR`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_PRODUCTO_PROVEEDOR` FOREIGN KEY (`idPROVEEDOR`) REFERENCES `proveedor` (`idPROVEEDOR`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
