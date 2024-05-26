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

-- Volcando datos para la tabla gym.actividad: ~3 rows (aproximadamente)
INSERT INTO `actividad` (`idActividad`, `nombre`, `tipo`, `descripcion`, `lugar`) VALUES
	(14, 'Yoga clásicos', 'Yoga', 'El yoga es una disciplina física y mental que incluye una gran variedad de ejercicios y técnicas de relajación. Ayuda a mejorar la flexibilidad, el equilibrio y la concentración.\r\n', 'Sala de yoga'),
	(15, 'Yoga dinámico', 'Yoga', 'Esta sesión de yoga se enfoca en la práctica de posturas dinámicas y fluidas, coordinadas con la respiración. Es ideal para mejorar la fuerza y la resistencia muscular.', 'Sala de yoga'),
	(16, 'Yoga restaurativo', 'Yoga', 'El yoga restaurativo es una práctica suave y relajante que utiliza posturas de descanso para aliviar el estrés y la tensión muscular. Se centra en la relajación profunda y la restauración del equilibr', 'Sala de yoga'),
	(18, 'BESTCYCLING', 'Ciclismo', 'Sesión de ciclismo indoor para mejorar la resistencia cardiovascular y tonificar las piernas.', 'Sala de Ciclismo'),
	(19, 'BOXEO ANIVERSARIO', 'Boxeo', 'Clase especial de boxeo para celebrar el aniversario del gimnasio, con ejercicios de golpeo y defensa.', 'Sala de Boxeo'),
	(20, 'CARRERA BENEFICA CON CRUZ ROJA', 'Evento Especial', 'Carrera benéfica organizada en colaboración con Cruz Roja para recaudar fondos.', 'Exteriores del Gimnasio'),
	(21, 'G4RUN', 'Running', 'Entrenamiento de running en grupo para mejorar la resistencia y la velocidad.', 'Pista de Atletismo'),
	(22, 'GAP', 'Muscular', 'Clase de tonificación enfocada en glúteos, abdominales y piernas.', 'Sala de Aeróbicos'),
	(23, 'GAP ESPECIAL SAN VALENTIN', 'Muscular', 'Clase de GAP con temática de San Valentín para trabajar glúteos, abdominales y piernas.', 'Sala de Aeróbicos'),
	(24, 'GAP VIRTUAL', 'Muscular', 'Clase de GAP en formato virtual para entrenar desde casa.', 'Sala Virtual'),
	(25, 'GBIKE', 'Ciclismo', 'Sesión regular de ciclismo indoor para mejorar la resistencia cardiovascular.', 'Sala de Ciclismo'),
	(26, 'GBIKE ESPECIAL HOLLYWOOD', 'Ciclismo', 'Clase de ciclismo indoor con temática de películas de Hollywood.', 'Sala de Ciclismo'),
	(27, 'GBIKE ESPECIAL PRIMAVERA', 'Ciclismo', 'Sesión especial de ciclismo indoor para dar la bienvenida a la primavera.', 'Sala de Ciclismo'),
	(28, 'GBODY', 'Muscular', 'Clase de entrenamiento funcional que combina ejercicios de fuerza y resistencia.', 'Sala de Entrenamiento Funcional'),
	(29, 'GBODY (GENIUS IN MOVE)', 'Muscular', 'Entrenamiento funcional avanzado con ejercicios dinámicos y desafiantes.', 'Sala de Entrenamiento Funcional'),
	(30, 'GBODY VIRTUAL', 'Muscular', 'Clase virtual de GBODY para entrenar desde cualquier lugar.', 'Sala Virtual'),
	(31, 'GBOX', 'Boxeo', 'Clase de boxeo con ejercicios de técnica, golpeo y defensa.', 'Sala de Boxeo'),
	(32, 'GBOX (GENIUS IN MOVE)', 'Boxeo', 'Clase avanzada de boxeo con técnicas de alta intensidad.', 'Sala de Boxeo'),
	(33, 'GBOX ANIVERSARIO', 'Boxeo', 'Sesión especial de boxeo para celebrar el aniversario del gimnasio.', 'Sala de Boxeo'),
	(34, 'GBOX ESPECIAL PRIMAVERA', 'Boxeo', 'Clase de boxeo con temática de primavera para energizar tu entrenamiento.', 'Sala de Boxeo'),
	(35, 'GBOX VIRTUAL', 'Boxeo', 'Clase virtual de GBOX para practicar desde casa.', 'Sala Virtual'),
	(36, 'GCORE', 'Muscular', 'Clase enfocada en fortalecer el core y mejorar la estabilidad del cuerpo.', 'Sala de Aeróbicos'),
	(37, 'GCORE ANIVERSARIO', 'Muscular', 'Sesión especial de GCORE para celebrar el aniversario del gimnasio.', 'Sala de Aeróbicos'),
	(38, 'GCROSS', 'CrossFit', 'Clase de entrenamiento de alta intensidad basada en la metodología CrossFit.', 'Área de CrossFit'),
	(39, 'GCROSS ANIVERSARIO', 'CrossFit', 'Sesión especial de CrossFit para celebrar el aniversario del gimnasio.', 'Área de CrossFit'),
	(40, 'GDANCE', 'Baile', 'Clase de baile para mejorar la coordinación y la resistencia cardiovascular.', 'Sala de Baile'),
	(41, 'GENERGY VIRTUAL', 'Funcional', 'Clase virtual de entrenamiento funcional para mejorar fuerza y resistencia.', 'Sala Virtual'),
	(42, 'GFUNCIONAL', 'Funcional', 'Entrenamiento funcional para mejorar la fuerza, resistencia y flexibilidad.', 'Sala de Entrenamiento Funcional'),
	(43, 'GMIND', 'Bienestar', 'Clase de meditación y relajación para mejorar la salud mental y el bienestar.', 'Sala de Meditación'),
	(44, 'GMIND (GENIUS IN MOVE)', 'Bienestar', 'Sesión avanzada de meditación y técnicas de relajación.', 'Sala de Meditación'),
	(45, 'GMIND ANIVERSARIO', 'Bienestar', 'Clase especial de meditación para celebrar el aniversario del gimnasio.', 'Sala de Meditación'),
	(46, 'GPOWER', 'Muscular', 'Clase de entrenamiento de fuerza para desarrollar la musculatura y la potencia.', 'Sala de Pesas'),
	(47, 'MASTERCLASS GBIKE', 'Ciclismo', 'Clase magistral de ciclismo indoor con un instructor de renombre.', 'Sala de Ciclismo'),
	(48, 'MASTERCLASS GBOX', 'Boxeo', 'Clase magistral de boxeo impartida por un entrenador profesional.', 'Sala de Boxeo'),
	(49, 'MASTERCLASS ZUMBA', 'Baile', 'Clase especial de Zumba con un instructor invitado.', 'Sala de Baile'),
	(50, 'PILATES', 'Bienestar', 'Clase de Pilates para mejorar la flexibilidad y la fuerza del core.', 'Sala de Pilates'),
	(51, 'PILATES ANIVERSARIO', 'Bienestar', 'Sesión especial de Pilates para celebrar el aniversario del gimnasio.', 'Sala de Pilates'),
	(52, 'PILATES VIRTUAL', 'Bienestar', 'Clase virtual de Pilates para mejorar la flexibilidad desde casa.', 'Sala Virtual'),
	(53, 'PRESENTACIÓN GBODY', 'Evento', 'Evento de presentación de la nueva clase GBODY.', 'Sala de Entrenamiento Funcional'),
	(54, 'PRESENTACIÓN GBOX', 'Evento', 'Evento de presentación de la nueva clase GBOX.', 'Sala de Boxeo'),
	(55, 'PRESENTACIÓN GMIND', 'Evento', 'Evento de presentación de la nueva clase GMIND.', 'Sala de Meditación'),
	(56, 'YOGA', 'Bienestar', 'Clase de yoga para mejorar la flexibilidad, la fuerza y la relajación.', 'Sala de Yoga'),
	(57, 'YOGA ANIVERSARIO', 'Bienestar', 'Sesión especial de yoga para celebrar el aniversario del gimnasio.', 'Sala de Yoga'),
	(58, 'YOGA VIRTUAL', 'Bienestar', 'Clase virtual de yoga para practicar desde casa.', 'Sala Virtual'),
	(59, 'ZUMBA', 'Baile', 'Clase de Zumba para mejorar la resistencia cardiovascular y divertirse bailando.', 'Sala de Baile'),
	(60, 'ZUMBA (GENIUS IN MOVE)', 'Baile', 'Clase avanzada de Zumba con coreografías más desafiantes.', 'Sala de Baile'),
	(61, 'ZUMBA ANIVERSARIO', 'Baile', 'Sesión especial de Zumba para celebrar el aniversario del gimnasio.', 'Sala de Baile');

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

-- Volcando datos para la tabla gym.comenta_ejercicio: ~1 rows (aproximadamente)
INSERT INTO `comenta_ejercicio` (`Ejercicio_idEjercicio`, `comentario`, `Usuario_ID`) VALUES
	(7, 'Buen Ejercicio', 5),
	(8, 'Exceso de duración\r\n', 5);

-- Volcando estructura para tabla gym.deportista_hace_actividad
CREATE TABLE IF NOT EXISTS `deportista_hace_actividad` (
  `Actividad_idActividad` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Actividad_idActividad`,`Usuario_DNI`),
  KEY `fk_Actividad_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  KEY `fk_Actividad_has_Usuario_Actividad1_idx` (`Actividad_idActividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.deportista_hace_actividad: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gym.deportista_inscrito
CREATE TABLE IF NOT EXISTS `deportista_inscrito` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Actividad_idActividad`),
  KEY `fk_Usuario_has_Actividad_Actividad1_idx` (`Actividad_idActividad`),
  KEY `fk_Usuario_has_Actividad_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.deportista_inscrito: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gym.deportista_sesion
CREATE TABLE IF NOT EXISTS `deportista_sesion` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Sesion_idSesion` int(11) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  KEY `fk_Usuario_has_Sesion_Sesion1_idx` (`Sesion_idSesion`),
  KEY `fk_Usuario_has_Sesion_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.deportista_sesion: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gym.deportista_tiene_tabla
CREATE TABLE IF NOT EXISTS `deportista_tiene_tabla` (
  `Tabla_idTabla` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Tabla_idTabla`,`Usuario_DNI`),
  KEY `fk_Tabla_has_Usuario_Usuario1_idx` (`Usuario_DNI`),
  KEY `fk_Tabla_has_Usuario_Tabla1_idx` (`Tabla_idTabla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.deportista_tiene_tabla: ~4 rows (aproximadamente)
INSERT INTO `deportista_tiene_tabla` (`Tabla_idTabla`, `Usuario_DNI`) VALUES
	(1, '11111111A'),
	(1, '22222222B'),
	(1, '3'),
	(1, '33333333C'),
	(12312, '11111111A'),
	(12312, '3');

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

-- Volcando datos para la tabla gym.ejercicio: ~5 rows (aproximadamente)
INSERT INTO `ejercicio` (`idEjercicio`, `nombre`, `descripcion`, `tipo`, `tiempo`, `peso`, `repeticiones`, `URLImagen`, `contador`) VALUES
	(7, 'Flexión de brazos', 'Ejercicio de flexión de brazos que fortalece los músculos del brazo y del pecho.', 'Muscular', '0', 0, '10-10-10 ', _binary 0x6272617a6f73312e676966, 0),
	(8, 'Sentadillas', 'Ejercicio de sentadillas para fortalecer las piernas y glúteos.', 'Muscular', '0', 0, '15-15-15 repeticiones', _binary '', 0),
	(9, 'Plancha abdominal', 'Ejercicio de plancha abdominal que fortalece el core y mejora la estabilidad.', 'Muscular', '0', 0, '30 segundos de duración', _binary '', 0),
	(10, 'Correr en el sitio', 'Ejercicio de cardio que simula correr en el lugar durante 180 segundos.', 'Cardio', '180', 0, '', _binary '', 0),
	(11, 'Estiramiento de piernas', 'Ejercicio de estiramiento de piernas para mejorar la flexibilidad y reducir el riesgo de lesiones.', 'Deportiva', '0', 0, '10-10-10 repeticiones', _binary '', 0),
	(92, 'Abdominales', 'Ejercicio de abdominales para fortalecer la zona media del cuerpo.', 'Muscular', '0', 0, '15-15-15 repeticiones', _binary '', 0),
	(93, 'Zancadas', 'Ejercicio de zancadas para trabajar los músculos de las piernas y glúteos.', 'Muscular', '0', 0, '12-12-12 repeticiones', _binary '', 0),
	(94, 'Burpees', 'Ejercicio completo que combina sentadillas, flexiones y saltos para un entrenamiento cardiovascular y muscular.', 'Cardio', '0', 0, '10-10-10 repeticiones', _binary '', 0),
	(95, 'Mountain Climbers', 'Ejercicio que simula escalar una montaña para fortalecer el core y mejorar la resistencia cardiovascular.', 'Cardio', '0', 0, '30 segundos', _binary '', 0),
	(96, 'Peso muerto', 'Ejercicio de levantamiento de peso para fortalecer la parte baja de la espalda y los glúteos.', 'Muscular', '0', 50, '10-10-10 repeticiones', _binary '', 0),
	(97, 'Press de banca', 'Ejercicio de levantamiento de pesas para fortalecer los músculos del pecho, hombros y tríceps.', 'Muscular', '0', 40, '12-12-12 repeticiones', _binary '', 0),
	(98, 'Remo con barra', 'Ejercicio de remo con barra para trabajar la espalda y los bíceps.', 'Muscular', '0', 30, '12-12-12 repeticiones', _binary '', 0),
	(99, 'Elevaciones laterales', 'Ejercicio con mancuernas para fortalecer los hombros.', 'Muscular', '0', 10, '15-15-15 repeticiones', _binary '', 0),
	(100, 'Curl de bíceps', 'Ejercicio con mancuernas para trabajar los bíceps.', 'Muscular', '0', 15, '15-15-15 repeticiones', _binary '', 0),
	(101, 'Patada de tríceps', 'Ejercicio con mancuernas para fortalecer los tríceps.', 'Muscular', '0', 10, '15-15-15 repeticiones', _binary '', 0),
	(102, 'Bicicleta estática', 'Ejercicio de cardio que simula el pedaleo en bicicleta para mejorar la resistencia cardiovascular.', 'Cardio', '300', 0, '', _binary '', 0),
	(103, 'Estiramiento de espalda', 'Ejercicio de estiramiento para mejorar la flexibilidad de la espalda.', 'Deportiva', '0', 0, '10-10-10 repeticiones', _binary '', 0),
	(104, 'Dominadas', 'Ejercicio de dominadas para trabajar la espalda, hombros y bíceps.', 'Muscular', '0', 0, '8-8-8 repeticiones', _binary '', 0),
	(105, 'Levantamiento de pantorrillas', 'Ejercicio para fortalecer los músculos de las pantorrillas.', 'Muscular', '0', 0, '20-20-20 repeticiones', _binary '', 0),
	(106, 'Superman', 'Ejercicio de fortalecimiento de la zona lumbar y glúteos.', 'Muscular', '0', 0, '15-15-15 repeticiones', _binary '', 0),
	(107, 'Puente de glúteos', 'Ejercicio para fortalecer los glúteos y la parte baja de la espalda.', 'Muscular', '0', 0, '20-20-20 repeticiones', _binary '', 0),
	(108, 'Saltos de tijera', 'Ejercicio de cardio que combina saltos y coordinación para mejorar la resistencia cardiovascular.', 'Cardio', '0', 0, '30 segundos', _binary '', 0),
	(109, 'Tijeras abdominales', 'Ejercicio para fortalecer los músculos abdominales inferiores.', 'Muscular', '0', 0, '20-20-20 repeticiones', _binary '', 0),
	(110, 'Elevación de cadera', 'Ejercicio de elevación de cadera para trabajar los músculos de los glúteos y la zona lumbar.', 'Muscular', '0', 0, '15-15-15 repeticiones', _binary '', 0),
	(111, 'Rotaciones de tronco', 'Ejercicio para mejorar la flexibilidad y la fuerza del core.', 'Deportiva', '0', 0, '20-20-20 repeticiones', _binary '', 0);

-- Volcando estructura para tabla gym.faltas_asistencia
CREATE TABLE IF NOT EXISTS `faltas_asistencia` (
  `fecha` date DEFAULT NULL,
  `Sesion_idSesion` int(11) NOT NULL,
  `Usuario_DNI` varchar(9) NOT NULL,
  PRIMARY KEY (`Usuario_DNI`,`Sesion_idSesion`),
  KEY `fk_Faltas_asistencia_Sesion1_idx` (`Sesion_idSesion`),
  KEY `fk_Faltas_asistencia_Usuario1_idx` (`Usuario_DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla gym.faltas_asistencia: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gym.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `Usuario_DNI` varchar(9) NOT NULL,
  `Tabla_IDTabla` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `NEjercicios` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Usuario_DNI`,`Tabla_IDTabla`,`Fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Volcando datos para la tabla gym.historial: ~0 rows (aproximadamente)

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

-- Volcando datos para la tabla gym.sesion: ~5 rows (aproximadamente)
INSERT INTO `sesion` (`idSesion`, `fecha`, `hora`, `nPlazasMax`, `nPlazasActual`, `Usuario_DNI`, `Actividad_idActividad`) VALUES
	(1, '0024-01-10', '15:00:00', 10, 9, '2', 9),
	(2, '2025-03-11', '10:30:00', 10, 10, '2', 10),
	(3, '0000-00-00', '11:11:00', 1, 1, '2', 11),
	(4, '2024-07-14', '12:30:00', 20, 10, '2', 12),
	(5, '2024-06-30', '10:30:00', 30, 30, '11111112A', 14);

-- Volcando estructura para tabla gym.tabla
CREATE TABLE IF NOT EXISTS `tabla` (
  `idTabla` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `instrucciones` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`idTabla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.tabla: ~1 rows (aproximadamente)
INSERT INTO `tabla` (`idTabla`, `nombre`, `tipo`, `instrucciones`) VALUES
	(1, 'Cardio Deportiva', '', 'Realiza los siguientes ejercicios con los datos indicados'),
	(12312, 'Muscular Cardio', 'General', 'Realiza los siguientes ejercicios según lo indicado');

-- Volcando estructura para tabla gym.tabla_tiene_ejercicio
CREATE TABLE IF NOT EXISTS `tabla_tiene_ejercicio` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `Tabla_idTabla` int(11) NOT NULL,
  PRIMARY KEY (`Ejercicio_idEjercicio`,`Tabla_idTabla`),
  KEY `fk_Ejercicio_has_Tabla_Tabla1_idx` (`Tabla_idTabla`),
  KEY `fk_Ejercicio_has_Tabla_Ejercicio1_idx` (`Ejercicio_idEjercicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla gym.tabla_tiene_ejercicio: ~3 rows (aproximadamente)
INSERT INTO `tabla_tiene_ejercicio` (`Ejercicio_idEjercicio`, `Tabla_idTabla`) VALUES
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(11, 12312),
	(92, 12312),
	(93, 12312),
	(94, 12312),
	(95, 12312);

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

-- Volcando datos para la tabla gym.usuario: ~16 rows (aproximadamente)
INSERT INTO `usuario` (`ID`, `DNI`, `nombre`, `apellidos`, `email`, `password`, `tipo`) VALUES
	(4, '2', '2', '2', '2@2.com', '2', 'Entrenador'),
	(5, '3', '3', '3', '3@3.com', '3', 'Deportista'),
	(14, '1', '1', '1', '1@1.com', '1', 'Administrador'),
	(15, '11111111A', 'Usuario1', 'Apellido1', 'usuario1@example.com', '123', 'Deportista'),
	(16, '22222222B', 'Usuario2', 'Apellido2', 'usuario2@example.com', '123', 'Deportista'),
	(17, '33333333C', 'Usuario3', 'Apellido3', 'usuario3@example.com', '123', 'Deportista'),
	(18, '44444444D', 'Usuario4', 'Apellido4', 'usuario4@example.com', '123', 'Deportista'),
	(19, '55555555E', 'Usuario5', 'Apellido5', 'usuario5@example.com', '123', 'Deportista'),
	(20, '66666666F', 'Usuario6', 'Apellido6', 'usuario6@example.com', '123', 'Deportista'),
	(21, '77777777G', 'Usuario7', 'Apellido7', 'usuario7@example.com', '123', 'Deportista'),
	(22, '88888888H', 'Usuario8', 'Apellido8', 'usuario8@example.com', '123', 'Deportista'),
	(23, '99999999I', 'Usuario9', 'Apellido9', 'usuario9@example.com', '123', 'Deportista'),
	(24, '00000000J', 'Usuario10', 'Apellido10', 'usuario10@example.com', '123', 'Deportista'),
	(25, '11111112A', 'Entrenador1', 'Apellido1', 'entrenador1@example.com', '123', 'Entrenador'),
	(26, '22222223B', 'Entrenador2', 'Apellido2', 'entrenador2@example.com', '123', 'Entrenador'),
	(27, '33333334C', 'Entrenador3', 'Apellido3', 'entrenador3@example.com', '123', 'Entrenador');

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

-- Volcando datos para la tabla gym.usuario_entrenadores: ~5 rows (aproximadamente)
INSERT INTO `usuario_entrenadores` (`id`, `id_usuario`, `id_entrenador`) VALUES
	(5, 5, 4),
	(7, 15, 4),
	(8, 16, 4),
	(9, 17, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
