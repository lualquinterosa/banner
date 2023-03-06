-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-04-2021 a las 09:21:00
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

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
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banner`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`usersid`, `usersnombre`, `usersmail`, `usersestado`, `userspassword`, `usersrol`) VALUES
(1, 'Administrador', 'admin@admin.com', 'A', '21232f297a57a5a743894a0e4a801fc3', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
