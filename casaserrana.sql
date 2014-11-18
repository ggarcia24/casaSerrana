-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2014 a las 23:57:40
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `casaserrana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentoespeciales`
--

CREATE TABLE IF NOT EXISTS `alimentoespeciales` (
  `idAlimentoEspecial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idAlimentoEspecial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriahabitaciones`
--

CREATE TABLE IF NOT EXISTS `categoriahabitaciones` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `categoriahabitaciones`
--

INSERT INTO `categoriahabitaciones` (`idCategoria`, `nombre`) VALUES
(1, 'Casa'),
(2, 'Chalet'),
(3, 'ads');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(10) NOT NULL AUTO_INCREMENT,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci,
  `telefonoFijo` text COLLATE utf8_spanish_ci,
  `telefonoCelular` text COLLATE utf8_spanish_ci,
  `tipoDocumento` text COLLATE utf8_spanish_ci,
  `documento` int(15) DEFAULT NULL,
  `idBancoPorCliente` int(10) DEFAULT NULL,
  `titular` tinyint(1) DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci,
  `idAlimentoEspecial` int(10) DEFAULT NULL,
  `codigoPostal` int(6) DEFAULT NULL,
  `idTarjetaPorCliente` int(10) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `idPadronAfiliado` int(10) DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `apellido`, `nombre`, `direccion`, `telefonoFijo`, `telefonoCelular`, `tipoDocumento`, `documento`, `idBancoPorCliente`, `titular`, `email`, `idAlimentoEspecial`, `codigoPostal`, `idTarjetaPorCliente`, `fechaNacimiento`, `idPadronAfiliado`) VALUES
(1, 'Peñas', 'Matias', 'Pavon', '03541-435930', '03541-15593161', 'DNI', 33034456, 1, 1, 'mattff@live.com', 2, 5152, 0, '1987-11-30', 0),
(4, 'Perez', 'Belen', '', '312312', '321-321321312', '', 3213123, 0, 0, '', 0, 0, 0, '0000-00-00', 0),
(5, 'Perez', 'Juan', NULL, NULL, NULL, 'DNI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Peñass', 'Matias', 'Pavon', '03541-435930', '03541-15593161', 'DNI', 33034456, 1, NULL, 'mattff@live.com', 2, 5152, NULL, '1987-11-30', NULL),
(8, 'Peñas', 'sdaMatias', 'Pavon', '03541-435930', '03541-15593161', 'DNI', 33034456, 1, 1, 'mattff@live.com', 2, 5152, NULL, '1987-11-30', NULL),
(10, 'Perez', 'Belen', NULL, '312312', '321-321321312', 'DNI', 3213123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'ads', 'dsad', NULL, NULL, NULL, 'DNI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'ddsd', 'dsad', NULL, NULL, NULL, 'DNI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '41', '412', NULL, NULL, NULL, 'DNI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nombre`) VALUES
(1, 'Disponible'),
(2, 'Reservada'),
(3, 'Reservada c/ seña'),
(4, 'Ocupada'),
(5, 'No disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE IF NOT EXISTS `habitaciones` (
  `idHabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `idPabellon` int(11) DEFAULT NULL,
  `plazaMaxima` int(3) NOT NULL,
  `idCategoria` int(10) DEFAULT NULL,
  `idEstado` int(10) DEFAULT NULL,
  PRIMARY KEY (`idHabitacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idHabitacion`, `numero`, `idPabellon`, `plazaMaxima`, `idCategoria`, `idEstado`) VALUES
(1, 1, 1, 0, 0, 0),
(6, 231, 1, 0, 1, 2),
(7, 21, 3, 0, 0, 0),
(9, 132, 6, 0, 2, 2),
(10, 313, 12, 0, 0, 0),
(11, 4214, 3, 231, 1, 4),
(13, 56, NULL, 23, NULL, NULL),
(14, 231, 0, 31, NULL, NULL),
(15, 213, 0, 31, NULL, NULL),
(17, 132, 2, 32, NULL, NULL),
(18, 123, 3, 312, NULL, NULL),
(20, 41, 6, 141, NULL, NULL),
(22, 41, 6, 141, 2, 4),
(23, 31231, 8, 31232132, 2, 5),
(25, 9999, 3, 345, 2, 4),
(26, 23, 6, 13, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pabellones`
--

CREATE TABLE IF NOT EXISTS `pabellones` (
  `idPabellon` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idPabellon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `pabellones`
--

INSERT INTO `pabellones` (`idPabellon`, `nombre`) VALUES
(1, 'Gaviota'),
(2, 'Pelicanosoaso'),
(3, 'Gorreado'),
(6, '2PAra probar'),
(8, 'Camilo'),
(9, 'Avellaneda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompania` text COLLATE utf8_spanish_ci NOT NULL,
  `cuit` text COLLATE utf8_spanish_ci NOT NULL,
  `nombreContacto` text COLLATE utf8_spanish_ci,
  `telefonoFijo` text COLLATE utf8_spanish_ci,
  `telefonoCelular` text COLLATE utf8_spanish_ci,
  `provincia` text COLLATE utf8_spanish_ci,
  `localidad` text COLLATE utf8_spanish_ci,
  `email` text COLLATE utf8_spanish_ci,
  `direccion` text COLLATE utf8_spanish_ci,
  `codigoPostal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombreCompania`, `cuit`, `nombreContacto`, `telefonoFijo`, `telefonoCelular`, `provincia`, `localidad`, `email`, `direccion`, `codigoPostal`) VALUES
(1, 'Coca-Cola', '20-32131321-13', 'Juan', '0351-423213', '0351-15593161', 'Cordoba', 'Cordoba', 'juan@coca-cola.com', 'San Martin 321', 5000),
(2, 'Quilmes', '31231231', 'Raul', '0321-321313', '3231-323131233', 'La Rioja', 'La Rioja', 'juan@pepsi.com', 'Maipu 2313', 33213),
(4, 'Prityyy', '32132312', 'Juancito', '32132', '321521', NULL, 'La Falda', NULL, NULL, 321312),
(5, 'dsads', 'dsa', '', '', '', '1', '', NULL, NULL, 0),
(7, '32131', '32131', '', '', '', '1', '', '', '', 0),
(8, 'sisiiii', 'andraaaa', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `idReserva` int(10) NOT NULL AUTO_INCREMENT,
  `idCliente` int(10) NOT NULL,
  `idHabitacion` int(10) NOT NULL,
  `idTarifa` int(10) NOT NULL,
  `idEstado` int(10) NOT NULL,
  `idTipoHuesped` int(10) NOT NULL,
  `fechaIn` date NOT NULL,
  `fechaOut` date NOT NULL,
  `cantidadAdultos` int(5) NOT NULL,
  `cantidadMenores` int(5) NOT NULL,
  `idPago` int(10) NOT NULL,
  PRIMARY KEY (`idReserva`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `idCliente`, `idHabitacion`, `idTarifa`, `idEstado`, `idTipoHuesped`, `fechaIn`, `fechaOut`, `cantidadAdultos`, `cantidadMenores`, `idPago`) VALUES
(1, 2, 3, 3, 2, 1, '2014-11-03', '2014-11-16', 0, 0, 0),
(2, 12, 21, 323, 0, 0, '2014-11-03', '0000-00-00', 0, 0, 0),
(3, 12, 6, 0, 1, 0, '2014-11-14', '2014-11-19', 0, 0, 0),
(4, 132, 11, 0, 3, 0, '2014-11-15', '2014-11-17', 0, 0, 0),
(5, 23, 23, 0, 0, 0, '2014-11-10', '2014-11-14', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `idTarifa` int(10) NOT NULL AUTO_INCREMENT,
  `monto` int(10) NOT NULL,
  `vigencia` date NOT NULL,
  `idCategoria` int(10) NOT NULL,
  PRIMARY KEY (`idTarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE IF NOT EXISTS `tarjetas` (
  `idTarjeta` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idTarjeta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`idTarjeta`, `nombre`) VALUES
(1, ''),
(2, ''),
(3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohuespedes`
--

CREATE TABLE IF NOT EXISTS `tipohuespedes` (
  `tipoHuespedes` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tipoHuespedes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipohuespedes`
--

INSERT INTO `tipohuespedes` (`tipoHuespedes`, `nombre`) VALUES
(1, 'Afiliado'),
(2, 'Invitado'),
(3, 'Jubilado'),
(4, 'Congreso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreUsuario` (`nombreUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombreUsuario`, `clave`, `email`) VALUES
(1, 'ozzytop', '123456', 'mattff@live.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
