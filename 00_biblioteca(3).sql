-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2023 a las 12:20:04
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
(9, 'alfonso', 'alfonso@medellin.ef', '$2y$10$ckO23HGPmjkxDgVOlpYO3.cUtkV.qYtmNCxj8jsWJIb99gYLrojDK'),
(11, 'javi', 'javi@medellin.ef', '$2y$10$c1TapLAMo.KBG/mI9HTFpeVfDNZl7GqkkMlKwhcj.m2Vwais/sLOW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `cod_fav` int(5) NOT NULL,
  `cod_lib` int(5) NOT NULL,
  `cod_usu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '123456789', 'El Cid', 'ejemplo de libro 1', 'Medellin', 'effuture', 1, 'ejemplo de resumen libro 1', 'Español', 100, 'libro.jpg', '2023-04-11', 0),
(2, '12345678002', 'Maquinavaja', 'ejemplo de libro 2', 'CAli', 'effuture', 1, 'La Biblia (del latín tardío biblĭa, y éste del griego βιβλία [biblía]; literalmente ‘libros’)1​ es un conjunto de libros canónicos que en el cristianismo y en otras religiones se consideran producto de inspiración divina y un reflejo o registro de la relación entre Dios y la humanidad. La Biblia está organizada por dos partes principales: el Antiguo Testamento y el Nuevo Testamento, que se enfoca en Jesucristo y el cristianismo primitivo.\n\nFue en el Concilio de Roma del año 382, cuando la Iglesia católica junto al papa Dámaso I instituyeron el Canon Bíblico con la lista del Nuevo Testamento similar al de Atanasio de Alejandría y los libros del Antiguo Testamento de la Versión de los LXX. Esta versión fue traducida del griego al latín por Jerónimo (la Vulgata) por encargo de la Iglesia. Posteriormente los Concilios regionales de Hipona del 393, III de Cartago del 397 y IV de Cartago del 419, en los cuales participó Agustín de Hipona, aprobaron definitivamente dicho canon. Se atribuye el gran éxito de su distribución en los últimos tiempos a la imprenta, habiendo sido el primer libro realizado por medio de la impresión con tipos móviles (la conocida como Biblia de Gutenberg).10​ En mayo de 2000, se afirmó que «la Biblia ha hecho más para dar forma a la literatura, la cultura y el entretenimiento, que ningún otro libro que se haya escrito. Su influencia en la historia mundial no tiene equiparable, y no tiene síntomas de estar menguando».11​ Cada año se venden unos cien millones de ejemplares de la Biblia,12​13​ habiendo sido traducida a 438 idiomas en su totalidad', 'Español', 150, 'libro.jpg', '2023-04-11', 0),
(3, '1123554887', 'Libro 3', 'ejemplo de libro 3', 'Conde', 'effuture', 1, 'ejemplo de resumen libro 3', 'Español', 120, 'libro.jpg', '2023-04-11', 1),
(4, '1234567890', 'Alfonso Carro', 'ejemplo de libro 4', 'Medellin', 'effuture', 2, 'ejemplo de resumen libro 4', 'Español', 110, 'libro.jpg', '2023-04-11', 1),
(5, '665482124', 'Secretos', 'ejemplo de libro 5', 'Medellin', 'effuture', 2, 'ejemplo de resumen libro 5', 'Español', 130, 'libro.jpg', '2023-04-11', 0),
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
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `cod_not` int(11) NOT NULL,
  `cod_usu` int(11) NOT NULL,
  `cod_lib` int(11) NOT NULL,
  `nom_lib` varchar(200) NOT NULL,
  `fentrega_not` varchar(20) NOT NULL,
  `leida_not` int(1) NOT NULL,
  `fenvio_not` varchar(20) NOT NULL,
  `activa_not` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras`
--

CREATE TABLE `palabras` (
  `cod_pal` int(3) NOT NULL,
  `pal_pal` varchar(20) NOT NULL,
  `letras_pal` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `palabras`
--

INSERT INTO `palabras` (`cod_pal`, `pal_pal`, `letras_pal`) VALUES
(1, 'palabras', '8'),
(2, 'cibernetico', '11'),
(3, 'extraviados', '11'),
(4, 'narval', '6'),
(5, 'licaones', '8'),
(6, 'escafandra', '10'),
(7, 'dentritas', '9'),
(8, 'batofobia', '9'),
(9, 'arrenofobia', '11'),
(10, 'atmosfera', '9');

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
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`cod_not`);

--
-- Indices de la tabla `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`cod_pal`);

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
  MODIFY `cod_adm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `cod_fav` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `genero_lib` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `cod_lib` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `cod_not` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palabras`
--
ALTER TABLE `palabras`
  MODIFY `cod_pal` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `cod_pres` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usu` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `cod_val` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
