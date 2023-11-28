-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS laboratorio4;

USE laboratorio4;


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2023 a las 00:02:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratorio4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `creation_date`) VALUES
(1, 'Ropa', '2023-11-27 21:13:11'),
(2, 'Electrónicos', '2023-11-27 21:13:11'),
(3, 'Hogar y Jardín', '2023-11-27 21:13:11'),
(4, 'Juguetes', '2023-11-27 21:13:11'),
(5, 'Libros', '2023-11-27 21:13:11'),
(6, 'Deportes y Aire libre', '2023-11-27 21:13:11'),
(7, 'Belleza y Cuidado Personal', '2023-11-27 21:13:11'),
(8, 'Alimentos y Bebidas', '2023-11-27 21:13:11'),
(9, 'Automotriz', '2023-11-27 21:13:11'),
(10, 'Electrodomésticos', '2023-11-27 21:13:11'),
(16, 'YuGiOh - TCG', '2023-11-28 22:46:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `marital_status_id` int(11) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `last_name`, `email`, `dni`, `birth_date`, `marital_status_id`, `creation_date`) VALUES
(2, 'Ana', 'Gomez', 'ana.gomez@example.com', '98765432', '1985-08-22', 2, '2023-11-26 19:34:11'),
(3, 'Carlos', 'Rodriguez', 'carlos.rodriguez@example.com', '45678901', '2000-02-10', 3, '2023-11-26 19:34:11'),
(4, 'Laura', 'Fernandez', 'laura.fernandez@example.com', '54321098', '1998-11-28', 4, '2023-11-26 19:34:11'),
(5, 'Pedro', 'Lopez', 'pedro.lopez@example.com', '87654321', '1975-04-03', 5, '2023-11-26 19:34:11'),
(50, 'Pedro', 'Sánchez', 'pedro@gmail.com', '56789012', '1995-07-18', 2, '2023-11-26 19:37:12'),
(51, 'Laura', 'Pérez', 'laura@gmail.com', '67890123', '1983-04-30', 3, '2023-11-26 19:37:12'),
(52, 'Miguel', 'Gómez', 'miguel@gmail.com', '78901234', '1998-01-25', 1, '2023-11-26 19:37:12'),
(53, 'Sofía', 'Díaz', 'sofia@gmail.com', '89012345', '1980-09-12', 2, '2023-11-26 19:37:12'),
(54, 'Javier', 'Hernández', 'javier@gmail.com', '90123456', '1993-06-08', 3, '2023-11-26 19:37:12'),
(55, 'Elena', 'Flores', 'elena@gmail.com', '01234567', '1986-12-03', 1, '2023-11-26 19:37:12'),
(56, 'Raúl', 'Cabrera', 'raul@gmail.com', '11223344', '1996-03-20', 2, '2023-11-26 19:37:12'),
(57, 'Natalia', 'Reyes', 'natalia@gmail.com', '22334455', '1981-10-15', 3, '2023-11-26 19:37:12'),
(58, 'Diego', 'Ortega', 'diego@gmail.com', '33445566', '1994-07-01', 1, '2023-11-26 19:37:12'),
(59, 'Isabel', 'Gutiérrez', 'isabel@gmail.com', '44556677', '1987-04-25', 2, '2023-11-26 19:37:12'),
(60, 'Alejandro', 'Vega', 'alejandro@gmail.com', '55667788', '1997-11-10', 3, '2023-11-26 19:37:12'),
(101, 'Celeste', 'Bonfiglio', 'celeromi18@gmail.com', '88997720', '1999-04-15', 4, '2023-11-26 23:06:19'),
(102, 'Santiago', 'Martinez', 'san.martinezok@gmail.com', '40167887', '1997-08-28', 1, '2023-11-27 02:01:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maritalstatus`
--

CREATE TABLE `maritalstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maritalstatus`
--

INSERT INTO `maritalstatus` (`id`, `name`, `creation_date`) VALUES
(1, 'Soltero', '2023-11-26 19:32:48'),
(2, 'Casado', '2023-11-26 19:32:48'),
(3, 'Divorciado', '2023-11-26 19:32:48'),
(4, 'Viudo', '2023-11-26 19:32:48'),
(5, 'Separado', '2023-11-26 19:32:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `stock` decimal(10,2) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `image_path`, `status`, `stock`, `creation_date`) VALUES
(28, 'Baronesa de la Flor', 16, '200.00', 'views/images/products/baronesa-de-la-flor.png', 'active', '20.00', '2023-11-28 22:47:22'),
(29, 'Infinito Temporal', 16, '300.00', 'views/images/products/infinito-temporal.png', 'inactive', '10.00', '2023-11-28 22:49:23'),
(30, 'Divino Arsenal AA-ZEUS - Trueno del Cielo', 16, '400.00', 'views/images/products/divino-arsenal-aa-zeus---trueno-del-cielo.png', 'active', '20.00', '2023-11-28 22:56:29'),
(31, 'Kurikara Divincarnación', 16, '172.00', 'views/images/products/kurikara-divincarnación.png', 'active', '300.00', '2023-11-28 22:57:17'),
(45, 'Dragon Alado de Ra', 16, '10.00', 'views/images/products/dragon-alado-de-ra.png', 'inactive', '3000.00', '2023-11-28 23:01:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `user_type_id`, `password`, `status`, `creation_date`, `last_login_date`) VALUES
(1, 'Juan', 'Perez', 'juanperez@gmail.com', 1, 'muLuxWocg0yTQ', 'active', '2023-11-21 12:31:10', '2023-11-28 22:19:20'),
(35, 'Tulio', 'Freno', 'tuliofreno@gmail.com', 2, 'muLuxWocg0yTQ', 'inactive', '2023-11-28 22:37:44', NULL),
(36, 'Maria', 'Salas', 'mariasalas@gmail.com', 3, '123456', 'inactive', '2023-11-28 22:41:16', NULL),
(37, 'Carlos', 'Gomez', 'carlosgomez@gmail.com', 3, 'abcdef', 'active', '2023-11-28 22:41:16', NULL),
(38, 'Laura', 'Martinez', 'lauramartinez@gmail.com', 1, 'qwerty', 'active', '2023-11-28 22:41:16', NULL),
(39, 'Ana', 'González', 'ana.gonzalez@email.com', 1, 'clave_segura1', 'active', '2023-11-28 22:42:11', NULL),
(40, 'Pedro', 'Martínez', 'pedro.martinez@email.com', 3, 'clave_segura2', 'active', '2023-11-28 22:42:11', NULL),
(41, 'Laura', 'López', 'laura.lopez@email.com', 1, 'clave_segura3', 'active', '2023-11-28 22:42:11', NULL),
(42, 'Carlos', 'Rodríguez', 'carlos.rodriguez@email.com', 2, 'clave_segura4', 'active', '2023-11-28 22:42:11', NULL),
(43, 'María', 'Sánchez', 'maria.sanchez@email.com', 1, 'clave_segura5', 'active', '2023-11-28 22:42:11', NULL),
(44, 'Javier', 'Hernández', 'javier.hernandez@email.com', 2, 'clave_segura6', 'active', '2023-11-28 22:42:11', NULL),
(45, 'Sofía', 'Díaz', 'sofia.diaz@email.com', 1, 'clave_segura7', 'active', '2023-11-28 22:42:11', NULL),
(46, 'Alejandro', 'Pérez', 'alejandro.perez@email.com', 2, 'clave_segura8', 'active', '2023-11-28 22:42:11', NULL),
(47, 'Elena', 'Gómez', 'elena.gomez@email.com', 1, 'clave_segura9', 'active', '2023-11-28 22:42:11', NULL),
(48, 'Luis', 'Fernández', 'luis.fernandez@email.com', 2, 'clave_segura10', 'inactive', '2023-11-28 22:42:11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usertypes`
--

INSERT INTO `usertypes` (`id`, `name`, `creation_date`) VALUES
(1, 'Supreme Admin', '2023-11-21 12:29:29'),
(2, 'Supervisor', '2023-11-28 20:56:49'),
(3, 'Consultant', '2023-11-23 17:45:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_category_name` (`name`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `marital_status_id` (`marital_status_id`);

--
-- Indices de la tabla `maritalstatus`
--
ALTER TABLE `maritalstatus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_usertypes` (`user_type_id`);

--
-- Indices de la tabla `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `maritalstatus`
--
ALTER TABLE `maritalstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`marital_status_id`) REFERENCES `maritalstatus` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_usertypes` FOREIGN KEY (`user_type_id`) REFERENCES `usertypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
