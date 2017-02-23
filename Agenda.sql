-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-02-2017 a las 00:22:45
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(255) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `descripcion`) VALUES
(1, 'Favoritos', 'Categoria de favoritos'),
(2, 'Familia', 'Familiares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(255) NOT NULL,
  `nombre` varchar(400) NOT NULL,
  `telefono` varchar(32) DEFAULT NULL,
  `correo` varchar(320) DEFAULT NULL,
  `idCategoria` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idContacto`, `nombre`, `telefono`, `correo`, `idCategoria`) VALUES
(1, 'Victor Isaac Chavez Escamilla', '3338306430', 'victor_neptuno@hotmail.com', 1),
(2, 'Joel Alejandro Morales Garcia', '123123123123', 'joel.morales@hotmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD UNIQUE KEY `unique_idCategoria` (`idCategoria`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD UNIQUE KEY `unique_idContacto` (`idContacto`),
  ADD KEY `lnk_categoria_contacto` (`idCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `lnk_categoria_contacto` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
