-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2026 a las 11:50:23
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
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idPROVEEDOR` int(11) NOT NULL COMMENT 'CIF del proveedor',
  `NOMBRE_PROVEEDOR` varchar(45) NOT NULL,
  `DIRECCION` varchar(150) NOT NULL,
  `NACIONALIDAD` varchar(45) NOT NULL,
  `REPRESENTANTE` varchar(45) NOT NULL,
  `CORREO` varchar(150) NOT NULL,
  `TELEFONO` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idPROVEEDOR`, `NOMBRE_PROVEEDOR`, `DIRECCION`, `NACIONALIDAD`, `REPRESENTANTE`, `CORREO`, `TELEFONO`) VALUES
(1, 'Muebles Olajuwon', 'Calle 富恩拉夫拉达', 'Chino', 'Kaicedo', 'olajuwonmuebles@mail.com', '623949503'),
(2, 'Mobile Trending', 'Calle Sun', 'Estado Unidense', 'Lebron', 'mobiletrend@mail.com', '645764832'),
(3, 'Fa Aire', 'Calle Estevao', 'Brasileño', 'Vinicius', 'faaire@mail.com', '648936582'),
(4, 'Impreso a Tinta', 'Calle Luna', 'Español', 'Pepe', 'impresoatinta@mail.com', '694732947'),
(5, 'Camiseta y Tela', 'Calle Tierra', 'Español', 'Jose', 'camisetasytelas@mail.com', '684873776');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idPROVEEDOR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
