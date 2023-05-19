-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 12:27:43
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gamecore`
--
CREATE DATABASE IF NOT EXISTS `gamecore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gamecore`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(1, 3, '2023-07-07', 'Explicacion de cita 1'),
(2, 3, '2023-06-05', 'Explicacion de cita 2'),
(3, 3, '2023-06-07', 'Explicacion de cita 3'),
(4, 3, '2023-06-07', 'Explicacion de cita 4'),
(6, 4, '2024-03-23', 'Motivo cita1'),
(8, 4, '2024-02-22', 'motivo cita 3\r\n'),
(22, 3, '2222-02-22', '222'),
(26, 10, '2222-02-22', 'cita'),
(28, 10, '2024-02-23', 'cita2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `imagen` text NOT NULL,
  `texto` longtext NOT NULL,
  `fecha` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(1, 'Nuevo juego de aventuras', 'https://prod.assets.earlygamecdn.com/images/Genshin-Impact-microsoft.jpg', 'Un nuevo juego de aventuras acaba de ser lanzado y los fanáticos están emocionados. En el juego, los jugadores pueden explorar un mundo mágico y luchar contra monstruos peligrosos mientras recogen tesoros y objetos especiales. Los gráficos del juego son impresionantes y los personajes son divertidos y únicos. ¡Prepárate para una emocionante aventura!', '2023-03-22', 21),
(2, 'One Piece en vivo: la aventura continúa', 'https://famille-de-geek.com/wp-content/uploads/2023/02/one-piece-netflix-live-action-1024x576.jpg', 'La aclamada serie de anime y manga \"One Piece\" será recreada en una versión en vivo para la pequeña pantalla. La noticia ha causado sensación entre los fanáticos, quienes han estado esperando ansiosamente el anuncio durante años. La serie en vivo promete llevar a los espectadores a través de las aventuras de Monkey D. Luffy y su tripulación de piratas en un mundo lleno de misterio, peligro y acción.\r\n\r\nLos productores han prometido mantener la esencia de la serie original, así como incorporar efectos especiales de alta calidad para hacer que el mundo de \"One Piece\" cobre vida en la pantalla. El elenco para la serie en vivo aún no ha sido anunciado, pero los rumores ya han comenzado a circular sobre quiénes podrían interpretar a los personajes icónicos como Nami, Zoro y Sanji.\r\n\r\nLa recreación de \"One Piece\" en vivo promete ser una experiencia emocionante para los fanáticos de la serie, así como una oportunidad para que los nuevos espectadores se adentren en el mundo de los piratas. ¿Estás listo para unirte a la tripulación del sombrero de paja en su búsqueda del tesoro más grande del mundo? ¡Prepárate para la aventura de tu vida!', '2023-02-02', 21),
(3, 'Nuevo personaje para Super Smash Bros.', 'https://assets-prd.ignimgs.com/2021/12/08/nintendoswitch-supersmashbrosultimate-artwork-04-copy-1529091666080-15331522393881280w-1544148332171-1638977058373.png', 'Un nuevo personaje ha sido agregado al juego de lucha más popular del mundo. Con habilidades de lucha únicas y un aspecto impresionante, este personaje ha cautivado la atención de los jugadores de todo el mundo. Los fanáticos están ansiosos por ver cómo se desempeña en el ring y competir contra él en línea. ¡Prepárate para enfrentar a un nuevo desafío!', '2022-07-12', 21),
(4, 'Your Name: La pelicula de drama más intensa', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/styles/hc_1440x810/public/media/image/2017/03/your-name_1.jpg', 'La película de drama más intensa del año ha llegado y está haciendo olas en todo el mundo. Con una trama emocionante, esta serie ha cautivado a la audiencia. Los críticos la llaman una obra maestra del género y los fanáticos no pueden esperar a ver lo que sucede a continuación. ¡No te pierdas la película de drama más intensa de la temporada!', '2022-07-12', 21),
(5, 'El juego de carreras más emocionante', 'https://fs-prod-cdn.nintendo-europe.com/media/images/10_share_images/games_15/nintendo_switch_4/H2x1_NSwitch_MarioKart8Deluxe_image1600w.jpg', 'El juego de carreras más emocionante de todos los tiempos ha sido lanzado y los fanáticos están enloqueciendo. Con gráficos impresionantes y un juego emocionante, este juego ha llevado el género de carreras a nuevas alturas. Los jugadores pueden competir en una variedad de pistas desafiantes y personalizar sus coches para un rendimiento máximo. ¡Prepárate para la carrera de tu vida!', '2023-03-18', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` text NOT NULL,
  `fNacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` enum('Hombre','Mujer','Otro') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fNacimiento`, `direccion`, `sexo`) VALUES
(3, 'ActualizadoUsuari1', 'Actualizado1', 'prueba1@prueba.com', '123456789', '2023-03-31', 'Calle aleatoria, nº 123', 'Hombre'),
(4, 'Usuario2Actualizado', 'Usuario2', 'prueba2@prueba.com', '123456', '2323-02-02', 'Calle aleatoria, nº 12224', 'Mujer'),
(5, 'Usuario3', 'Usuario3', 'prueba3@prueba.com', '22222', '1894-02-02', 'Sintecho 1234', ''),
(8, 'prueba4', 'prueba4', 'prueba4@prueba.com', '214365879', '2222-02-22', '', 'Hombre'),
(9, 'prueba5', 'prueba5', 'prueba5@prueba.com', '609090909', '2222-02-22', '', 'Hombre'),
(10, 'user7', 'user7', 'prueba7@prueba.com', '123321123', '1111-11-11', '', 'Hombre'),
(11, 'user8', 'user8', 'prueba8@prueba.com', '1413874913', '1111-11-11', '', 'Hombre'),
(12, 'user9', 'user9', 'prueba9@prueba.com', '1317897', '1111-11-11', '', 'Hombre'),
(13, 'user10', 'user10', 'prueba10@prueba.com', '183749', '1111-11-11', '', 'Hombre'),
(14, 'user11', 'user11', 'prueba11@prueba.com', '8974921', '0111-11-11', '', 'Hombre'),
(16, 'user12nombre', 'user12apellido', 'asd@a.com', '1234', '2023-04-17', 'c//: San Cristobal, nº 26', 'Hombre'),
(17, 'user14', 'user14', 'prueba14@prueba.com', '14123123', '2321-11-11', '', 'Hombre'),
(18, 'user15', 'user15', 'prueba15@prueba.com', '15123123', '0001-11-11', '', 'Hombre'),
(19, 'user16', 'user16', 'prueba16@prueba.com', '16123123', '1111-11-11', '', 'Hombre'),
(21, 'admin', 'admin', 'admin@admin.es', '1122334455', '1111-11-11', '', 'Hombre'),
(25, 'prueba24', 'preuab', 'asda@asd', '2143', '0011-11-11', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `contrasenya` text NOT NULL,
  `rol` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `contrasenya`, `rol`) VALUES
(1, 3, 'user1', '$2y$10$VNjHTYdyapyvpTdpK47jG.lPyb/F/yWm5G7byWxXwVc3mRxak5eDu', 'user'),
(2, 4, 'user2', '$2y$10$ZwTYJJ/bt9Q5.Ptny5OAOer87BDI2ij1IZPECdPdEUNmFm/NW02D2', 'user'),
(4, 8, 'user4', '$2y$10$Rhpah18I/mMUEVAo5h/FhuC13L8MsveTR44QtlGtlQjahNR5vQL7m', 'user'),
(5, 9, 'user5', '$2y$10$R8WnaYbQ.oONwags8mQZ1.OwArqOspJWpH9u6ME0P/YisN9K8nUcG', 'user'),
(6, 10, 'user7', '$2y$10$W2AoQBfoVt13fATs5h2N3exDTnS3PDNpT02LPCChEszhudsGk9Dpu', 'user'),
(7, 11, 'user8', '$2y$10$NvYpUhY5v3SFcoXrKaqgNursZy0jTymbGK3H//J5sNUMbcDpxE78e', 'user'),
(8, 12, 'user9', '$2y$10$MoIDO6VaTIcVuuMAaTP5Juetd3S3I.lzZU.nxy/jkX6.6gh5dWhBC', 'user'),
(9, 13, 'user10', '$2y$10$Pgp0rVjxxrTipgHWMYXGJeJcR7C/5YzLvjfPTxmCbzrcaoviDcGau', 'user'),
(10, 14, 'user11', '$2y$10$5jKHQOyMm7p5Ay/FX9/C/e.R5bJXtu0UnZcv7GMKbsx0qVVe3lRMO', 'user'),
(11, 16, 'user12', '$2y$10$4odrBB42n1FProIvqI/R0.A/Mx5FjaHI8etZoqNdQRXbL68A7w2tm', 'user'),
(12, 17, 'user14', '$2y$10$DFGlEW7im4O0QDd2EX34Nu4MtjO0uJXU/ZGg5C4gteWmlIxUeiTqC', 'user'),
(13, 18, 'user15', '$2y$10$MTCXCvTCdZXORPvimbPcL.k36fqxVOOR2WQGeN/slMqhmUMYzVe/q', 'user'),
(14, 19, 'user16', '$2y$10$Da4.YxJ0/tg0.nZl/AnCruNBxBUxs6z5RPFHW9l/AuLc8ZcrqDkWK', 'user'),
(16, 21, 'admin', '$2y$10$VSuhzawiPIKWmjSTVBFbpu33834r.lDprJhGgDaLMlUxnw2X2s6Ai', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `data_cita_FK` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`) USING HASH,
  ADD KEY `data_noticias_FK` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `data_cita_FK` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `data_noticias_FK` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `data_login_FK` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
