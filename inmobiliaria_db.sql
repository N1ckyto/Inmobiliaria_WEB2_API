-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 19:52:04
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
-- Base de datos: `inmobiliaria_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(50) NOT NULL,
  `ubicacion` varchar(30) NOT NULL,
  `m2` int(5) NOT NULL,
  `modalidad` varchar(30) NOT NULL,
  `id_propietario` int(50) NOT NULL,
  `precio_inicial` int(30) NOT NULL,
  `precio_flex` tinyint(1) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `ubicacion`, `m2`, `modalidad`, `id_propietario`, `precio_inicial`, `precio_flex`, `imagen`) VALUES
(4, 'Calle Estrella 89', 75, 'alquiler', 4, 128000, 0, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be'),
(5, 'Avenida Río 56', 100, 'venta', 5, 160000, 0, 'https://plus.unsplash.com/premium_photo-1689609950112-d66095626efb?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(6, 'Calle Jardines 33', 65, 'alquiler', 6, 120000, 1, 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7'),
(7, 'Calle Pinos 12', 105, 'venta', 1, 170000, 1, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be'),
(8, 'Avenida Mar 99', 120, 'alquiler', 2, 140000, 0, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750'),
(9, 'Calle Luna 21', 80, 'venta', 3, 180000, 1, 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7'),
(10, 'Avenida Montaña 10', 90, 'alquiler', 4, 135000, 0, 'https://images.unsplash.com/photo-1686385798052-0e86d41b4a60?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(11, 'Calle Nubes 8', 70, 'alquiler', 5, 125000, 0, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be'),
(12, 'Calle Ríos 14', 110, 'venta', 6, 190000, 1, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750'),
(13, 'Avenida Tierra 22', 85, 'venta', 3, 175000, 1, 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7'),
(14, 'Calle Bosques 50', 95, 'alquiler', 1, 145000, 0, 'https://images.unsplash.com/photo-1716464969424-4f2e31997be8?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(49, 'Avenida Sol 45', 95, 'Alquiler', 2, 300000, 0, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id` int(50) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`id`, `nombre`, `apellido`, `imagen`) VALUES
(1, 'Franco', 'Espinoza', 'https://plus.unsplash.com/premium_photo-1664533227571-cb18551cac82?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(2, 'Lucas', 'Losano', 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(3, 'Soledad', 'Moracho', 'https://plus.unsplash.com/premium_photo-1689266188052-704d33673e69?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(4, 'Joaquín', 'Sanchez', 'https://plus.unsplash.com/premium_photo-1671656349322-41de944d259b?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(5, 'Santiago', 'Gomez', 'https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(6, 'Tomas', 'Echeverría', 'https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(50) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'webadmin', '$2y$10$c0vX38PKVKvh9O9nCeHQjO00.tZ4VJSiAYZ4R7CtEGO02GWrjl0dm');

-- Índices para tablas volcadas
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_propietario` (`id_propietario`);

ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`);

-- AUTO_INCREMENT de las tablas volcadas
--
ALTER TABLE `propiedades`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

ALTER TABLE `propietarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `usuarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Restricciones para tablas volcadas
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `propietarios` (`id`) ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
