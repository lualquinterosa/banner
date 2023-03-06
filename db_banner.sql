-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-03-2023 a las 15:05:11
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_banner`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_ingreso` date NOT NULL,
  `banner_retiro` date NOT NULL,
  `banner_titulo` varchar(300) NOT NULL,
  `banner_descripcion` text NOT NULL,
  `banner_file` varchar(400) NOT NULL,
  `banner_link` varchar(400) NOT NULL,
  `banner_atitulo` tinyint(1) NOT NULL,
  `banner_adescripcion` tinyint(1) NOT NULL,
  `banner_aretiro` tinyint(1) NOT NULL,
  `banner_alink` tinyint(1) NOT NULL,
  `banner_activo` varchar(12) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_ingreso`, `banner_retiro`, `banner_titulo`, `banner_descripcion`, `banner_file`, `banner_link`, `banner_atitulo`, `banner_adescripcion`, `banner_aretiro`, `banner_alink`, `banner_activo`) VALUES
(17, '2023-03-06', '2023-03-25', 'Imagen 1', '', './slider/imagenes/1.jpg', 'http://www.google.com', 1, 0, 0, 0, 'Activo'),
(18, '2023-03-06', '2023-03-24', 'Imagen 2', '', './slider/imagenes/18.jpg', 'http://www.google.com', 1, 0, 0, 1, 'Activo'),
(19, '2023-03-06', '2023-03-20', 'Imagen 3', 'Contiene la imagen nÃºmero 3', './slider/imagenes/19.jpg', 'http://www.google.com', 1, 1, 1, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersid` int(6) NOT NULL AUTO_INCREMENT,
  `usersnombre` varchar(120) NOT NULL,
  `usersmail` varchar(120) NOT NULL,
  `usersestado` varchar(1) NOT NULL,
  `userspassword` varchar(120) NOT NULL,
  `usersrol` tinyint(1) NOT NULL,
  PRIMARY KEY (`usersid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usersid`, `usersnombre`, `usersmail`, `usersestado`, `userspassword`, `usersrol`) VALUES
(1, 'Administrador', 'admin@admin.com', 'A', 'e10adc3949ba59abbe56e057f20f883e ', 1),
(2, 'Visitante', 'visitante@visitante.com', 'A', 'e10adc3949ba59abbe56e057f20f883e', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
