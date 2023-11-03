-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2023 a las 14:31:42
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `cod_adm` int(2) NOT NULL,
  `nom_adm` varchar(20) NOT NULL,
  `email_adm` varchar(100) NOT NULL,
  `pass_adm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`cod_adm`, `nom_adm`, `email_adm`, `pass_adm`) VALUES
(4, 'sdadsa', 'pablofvsada', '$2y$10$tw7/rhKlbuRmG9Vi8iJaJ.TvCxtNlMpviMUpilFKtEu8mBnDBicKS'),
(5, 'Pablo', 'pfv@pfv.com', '$2y$10$feTifsKgxSR4m0mZ4Hf6L.VzSq4llZ.ilJSl/mZSs7wrg/9VyyMJq'),
(8, 'Manuel', 'manugv2016@gmail.com', '$2y$10$J2.n0p5c6tHn97QP6GSQq.CQeTJAk8MQ2T.aVdqaxzwn5DtfIW7Cq'),
(9, 'alfonso', 'alfonso@medellin.ef', '$2y$10$ckO23HGPmjkxDgVOlpYO3.cUtkV.qYtmNCxj8jsWJIb99gYLrojDK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `cod_fav` int(5) NOT NULL,
  `cod_lib` int(5) NOT NULL,
  `cod_usu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`cod_fav`, `cod_lib`, `cod_usu`) VALUES
(2, 3, 3),
(4, 4, 6),
(6, 4, 5),
(9, 2, 11),
(10, 1, 6),
(13, 1, 4),
(14, 6, 11),
(16, 3, 27),
(17, 3, 1),
(27, 4, 13),
(28, 15, 1),
(31, 1, 1),
(33, 1, 3),
(38, 4, 3),
(39, 2, 3),
(51, 4, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `genero_lib` int(5) NOT NULL,
  `nom_gen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`genero_lib`, `nom_gen`) VALUES
(1, 'Biología'),
(2, 'Ciencias'),
(3, 'Ciencias Naturales'),
(4, 'Divulgación científica'),
(5, 'Informática'),
(6, 'Ingeniería'),
(7, 'Medicina'),
(8, 'Salud y dietas'),
(9, 'Autoayuda'),
(10, 'Ciencias humamas'),
(11, 'Derecho'),
(12, 'Economía y empresa'),
(13, 'Psicología y pedagogía'),
(14, 'Filosofía'),
(15, 'Sociología'),
(16, 'Idiomas'),
(17, 'Diseño y moda'),
(18, 'Periodismo'),
(19, 'Libros de texto y formación'),
(20, 'Biografías'),
(21, 'Clásicos'),
(22, 'Cuentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `cod_lib` int(5) NOT NULL,
  `isbn_lib` varchar(50) NOT NULL,
  `titulo_lib` varchar(100) NOT NULL,
  `subtitulo_lib` varchar(200) NOT NULL,
  `autor_lib` varchar(100) NOT NULL,
  `editorial_lib` varchar(100) NOT NULL,
  `genero_lib` int(2) NOT NULL,
  `resumen_lib` longtext NOT NULL,
  `idioma_lib` varchar(100) NOT NULL,
  `paginas_lib` int(5) NOT NULL,
  `imagen_lib` varchar(200) NOT NULL,
  `falta_lib` date NOT NULL,
  `disponible_lib` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`cod_lib`, `isbn_lib`, `titulo_lib`, `subtitulo_lib`, `autor_lib`, `editorial_lib`, `genero_lib`, `resumen_lib`, `idioma_lib`, `paginas_lib`, `imagen_lib`, `falta_lib`, `disponible_lib`) VALUES
(1, '123456789', 'El Cid', 'ejemplo de libro 1', 'Medellin', 'effuture', 1, 'ejemplo de resumen libro 1', 'Español', 100, 'libro.jpg', '2023-04-11', 1),
(2, '12345678002', 'Maquinavaja', 'ejemplo de libro 2', 'CAli', 'effuture', 1, 'La Biblia (del latín tardío biblĭa, y éste del griego βιβλία [biblía]; literalmente ‘libros’)1​ es un conjunto de libros canónicos que en el cristianismo y en otras religiones se consideran producto de inspiración divina y un reflejo o registro de la relación entre Dios y la humanidad. La Biblia está organizada por dos partes principales: el Antiguo Testamento y el Nuevo Testamento, que se enfoca en Jesucristo y el cristianismo primitivo.\n\nFue en el Concilio de Roma del año 382, cuando la Iglesia católica junto al papa Dámaso I instituyeron el Canon Bíblico con la lista del Nuevo Testamento similar al de Atanasio de Alejandría y los libros del Antiguo Testamento de la Versión de los LXX. Esta versión fue traducida del griego al latín por Jerónimo (la Vulgata) por encargo de la Iglesia. Posteriormente los Concilios regionales de Hipona del 393, III de Cartago del 397 y IV de Cartago del 419, en los cuales participó Agustín de Hipona, aprobaron definitivamente dicho canon. Se atribuye el gran éxito de su distribución en los últimos tiempos a la imprenta, habiendo sido el primer libro realizado por medio de la impresión con tipos móviles (la conocida como Biblia de Gutenberg).10​ En mayo de 2000, se afirmó que «la Biblia ha hecho más para dar forma a la literatura, la cultura y el entretenimiento, que ningún otro libro que se haya escrito. Su influencia en la historia mundial no tiene equiparable, y no tiene síntomas de estar menguando».11​ Cada año se venden unos cien millones de ejemplares de la Biblia,12​13​ habiendo sido traducida a 438 idiomas en su totalidad', 'Español', 150, 'libro.jpg', '2023-04-11', 1),
(3, '1123554887', 'Libro 3', 'ejemplo de libro 3', 'Conde', 'effuture', 1, 'ejemplo de resumen libro 3', 'Español', 120, 'libro.jpg', '2023-04-11', 0),
(4, '1234567890', 'Alfonso Carro', 'ejemplo de libro 4', 'Medellin', 'effuture', 2, 'ejemplo de resumen libro 4', 'Español', 110, 'libro.jpg', '2023-04-11', 0),
(5, '665482124', 'Secretos', 'ejemplo de libro 5', 'Medellin', 'effuture', 2, 'ejemplo de resumen libro 5', 'Español', 130, 'libro.jpg', '2023-04-11', 1),
(6, '987654321', 'Libro 6', 'ejemplo de libro 6', 'Medellin', 'effuture', 2, 'ejemplo de resumen libro 6', 'Español', 143, 'libro.jpg', '2023-04-11', 1),
(7, '', 'Libro 7', 'ejemplo de libro 7', '', '', 7, 'ejemplo de resumen libro 7', 'Galikorka', 1, 'libro.jpg', '0000-00-00', 0),
(8, '', 'Libro 8', 'ejemplo de libro 8', '', '', 8, 'ejemplo de resumen libro 8', 'Galego', 320, 'libro.jpg', '0000-00-00', 0),
(9, '', 'Libro 9', 'ejemplo de libro 9', '', '', 9, 'ejemplo de resumen libro 9', 'Galego', 254, 'libro.jpg', '0000-00-00', 0),
(10, '', 'Libro 10', 'ejemplo de libro 10', '', '', 10, 'ejemplo de resumen libro 10', 'Galego', 320, 'libro.jpg', '0000-00-00', 1),
(11, '', 'Libro 11', 'ejemplo de libro 11', '', '', 1, 'ejemplo de resumen libro 11', 'Galego', 800, 'libro.jpg', '0000-00-00', 0),
(12, '', 'Libro 12', 'ejemplo de libro 12', '', '', 2, 'ejemplo de resumen libro 12', 'Galego', 1200, 'libro.jpg', '0000-00-00', 0),
(13, '', 'Libro 13', 'ejemplo de libro 13', '', '', 3, 'ejemplo de resumen libro 13', 'Galego', 1300, 'libro.jpg', '0000-00-00', 0),
(14, '', 'Libro 14', 'ejemplo de libro 14', '', '', 4, 'ejemplo de resumen libro 14', 'Castellano', 1400, 'libro.jpg', '0000-00-00', 0),
(15, '', 'Libro 15', 'ejemplo de libro 15', '', '', 5, 'ejemplo de resumen libro 15', 'Castellano', 1500, 'libro.jpg', '0000-00-00', 0),
(16, '', 'Libro 16', 'ejemplo de libro 16', '', '', 6, 'ejemplo de resumen libro 16', 'Castellano', 1600, 'libro.jpg', '0000-00-00', 0),
(17, '', 'Libro 17', 'ejemplo de libro 17', '', '', 7, 'ejemplo de resumen libro 17', 'Castellano', 1700, 'libro.jpg', '0000-00-00', 0),
(18, '', 'Libro 18', 'ejemplo de libro 18', '', '', 8, 'ejemplo de resumen libro 18', 'Castellano', 1800, 'libro.jpg', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `cod_pres` int(5) NOT NULL,
  `cod_lib` int(5) NOT NULL,
  `cod_usu` int(5) NOT NULL,
  `freserva_pres` date NOT NULL,
  `fentrega_pres` date NOT NULL,
  `fprevista_pres` date NOT NULL,
  `fdevolucion_pres` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`cod_pres`, `cod_lib`, `cod_usu`, `freserva_pres`, `fentrega_pres`, `fprevista_pres`, `fdevolucion_pres`) VALUES
(45, 10, 1, '2023-04-26', '0000-00-00', '0000-00-00', '0000-00-00'),
(49, 2, 3, '2023-04-26', '0000-00-00', '0000-00-00', '0000-00-00'),
(55, 5, 9, '2023-04-26', '0000-00-00', '0000-00-00', '0000-00-00'),
(56, 1, 11, '2023-04-26', '0000-00-00', '0000-00-00', '0000-00-00'),
(57, 3, 8, '2023-04-26', '2023-04-27', '2023-05-11', '2023-04-26'),
(58, 3, 8, '2023-04-26', '2023-04-27', '2023-05-11', '2023-04-26'),
(59, 3, 8, '2023-04-26', '2023-04-27', '2023-05-11', '2023-04-26'),
(60, 6, 13, '2023-04-26', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usu` int(5) NOT NULL,
  `nom_usu` varchar(50) NOT NULL,
  `ap1_usu` varchar(50) NOT NULL,
  `ap2_usu` varchar(50) NOT NULL,
  `email_usu` varchar(100) NOT NULL,
  `pass_usu` varchar(100) NOT NULL,
  `activo_usu` int(1) NOT NULL,
  `img_usu` varchar(100) NOT NULL,
  `falta_usu` date NOT NULL,
  `uniq_usu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usu`, `nom_usu`, `ap1_usu`, `ap2_usu`, `email_usu`, `pass_usu`, `activo_usu`, `img_usu`, `falta_usu`, `uniq_usu`) VALUES
(1, 'Manolo', 'Glez', 'Gar', 'manolo@medellin.ef', '$2y$10$FA5hRewa2ypnQ5GjujzZH.Uk2eK3h6XHHNUFycxjldQgE.OACoDFi', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(3, 'Pedro', 'Sánchez', 'Corral', 'pedro@medellin.ef', '$2y$10$4pd2VqTb4E7SAznhHlanuueEEW1fJrXbLykOuah.YWplTmZUpVsb2', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(4, 'Javier', 'Antón', 'Cortés', 'javi@medellin.ef', '$2y$10$CUqjB7Uz8XkymtAMfRrYDe6Zz7zaZrAShI54ZCx5K5UqR1jD0jH52', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(6, 'Alfonso', 'Carro', 'Moris', 'alfonso@medellin.ef', '$2y$10$29pbKiaGH.m5o5TYAv1E8OUI1J4/TbFx4vQVWc954saJniXU3RoTy', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(7, 'Pedro', 'Peche', 'Fernandez', 'peter@medellin.ef', '$2y$10$KPxOYjey.HhiA.ebQ66zje0FmuQ5A9nwJV2FXF71ZhBnuuyxCOT0i', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(8, 'Dani_SPAM', 'Ramos', 'Garcia 🥶', 'dani@medellin.ef', '$2y$10$ckO23HGPmjkxDgVOlpYO3.cUtkV.qYtmNCxj8jsWJIb99gYLrojDK', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(9, 'Manuel', 'Casado', 'Portillo', 'manuel@medellin.ef', '$2y$10$7.M68OgLpTSzhEkSuv.JaejQMp/v4pOQY.s85OpohmV4OqI0ydPtS', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(11, 'Pablo', 'Gesto', 'Rodriguez', 'pablog@medellin.ef', '$2y$10$/I4TGktrMzEjxh/2nljWX.bjfijTDf0tIUlMUvDD4RhB7ruKtX5jW', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(12, 'Lis', 'Garcia', 'Pazos', 'luis@medellin.ef', '$2y$10$goHrI9i2Cq.Ib0s/vkvUJu/WvDf6VJVPjQhlF4fS68fQb7WLECb16', 1, 'http://10.10.10.199/bookbusters/images/Bookbusters (1).png', '2023-04-25', ''),
(13, 'Dino', 'Galikorka', 'Yo', 'dino@medellin.ef', '$2y$10$lrBAuIePo0VeKINKwNCgSOYQccT2WUp4c4PsfMaBajR.KDsJNKhRS', 1, '', '2023-04-26', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `cod_val` int(5) NOT NULL,
  `cod_lib` int(5) NOT NULL,
  `puntos_val` int(2) NOT NULL,
  `texto_val` varchar(200) NOT NULL,
  `act_val` int(11) DEFAULT 0,
  `val_uniq` varchar(200) DEFAULT NULL,
  `fecha_val` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`cod_val`, `cod_lib`, `puntos_val`, `texto_val`, `act_val`, `val_uniq`, `fecha_val`) VALUES
(1, 17, 1, 'asdasdasdasd', 0, '6447c31d101c1', NULL),
(2, 1, 5, 'asdasdasd', 0, '1', NULL),
(3, 1, 4, '', 0, '1', NULL),
(4, 1, 0, '', 0, '6448e6964813a', '2023-04-26'),
(5, 2, 0, '', 0, '6448f9dbd2c89', '2023-04-26'),
(6, 2, 0, '', 0, '6448fa188992b', '2023-04-26'),
(7, 2, 0, '', 0, '6448faf013485', '2023-04-26'),
(8, 2, 0, '', 0, '6448fbbcc447a', '2023-04-26'),
(9, 2, 0, '', 0, '6448fc50734b7', '2023-04-26'),
(10, 2, 0, '', 0, '6448fc898e097', '2023-04-26'),
(11, 2, 0, '', 0, '6448fe39d1410', '2023-04-26'),
(12, 2, 0, '', 0, '6448fed294f2d', '2023-04-26'),
(13, 2, 0, '', 0, '6448ff3b253c8', '2023-04-26'),
(14, 2, 0, '', 0, '6448ff88c50d2', '2023-04-26'),
(15, 2, 0, '', 0, '644909a596bbe', '2023-04-26'),
(16, 1, 0, '', 0, '64490a528697e', '2023-04-26'),
(17, 2, 0, '', 0, '64490b4526a27', '2023-04-26'),
(18, 1, 0, '', 0, '64490cb3005e9', '2023-04-26'),
(19, 1, 0, '', 0, '64490df524cc7', '2023-04-26'),
(20, 5, 0, '', 0, '64490f0cb8b03', '2023-04-26'),
(21, 1, 0, '', 0, '64491084a9932', '2023-04-26'),
(22, 1, 0, '', 0, '644910f6e8687', '2023-04-26'),
(23, 3, 0, '', 0, '644912e85d123', '2023-04-26'),
(24, 3, 0, '', 0, '6449176e218e0', '2023-04-26'),
(25, 3, 0, '', 0, '6449181c5b342', '2023-04-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`cod_adm`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`cod_fav`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`genero_lib`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`cod_lib`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`cod_pres`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usu`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`cod_val`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `cod_adm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `cod_fav` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `genero_lib` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `cod_lib` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `cod_pres` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usu` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `cod_val` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
