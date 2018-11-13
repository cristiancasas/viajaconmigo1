-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2018 a las 05:52:19
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `viajaconmigo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idestado`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idgrupo` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idgrupo`, `idestado`, `nombre`, `descripcion`) VALUES
(1, 1, 'test', 'test'),
(2, 1, 'test', 'test'),
(3, 1, 'test dos', 'test dos'),
(4, 1, 'prueba3', 'prueba3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idhistorial` int(11) NOT NULL,
  `isusuario` int(11) NOT NULL,
  `idruta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preconfirmacion`
--

CREATE TABLE `preconfirmacion` (
  `idpreconfirmacion` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `idruta` int(11) NOT NULL,
  `inicio` varchar(30) NOT NULL,
  `destino` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipousuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Integrante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `otpkey` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `documentoidentidad` varchar(20) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `contrasena` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idtipousuario`, `idestado`, `otpkey`, `nombre`, `apellido`, `documentoidentidad`, `telefono`, `correo`, `usuario`, `contrasena`) VALUES
(1, 2, 1, '000', 'cristian', 'gonzalez', '1049653918', 2147483647, '', 'cristian', '123'),
(2, 1, 1, '000', 'cristian', 'gonzalez', '1049653919', 2147483647, '', 'cristian2', '123'),
(3, 1, 1, '0', 'juan', 'montiel', '882828282', 2147483647, 'juan@gmail.com', 'juan1', '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioporgrupo`
--

CREATE TABLE `usuarioporgrupo` (
  `idusuarioporgrupo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarioporgrupo`
--

INSERT INTO `usuarioporgrupo` (`idusuarioporgrupo`, `idusuario`, `idgrupo`, `idestado`, `tipo`) VALUES
(1, 2, 1, 1, 1),
(4, 3, 2, 1, 1),
(5, 2, 3, 1, 1),
(6, 2, 4, 1, 1),
(7, 1, 1, 1, 2),
(8, 2, 2, 1, 2),
(9, 3, 2, 1, 2),
(10, 3, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioruta`
--

CREATE TABLE `usuarioruta` (
  `idusuarioruta` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idruta` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `idestado` (`idestado`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idhistorial`),
  ADD KEY `isusuario` (`isusuario`),
  ADD KEY `idruta` (`idruta`);

--
-- Indices de la tabla `preconfirmacion`
--
ALTER TABLE `preconfirmacion`
  ADD PRIMARY KEY (`idpreconfirmacion`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`idruta`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idtipousuario` (`idtipousuario`),
  ADD KEY `idestado` (`idestado`);

--
-- Indices de la tabla `usuarioporgrupo`
--
ALTER TABLE `usuarioporgrupo`
  ADD PRIMARY KEY (`idusuarioporgrupo`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idestado` (`idestado`);

--
-- Indices de la tabla `usuarioruta`
--
ALTER TABLE `usuarioruta`
  ADD PRIMARY KEY (`idusuarioruta`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idruta` (`idruta`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idhistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preconfirmacion`
--
ALTER TABLE `preconfirmacion`
  MODIFY `idpreconfirmacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarioporgrupo`
--
ALTER TABLE `usuarioporgrupo`
  MODIFY `idusuarioporgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarioruta`
--
ALTER TABLE `usuarioruta`
  MODIFY `idusuarioruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`isusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`idruta`) REFERENCES `ruta` (`idruta`);

--
-- Filtros para la tabla `preconfirmacion`
--
ALTER TABLE `preconfirmacion`
  ADD CONSTRAINT `preconfirmacion_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`),
  ADD CONSTRAINT `preconfirmacion_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `usuarioporgrupo`
--
ALTER TABLE `usuarioporgrupo`
  ADD CONSTRAINT `usuarioporgrupo_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`),
  ADD CONSTRAINT `usuarioporgrupo_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuarioporgrupo_ibfk_3` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`);

--
-- Filtros para la tabla `usuarioruta`
--
ALTER TABLE `usuarioruta`
  ADD CONSTRAINT `usuarioruta_ibfk_1` FOREIGN KEY (`idruta`) REFERENCES `ruta` (`idruta`),
  ADD CONSTRAINT `usuarioruta_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `usuarioruta_ibfk_3` FOREIGN KEY (`idgrupo`) REFERENCES `grupo` (`idgrupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
