-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.14 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.1.0.5545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sdr
CREATE DATABASE IF NOT EXISTS `sdr` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `sdr`;

-- Volcando estructura para tabla sdr.asesor
CREATE TABLE IF NOT EXISTS `asesor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `noResidentes` int(2) NOT NULL DEFAULT '0',
  `estado` int(2) unsigned NOT NULL DEFAULT '1',
  `setResidentes` int(2) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sdr.asesor: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `asesor` DISABLE KEYS */;
INSERT INTO `asesor` (`id`, `nombre`, `noResidentes`, `estado`, `setResidentes`) VALUES
	(0, 'NA', 0, 0, 0),
	(1, 'M.C. SALVADOR ARIZMENDI LEON ', 0, 1, 0),
	(2, 'M.D.I.S. SILVIA VALLE BAHENA ', 4, 1, 0),
	(3, 'M.D.I.S. LYDIA CUEVAS BRACAMONTES ', 0, 1, 0),
	(4, 'LIC. ARELI BARCENAS NAVA ', 0, 1, 0),
	(5, 'LIC. MARTIN ORTEGA OCAMPO ', 0, 1, 0),
	(6, 'M.C. ENRIQUE MENA SALGADO ', 4, 1, 0),
	(7, 'LIC. MAURICIO FLORES SAAVEDRA ', 0, 1, 0),
	(8, 'M.A. ANGELITA DIONICIO ABRAJAN ', 0, 1, 0),
	(9, 'M.A. ERNESTINA ANGUIANO BELLO ', 0, 1, 0),
	(10, 'M.C. ANASTACIO CARRILLO QUIROZ ', 0, 1, 0),
	(11, 'M.C. TANIA SAENZ RIVERA ', 5, 1, 0),
	(12, 'M.C. MONICA NUÑEZ VELAZQUEZ ', 0, 1, 0),
	(13, 'M.C. ULISES LOPEZ ESTRADA ', 0, 1, 0),
	(14, 'M.C. VICTOR MANUEL JACOBO ADAN ', 0, 1, 0),
	(15, 'M.C.C. ARTURO CARLOS RODRIGUEZ ROMAN ', 0, 1, 0),
	(16, 'I.S.C. MARIA DEL CARMEN URIOSTEGUI PERALTA ', 0, 1, 0),
	(17, 'M.I.S. SINDYA YADIRA CASTILLO ORTIZ ', 0, 1, 0),
	(18, 'I.S.C. EMILIO ROMAN CHAVEZ', 0, 1, 0),
	(19, 'I.S.C. JAVIER TABOADA VAZQUEZ ', 0, 1, 0),
	(20, 'I.S.C. HUGO ERASMO PERDOMO ROLDAN ', 0, 1, 0),
	(21, 'I.S.C. PAULINA XITLALI REYNA CORRAIES ', 0, 1, 0),
	(22, 'M.T.I. JOSE LUIS ZAGAL ARCE ', 0, 1, 0),
	(23, 'LIC. JERONIMO RAMIREZ TERRONES ', 0, 1, 0),
	(24, 'LIC. JUAN CARLOS ALEMAN FRIAS ', 0, 1, 0),
	(25, 'ING. JORGE EDUARDO ORTEGA LOPEZ ', 0, 1, 0),
	(26, 'ING. FRANCISCO JAVIER RAMIREZ SANDOVAL ', 0, 1, 0),
	(27, 'M.E. SERGIO RICARDO ZAGAL BARRERA ', 0, 1, 0),
	(28, 'M.T.I. HEIDI JIMENEZ SILVA ', 0, 1, 0),
	(29, 'M.I.M. ORLANDO HERNANDEZ PEREZ ', 0, 1, 0),
	(30, 'LIC. FRANCISCO HAM SALGADO ', 0, 1, 0),
	(32, 'aaaaa', 0, 1, 14);
/*!40000 ALTER TABLE `asesor` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.directorio
CREATE TABLE IF NOT EXISTS `directorio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noExt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `depto` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.directorio: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `directorio` DISABLE KEYS */;
INSERT INTO `directorio` (`id`, `noExt`, `depto`, `responsable`) VALUES
	(1, '221', 'CONMUTADOR', 'C.CRISTINA BUENO ROMÁN'),
	(2, '222', 'DIRECCION', 'M.D.I.S. ARELI BÁRCENAS NAVA'),
	(3, '229', 'SECRETARIA SUBDIRECCION ADMINISTRATIVA', NULL),
	(4, '223', 'SUBDIRECCION ACADEMICA', 'M.E. SERGIO RICARDO ZAGAL BARRERA'),
	(5, '225', 'DEPARTAMENTO DE SISTEMAS Y COMPUTACION', 'ING. JORGE ORTEGA ORTEGA LOPEZ'),
	(6, '226', 'DEPARTAMENTO DE CIENCIAS BASICAS', 'M.C. FERNANDO SALCEDO LEONARDO'),
	(7, '233', 'DEPARTAMENTO DE DESARROLLO ACADEMICO', 'M.A. ELISA TRUJILLO BELTRAN'),
	(8, '234', 'DEPARTAMENTO DE CIENCIAS ECONOMICO ADMINISTRATIVAS', 'C.P. CRISTINA MARQUEZ SALGADO'),
	(9, '241', 'DEPARTAMENTO DE INGENIERIA INDUSTRIAL', 'DR. JUAN CARLOS KIDO MIRANDA'),
	(10, '247', 'DIVICION DE ESTUDIOS PROFECIONALES', 'M.A. JUANA MIRNA VALLE MORALES'),
	(11, '224', 'SUBDIRECCION DE PLANEACION Y VINCULACION', 'I.S.C. JAVIER TABOADA VAZQUEZ'),
	(12, '227', 'DEPARTAMENTO DE PLANEACION, PROGRAMACION Y PRESUPUESTACION', 'M.C. FRANCISCO JUAREZ HERRERA'),
	(13, '228', 'COMITE CALIDAD', 'M.C. FRANCISCO JUAREZ HERRERA'),
	(14, '235', 'DEPARTAMENTO DE GESTION TECNOLOGICA Y VINCULACION', 'C.P. YOLOXOCHILT SILVIA CRUZ'),
	(15, '240', 'DEPARTAMENTO DE GESTION TECNOLOGICA Y VINCULACION', 'M.I.S. SINDIA YADIRA CASTILLO ORTIZ'),
	(16, '237', 'DEPARTAMENTO DE ACTIVIDADES EXTRAESCOLARES', 'M.C.MARGARITA BARRERA HERNANDEZ'),
	(17, '243', 'CENTRO DE INFORMACION', 'M.C. AGUSTIN ACEVEDO FIGUEROA'),
	(18, '245', 'CIIE ITI', 'L.C. CARLOS ALBERTO DIAZ LARA'),
	(19, '246', 'DEPARTAMENTO DE SERVICIOS ESCOLARES', 'ING. LEO SOTO TABOADA'),
	(20, '230', 'SUBDIRECCION DE SERVICIOS ADMINISTRATIVOS', 'C.P. ANDREA ARZATE SALGADO'),
	(21, '231', 'DEPARTAMENTO DE RECURSOS HUMANOS', 'I.S.C. HUGO ERASMO PERDOMO ROLDAN'),
	(22, '232', 'DEPARTAMENTO DE RECURSOS FINANCIEROS', 'C.P.MA. GUADALUPE GALENA BRITO'),
	(23, '252', 'DEPARTAMENTO DE RECURSOS FINANCIEROS (CONTABILIDAD Y VIATICOS)', 'C.BELEM CARREON ROBLES'),
	(24, '236', 'DEPARTAMENTO DE RECURSOS MATERIALES', 'LIC. JUAN CARLOS ALEMAN FRIAS'),
	(25, '239', 'DEPARTAMENTO DE RECURSOS MATERIALES(COMPRAS)', 'C.GUADALUPE CRUZ ROJO'),
	(26, '242', 'CENTRO DE COMPUTO', NULL),
	(27, '244', 'DEPARTAMENTO DE DE COMUNICACION Y DIFUSION', 'LIC. MAURICIO FLORES SAAVEDRA'),
	(28, '248', 'DEPARTAMENTO DE MANTENIMIENTO DE EQUIPO', 'ING. LORENZO HURTADO SALGADO'),
	(29, '238', 'SINDICATO', 'C.P. JUAN ESTRADA AGUILAR'),
	(30, '249', 'CASETA DE VIGILANCIA ENTRADA PRINCIPAL', NULL),
	(31, '250', 'CASETA DE VIGILANCIA CARR. IGUALA-TAXCO', NULL);
/*!40000 ALTER TABLE `directorio` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.jerarquia
CREATE TABLE IF NOT EXISTS `jerarquia` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.jerarquia: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `jerarquia` DISABLE KEYS */;
INSERT INTO `jerarquia` (`id`, `nombre`, `cargo`, `estado`) VALUES
	(0, 'NA', 'NA', 0),
	(1, 'M.C. SALVADOR ARIZMENDI LEON ', 'Hola', 1),
	(2, 'M.D.I.S. SILVIA VALLE BAHENA ', 'Hola', 1),
	(3, 'M.D.I.S. LYDIA CUEVAS BRACAMONTES ', 'PRESIDENTE DE ACADEMIA', 1),
	(4, 'LIC. ARELI BARCENAS NAVA ', 'Hola', 1),
	(5, 'LIC. MARTIN ORTEGA OCAMPO ', 'Hola', 1),
	(6, 'M.C. ENRIQUE MENA SALGADO ', 'Hola', 1),
	(7, 'LIC. MAURICIO FLORES SAAVEDRA ', 'Hola', 1),
	(8, 'M.A. ANGELITA DIONICIO ABRAJAN ', 'Hola', 1),
	(9, 'M.A. ERNESTINA ANGUIANO BELLO ', 'Hola', 1),
	(10, 'M.C. ANASTACIO CARRILLO QUIROZ ', 'Hola', 1),
	(11, 'M.C. TANIA SAENZ RIVERA ', 'Hola', 1),
	(12, 'M.C. MONICA NUÑEZ VELAZQUEZ ', 'Hola', 1),
	(13, 'M.C. ULISES LOPEZ ESTRADA ', 'Hola', 1),
	(14, 'M.C. VICTOR MANUEL JACOBO ADAN ', 'Hola', 1),
	(15, 'M.C.C. ARTURO CARLOS RODRIGUEZ ROMAN ', 'Hola', 1),
	(16, 'I.S.C. MARIA DEL CARMEN URIOSTEGUI PERALTA ', 'Hola', 1),
	(17, 'M.I.S. SINDYA YADIRA CASTILLO ORTIZ ', 'Hola', 1),
	(18, 'I.S.C. EMILIO ROMAN CHAVEZ ', 'Hola', 1),
	(19, 'I.S.C. JAVIER TABOADA VAZQUEZ ', 'Hola', 1),
	(20, 'I.S.C. HUGO ERASMO PERDOMO ROLDAN ', 'Hola', 1),
	(21, 'I.S.C. PAULINA XITLALI REYNA CORRAIES ', 'Hola', 1),
	(22, 'M.T.I. JOSE LUIS ZAGAL ARCE ', 'Hola', 1),
	(23, 'LIC. JERONIMO RAMIREZ TERRONES ', 'Hola', 1),
	(24, 'LIC. JUAN CARLOS ALEMAN FRIAS ', 'Hola', 1),
	(25, 'ING. JORGE EDUARDO ORTEGA LOPEZ ', 'JEFE DEL DEPTO. ACADEMICO', 1),
	(26, 'ING. FRANCISCO JAVIER RAMIREZ SANDOVAL ', 'Hola', 1),
	(27, 'M.E. SERGIO RICARDO ZAGAL BARRERA ', 'SUBDIRECTOR ACADÉMICO', 1),
	(28, 'M.T.I. HEIDI JIMENEZ SILVA ', 'Hola', 1),
	(29, 'M.I.M. ORLANDO HERNANDEZ PEREZ ', 'Hola', 1),
	(30, 'LIC. FRANCISCO HAM SALGADO ', 'Hola', 1),
	(33, 'ING. JORGE EDUARDO ORTEGA LOPEZ ', 'JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN', 1),
	(34, 'M.A. JUANA MIRNA VALLE MORALES', 'JEFA DE LA DIVISION DE ESTUDIOS PROFESIONALES PRESENTE', 1);
/*!40000 ALTER TABLE `jerarquia` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.proyecto
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreProyecto` varchar(200) NOT NULL,
  `nombreEmpresa` varchar(200) NOT NULL,
  `asesorExt` varchar(100) DEFAULT NULL,
  `asesorInt` int(10) unsigned NOT NULL,
  `revisor1` int(10) unsigned DEFAULT NULL,
  `revisor2` int(10) unsigned DEFAULT NULL,
  `revisor3` int(10) unsigned DEFAULT '0',
  `suplente` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombreProyecto_UNIQUE` (`nombreProyecto`),
  KEY `fk_proyecto_asesor1_idx` (`asesorInt`),
  KEY `fk_proyecto_asesor2_idx` (`revisor1`),
  KEY `fk_proyecto_asesor3_idx` (`revisor2`),
  KEY `fk_proyecto_asesor4_idx` (`suplente`),
  KEY `fk_proyecto_asesor5_idx` (`revisor3`),
  CONSTRAINT `fk_proyecto_asesor1` FOREIGN KEY (`asesorInt`) REFERENCES `asesor` (`id`),
  CONSTRAINT `fk_proyecto_asesor2` FOREIGN KEY (`revisor1`) REFERENCES `asesor` (`id`),
  CONSTRAINT `fk_proyecto_asesor3` FOREIGN KEY (`revisor2`) REFERENCES `asesor` (`id`),
  CONSTRAINT `fk_proyecto_asesor4` FOREIGN KEY (`suplente`) REFERENCES `asesor` (`id`),
  CONSTRAINT `fk_proyecto_asesor5` FOREIGN KEY (`revisor3`) REFERENCES `asesor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sdr.proyecto: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` (`id`, `nombreProyecto`, `nombreEmpresa`, `asesorExt`, `asesorInt`, `revisor1`, `revisor2`, `revisor3`, `suplente`) VALUES
	(44, 'Proyecto prueba', 'Empresa Fantasma', 'Orlando Flores Matinez', 16, 15, 24, 0, 19),
	(45, 'Aplicaciones android', 'Desarrollo APKs MX', '', 22, 13, 18, 14, 4),
	(46, 'Desarrollo web', 'Developer_xD', 'Mario Perez Sanchez', 8, 10, 11, 0, 14),
	(47, ' DETERMINACION DE LOS DISPOSITIVOS DE RED QUE PERMITAN PROPORCIONAR SERVICIO DE INTERNET EN EL INSTITUTO TECNOLOGICO DE IGUALA', 'EmpreMX', '', 14, 7, 16, 27, 17),
	(48, 'Prueba xd', 'Name xd', 'name apellido1 apellido2', 19, 26, 5, 0, 18),
	(49, 'como cambiar de sexo', 'sexForce', '', 11, 10, 20, 9, 27),
	(50, 'Practicas Androidx', 'androidMXx', 'Juan Fuentes Perezx', 30, 29, 29, 0, 27),
	(51, 'DETERMINACION DE LOS DISPOSITIVOS DE RED QUE PERMITAN PROPORCIONAR SERVICIO DE INTERNET EN EL INSTITUTO TECNOLOGICO DE IGUALA DIJDHBIWEBCIWEBCIBEWINBEWJIONDOWENONCEWJOB', 'abeurp MX', '', 19, 13, 20, 18, 13),
	(52, 'gggg', 'empresa', '', 3, 16, 17, 19, 18),
	(53, 'hola jeje', 'empresaw', 'nose jeje', 15, 13, 12, 0, 10),
	(54, 'hbuvbihvihv', 'uyvbihbcidbicw', 'hhh', 15, 26, 15, 0, 13),
	(55, 'crack', 'olemx', 'nosw jeje', 23, 2, 6, 0, 15),
	(56, 'HBIVBWIVBIWVW', 'IHBIBVIWJBVI', 'IUGWEIFG9WEG', 2, 13, 10, 0, 13),
	(57, 'KHVJGVKHVWKHV', 'IHBIHFIBIHB', 'HBIBIBBIBK', 2, 8, 9, 0, 12),
	(58, 'dddddddddddddddddddddddddddddd', 'eeeeeeeeeeeeeeeeeee', 'dvssdvvsdvd', 20, 12, 15, 0, 18),
	(59, 'AAAAAAAAAAAAA', 'eacacaecaefaefaefae', '0', 1, 22, 21, 12, 13),
	(60, 'AR', 'armx', 'afaefaeae auhbhwb kbhkhbkj', 1, 18, 21, 0, 13),
	(61, 'Yonathan ar', 'ar ceacec', '0', 1, 18, 10, 10, 7);
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.residentes
CREATE TABLE IF NOT EXISTS `residentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noControl` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoP` varchar(50) NOT NULL,
  `apellidoM` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `periodo` varchar(45) NOT NULL,
  `anio` varchar(45) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `revisionOk` int(1) unsigned NOT NULL DEFAULT '0',
  `tipo_registro` int(11) NOT NULL,
  `proyecto_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_residentes_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_residentes_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sdr.residentes: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `residentes` DISABLE KEYS */;
INSERT INTO `residentes` (`id`, `noControl`, `nombre`, `apellidoP`, `apellidoM`, `carrera`, `periodo`, `anio`, `sexo`, `telefono`, `revisionOk`, `tipo_registro`, `proyecto_id`) VALUES
	(1, '15670052', 'Juan Manuel', 'Vazquez', 'Juarez', 'Ingenieria en Sistemas Computacionales', 'EJ', '2018', 'M', '7331045454', 3, 1, 44),
	(2, '15672543', 'Maria', 'Perez', 'Castro', 'Ingenieria Informatica', 'AD', '2019', 'F', '7331458585', 1, 2, 45),
	(3, '15672459', 'Bob', 'Karles', 'Godin', 'Ingenieria en Sistemas Computacionales', 'AD', '2018', 'M', '7332548969', 2, 1, 46),
	(4, '15672548', 'Maribel', 'Gomez', 'Reyes', 'Ingenieria en Sistemas Computacionales', 'EJ', '2019', 'F', '7331472525', 3, 2, 47),
	(5, '15670054', 'Asael', 'amador', 'arellano', 'Ingenieria Informatica', 'EJ', '2019', 'F', '7331234596', 1, 2, 49),
	(6, '111111', 'Pedro Juan x', 'Lopezx', 'Martinezx', 'Ingenieria Informatica', 'AD', '2018', 'F', '7335552233', 1, 1, 50),
	(7, '15670012', 'Berto', 'Salgado', 'Martinez', 'Ingenieria en Sistemas Computacionales', 'EJ', '2018', 'M', '7331021214', 0, 2, 51),
	(8, '15670014', 'hola mundo', 'jejeje', 'kkkkk', 'Ingenieria en Sistemas Computacionales', 'AD', '2018', 'F', '7331021578', 0, 2, 52),
	(9, '15674859', 'abcd', 'adce', 'vea', 'Ingenieria en Sistemas Computacionales', 'EJ', '2018', 'M', '7635869456', 1, 1, 53),
	(10, '15672525', 'dbvibi', 'hbidbvihbd', 'vdbviwjbvi', 'Ingenieria en Sistemas Computacionales', 'EJ', '2019', 'M', '7584584512', 1, 1, 54),
	(11, '454545', 'yona', 'roman', 'yojejej', 'Ingenieria en Sistemas Computacionales', 'EJ', '2019', 'M', '7331089089', 0, 1, 55),
	(13, '61464', 'Yonathan', 'Román', 'GWRKHBI', 'Ingenieria Informatica', 'AD', '2018', 'M', '16516516454', 0, 1, 57),
	(14, '34235543', 'vervregrggcerg', 'ergerhcewc', 'crthrxtc', 'Ingenieria Informatica', 'AD', '2019', 'M', '1231212123', 2, 1, 58),
	(15, '1524368', 'Yonathan', 'Román', 'Salgado', 'Ingenieria en Sistemas Computacionales', 'EJ', '2019', 'M', '7331021215', 0, 2, 59),
	(16, '15670052', 'Yonathan', 'Román', 'aaecaeca', 'Ingenieria en Sistemas Computacionales', 'AD', '2019', 'M', '7331089089', 0, 1, 60),
	(17, '15670056', 'Yonathan', 'Román', 'ascavada', 'Ingenieria en Sistemas Computacionales', 'EJ', '2019', 'M', '7331089089', 0, 2, 61);
/*!40000 ALTER TABLE `residentes` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `usuario` varchar(60) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `password` mediumtext CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `perfil` mediumtext CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `estado` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf32;

-- Volcando datos para la tabla sdr.usuarios: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `estado`) VALUES
	(3, 'AdminNameTest', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 1),
	(5, 'Yonathan Roman Salgado', 'yonathan', '$2a$07$asxx54ahjppf45sd87a5auyn6ZLvJGKf2k4POBdF2YWrS7z6CB99u', 'Administrador', 1),
	(7, 'Pablo Escobar Gaviria', 'Pablo', 'escobar', 'Administrador', 0),
	(63, 'Carlos Diaz Sandoval', 'carlos', '$2a$07$asxx54ahjppf45sd87a5auXaW5n/KLY/bEvEkjrWiw6hTlwjyTGja', 'Administrador', 1),
	(64, 'Ignacio Tetitlan Palatzin', 'ignacio', '$2a$07$asxx54ahjppf45sd87a5auBWx326D7BJ0/jK6SvVDKi3nXG9O3oGe', 'Administrador', 1),
	(65, 'Prueba Usuario Normal', 'user', '$2a$07$asxx54ahjppf45sd87a5augtYQ5l0YJxtJ.sls/VjJvJD4Oq/Jqk2', 'Usuario', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
