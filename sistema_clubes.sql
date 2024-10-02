-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2024 a las 09:47:57
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
-- Base de datos: `sistema_clubes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `club` varchar(50) NOT NULL,
  `fundacion` date NOT NULL,
  `localidad` varchar(60) NOT NULL,
  `contacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`id_club`, `club`, `fundacion`, `localidad`, `contacto`) VALUES
(1, 'Independiente', '1984-07-12', 'Tandil', 29836474),
(2, 'ferro', '1995-09-22', 'tandil', 24942883);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL,
  `deporte` varchar(50) NOT NULL,
  `direccion` varchar(55) NOT NULL,
  `contacto` int(11) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `deporte`, `direccion`, `contacto`, `id_club`) VALUES
(2, 'Futbol', 'Avellaneda 500', 2414324, 1),
(4, 'Basquet', 'Avellaneda 500', 2414324, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id_socio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id_socio`, `nombre`, `apellido`, `dni`, `id_club`) VALUES
(3, 'Tobias', 'Vittor', 343424, 1),
(4, 'Agustin', 'Van Waarde', 46901171, 1),
(10, 'tito', 'en bloque', 412412, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`);

--
-- Indices de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `vincularClub` (`id_club`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id_socio`),
  ADD KEY `idClub` (`id_club`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `vincularClub` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`);

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `idClub` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
