-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gym
CREATE DATABASE IF NOT EXISTS `gym` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `gym`;

-- Volcando estructura para tabla gym.actividad
CREATE TABLE IF NOT EXISTS `actividad` (
  `idActividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `lugar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idActividad`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.comenta_ejercicio
CREATE TABLE IF NOT EXISTS `comenta_ejercicio` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `comentario` varchar(140) DEFAULT NULL,
  `Usuario_ID` int(11) NOT NULL DEFAULT 0,
  KEY `FK_comenta_ejercicio_usuario` (`Usuario_ID`),
  KEY `FK_comenta_ejercicio_ejercicio` (`Ejercicio_idEjercicio`),
  CONSTRAINT `FK_comenta_ejercicio_ejercicio` FOREIGN KEY (`Ejercicio_idEjercicio`) REFERENCES `ejercicio` (`idEjercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_comenta_ejercicio_usuario` FOREIGN KEY (`Usuario_ID`) REFERENCES `usuario` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.deportista_hace_actividad
CREATE TABLE IF NOT EXISTS `deportista_hace_actividad` (
  `Actividad_idActividad` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Actividad_idActividad`,`Usuario_DNI`),
  KEY `fk_Actividad_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  KEY `fk_Actividad_has_Usuario_Actividad1_idx` (`Actividad_idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.deportista_inscrito
CREATE TABLE IF NOT EXISTS `deportista_inscrito` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Actividad_idActividad`),
  KEY `fk_Usuario_has_Actividad_Actividad1_idx` (`Actividad_idActividad`),
  KEY `fk_Usuario_has_Actividad_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.deportista_sesion
CREATE TABLE IF NOT EXISTS `deportista_sesion` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Sesion_idSesion` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  KEY `fk_Usuario_has_Sesion_Sesion1_idx` (`Sesion_idSesion`),
  KEY `fk_Usuario_has_Sesion_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.deportista_tiene_tabla
CREATE TABLE IF NOT EXISTS `deportista_tiene_tabla` (
  `Tabla_idTabla` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Tabla_idTabla`,`Usuario_DNI`),
  KEY `fk_Tabla_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  KEY `fk_Tabla_has_Usuario_Tabla1_idx` (`Tabla_idTabla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.ejercicio
CREATE TABLE IF NOT EXISTS `ejercicio` (
  `idEjercicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `tiempo` varchar(15) DEFAULT NULL,
  `peso` int(3) DEFAULT NULL,
  `repeticiones` varchar(25) DEFAULT NULL,
  `URLImagen` longblob DEFAULT NULL,
  `contador` int(11) DEFAULT 0,
  PRIMARY KEY (`idEjercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.faltas_asistencia
CREATE TABLE IF NOT EXISTS `faltas_asistencia` (
  `fecha` date DEFAULT NULL,
  `Sesion_idSesion` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  KEY `fk_Faltas_asistencia_Sesion1_idx` (`Sesion_idSesion`),
  KEY `fk_Faltas_asistencia_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Tabla_IDTabla` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `NEjercicios` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Usuario_DNI`,`Tabla_IDTabla`,`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.sesion
CREATE TABLE IF NOT EXISTS `sesion` (
  `idSesion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT '00:00:00',
  `nPlazasMax` int(11) NOT NULL,
  `nPlazasActual` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL,
  PRIMARY KEY (`idSesion`),
  KEY `fk_Sesion_Usuario1_idx` (`Usuario_DNI`),
  KEY `fk_Sesion_Actividad1_idx` (`Actividad_idActividad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.tabla
CREATE TABLE IF NOT EXISTS `tabla` (
  `idTabla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `instrucciones` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`idTabla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.tabla_tiene_ejercicio
CREATE TABLE IF NOT EXISTS `tabla_tiene_ejercicio` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `Tabla_idTabla` int(11) NOT NULL,
  PRIMARY KEY (`Ejercicio_idEjercicio`,`Tabla_idTabla`),
  KEY `fk_Ejercicio_has_Tabla_Tabla1_idx` (`Tabla_idTabla`),
  KEY `fk_Ejercicio_has_Tabla_Ejercicio1_idx` (`Ejercicio_idEjercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DNI` varchar(9) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gym.usuario_entrenadores
CREATE TABLE IF NOT EXISTS `usuario_entrenadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_entrenador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_entrenadores_usuario_2` (`id_entrenador`),
  KEY `FK_usuario_entrenadores_usuario` (`id_usuario`),
  CONSTRAINT `FK_usuario_entrenadores_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_entrenadores_usuario_2` FOREIGN KEY (`id_entrenador`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
