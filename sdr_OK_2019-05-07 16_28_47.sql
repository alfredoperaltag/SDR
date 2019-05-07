-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.14 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.1.0.5552
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

-- Volcando datos para la tabla sdr.asesor: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `asesor` DISABLE KEYS */;
INSERT INTO `asesor` (`id`, `nombre`, `noResidentes`, `estado`, `setResidentes`) VALUES
	(0, 'NA', 0, 0, 0),
	(1, 'M.C. SALVADOR ARIZMENDI LEON ', 0, 1, 0),
	(2, 'M.D.I.S. SILVIA VALLE BAHENA ', 0, 1, 0),
	(3, 'M.D.I.S. LYDIA CUEVAS BRACAMONTES ', 0, 1, 0),
	(4, 'LIC. ARELI BARCENAS NAVA ', 0, 1, 0),
	(5, 'LIC. MARTIN ORTEGA OCAMPO ', 0, 1, 0),
	(6, 'M.C. ENRIQUE MENA SALGADO ', 0, 1, 0),
	(7, 'LIC. MAURICIO FLORES SAAVEDRA ', 0, 1, 0),
	(8, 'M.A. ANGELITA DIONICIO ABRAJAN ', 0, 1, 0),
	(9, 'M.A. ERNESTINA ANGUIANO BELLO ', 0, 1, 0),
	(10, 'M.C. ANASTACIO CARRILLO QUIROZ ', 0, 1, 0),
	(11, 'M.C. TANIA SAENZ RIVERA ', 0, 1, 0),
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
	(30, 'LIC. FRANCISCO HAM SALGADO ', 0, 1, 0);
/*!40000 ALTER TABLE `asesor` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'off',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.config: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`id`, `nombre`, `valor`) VALUES
	(1, 'configPreRegistro', 'on');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.directorio
CREATE TABLE IF NOT EXISTS `directorio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noExt` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `depto` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.directorio: ~31 rows (aproximadamente)
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
  `cargo` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(1) unsigned DEFAULT '1',
  `sexo` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.jerarquia: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `jerarquia` DISABLE KEYS */;
INSERT INTO `jerarquia` (`id`, `nombre`, `cargo`, `estado`, `sexo`) VALUES
	(0, 'NA', 'NA', 0, '0'),
	(1, 'M.D.I.S. SILVIA VALLE BAHENA', 'PRESIDENTE DE ACADEMIA', 1, 'F'),
	(2, 'ING. JORGE EDUARDO ORTEGA LOPEZ', 'JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN', 1, 'M'),
	(3, 'M.E. SERGIO RICARDO ZAGAL BARRERA ', 'SUBDIRECTOR ACADÉMICO', 1, 'M'),
	(4, 'ING. JORGE EDUARDO ORTEGA LOPEZ', 'JEFE DEL DEPTO. ACADEMICO', 1, 'M'),
	(5, 'M.A. JUANA MIRNA VALLE MORALES', 'JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES', 1, 'F');
/*!40000 ALTER TABLE `jerarquia` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.preregistros
CREATE TABLE IF NOT EXISTS `preregistros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noControl` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carrera` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellidoP` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellidoM` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `asesorPre` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `noControl` (`noControl`),
  KEY `asesor` (`asesorPre`),
  CONSTRAINT `FK_preregistros_asesor` FOREIGN KEY (`asesorPre`) REFERENCES `asesor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.preregistros: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `preregistros` DISABLE KEYS */;
/*!40000 ALTER TABLE `preregistros` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.proyecto
CREATE TABLE IF NOT EXISTS `proyecto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreProyecto` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombreEmpresa` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `asesorExt` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `asesorInt` int(10) unsigned NOT NULL,
  `revisor1` int(10) unsigned DEFAULT NULL,
  `revisor2` int(10) unsigned DEFAULT NULL,
  `revisor3` int(10) unsigned DEFAULT '0',
  `suplente` int(10) unsigned DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.proyecto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.residentes
CREATE TABLE IF NOT EXISTS `residentes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noControl` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellidoP` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apellidoM` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `carrera` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `periodo` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `anio` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `telefono` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `revisionOk` int(1) unsigned NOT NULL DEFAULT '0',
  `tipo_registro` int(11) NOT NULL,
  `proyecto_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_residentes_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_residentes_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sdr.residentes: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `residentes` DISABLE KEYS */;
/*!40000 ALTER TABLE `residentes` ENABLE KEYS */;

-- Volcando estructura para tabla sdr.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perfil` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- Volcando datos para la tabla sdr.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `estado`) VALUES
	(1, 'AdminNameTest', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
