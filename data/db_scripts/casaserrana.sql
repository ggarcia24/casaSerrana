/*
SQLyog Community v12.02 (64 bit)
MySQL - 5.6.17 : Database - casaserrana
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`casaserrana` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `casaserrana`;

/*Table structure for table `alimentoespeciales` */

DROP TABLE IF EXISTS `alimentoespeciales`;

CREATE TABLE `alimentoespeciales` (
  `idAlimentoEspecial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idAlimentoEspecial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `alimentoespeciales` */

/*Table structure for table `alimentos` */

DROP TABLE IF EXISTS `alimentos`;

CREATE TABLE `alimentos` (
  `idAlimento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idAlimento`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `alimentos` */

insert  into `alimentos`(`idAlimento`,`nombre`,`descripcion`) values (1,'Celiacos','Alimentos que no deben llevar harina.'),(2,'Vegetariano','No comen carne.'),(4,'N/A','Sin alimentos especiales');

/*Table structure for table `bancos` */

DROP TABLE IF EXISTS `bancos`;

CREATE TABLE `bancos` (
  `idBanco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idBanco`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `bancos` */

insert  into `bancos`(`idBanco`,`nombre`) values (4,'Banco Nacion'),(2,'Frances'),(1,'Galicia'),(5,'Santander Rio');

/*Table structure for table `categoriahabitaciones` */

DROP TABLE IF EXISTS `categoriahabitaciones`;

CREATE TABLE `categoriahabitaciones` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `categoriahabitaciones` */

insert  into `categoriahabitaciones`(`idCategoria`,`nombre`) values (1,'Casa'),(2,'Chalet'),(3,'ads');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `idCliente` int(10) NOT NULL AUTO_INCREMENT,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci,
  `telefono` text COLLATE utf8_spanish_ci,
  `tipoDocumento` text COLLATE utf8_spanish_ci,
  `documento` int(15) NOT NULL,
  `idBancoPorCliente` int(10) DEFAULT NULL,
  `titular` tinyint(1) DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci,
  `idAlimentoEspecial` int(10) DEFAULT NULL,
  `codigoPostal` int(6) DEFAULT NULL,
  `idTarjetaPorCliente` int(10) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `idTipoHuesped` int(10) DEFAULT NULL,
  `idProvincia` int(11) DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `localidad` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `documento` (`documento`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`idCliente`,`apellido`,`nombre`,`direccion`,`telefono`,`tipoDocumento`,`documento`,`idBancoPorCliente`,`titular`,`email`,`idAlimentoEspecial`,`codigoPostal`,`idTarjetaPorCliente`,`fechaNacimiento`,`idTipoHuesped`,`idProvincia`,`idPais`,`localidad`) values (20,'Legrand','Mirtha','San Martin 3123','323321313','DNI',33034456,NULL,1,'mirta@gmail.com',2,2313,NULL,'1955-02-17',3,1,13,'dsda'),(54,'Saa','Alberto',NULL,'31233123','DNI',12142414,NULL,NULL,'ssseaaa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `idEstado` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estados` */

insert  into `estados`(`idEstado`,`nombre`) values (1,'Disponible'),(2,'Reservada'),(3,'Reservada c/ seña'),(4,'Ocupada'),(5,'No disponible');

/*Table structure for table `habitaciones` */

DROP TABLE IF EXISTS `habitaciones`;

CREATE TABLE `habitaciones` (
  `idHabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `idPabellon` int(11) DEFAULT NULL,
  `plazaMaxima` int(3) NOT NULL,
  `idCategoria` int(10) DEFAULT NULL,
  `idEstado` int(10) DEFAULT NULL,
  PRIMARY KEY (`idHabitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `habitaciones` */

insert  into `habitaciones`(`idHabitacion`,`numero`,`idPabellon`,`plazaMaxima`,`idCategoria`,`idEstado`) values (1,1,1,0,0,0),(6,100,2,0,1,2),(7,101,1,3,1,1),(9,401,6,0,2,2),(10,301,3,0,1,2),(11,300,3,231,1,1),(13,564,12,23,3,3),(14,231,16,31,3,2),(15,2134141,11,31,1,4),(17,200,2,32,2,3),(18,321,3,312,2,1),(20,410,6,141,2,4),(22,402,6,141,2,4),(23,410,8,31232132,2,5),(25,309,3,345,2,4),(26,403,6,13,3,3),(27,23,10,132,2,4),(28,501,11,132,2,4),(29,312,8,41,2,1),(30,312,8,41,2,1),(31,32,3,1,2,2),(32,3,11,41,2,2);

/*Table structure for table `pabellones` */

DROP TABLE IF EXISTS `pabellones`;

CREATE TABLE `pabellones` (
  `idPabellon` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idPabellon`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `pabellones` */

insert  into `pabellones`(`idPabellon`,`nombre`) values (1,'Central'),(2,'Sarmiento'),(3,'Californiano'),(8,'San Martin'),(11,'Anexo Ctral.'),(12,'Tala'),(13,'Yapeyu'),(14,'Piquillin'),(15,'Pilmaiquen'),(16,'Dominador'),(17,'Chalet Vip (5)'),(18,'Monsanto');

/*Table structure for table `paises` */

DROP TABLE IF EXISTS `paises`;

CREATE TABLE `paises` (
  `idPais` int(10) NOT NULL AUTO_INCREMENT,
  `iso` char(2) DEFAULT NULL,
  `nombre` tinytext,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

/*Data for the table `paises` */

insert  into `paises`(`idPais`,`iso`,`nombre`) values (1,'AF','Afganistán'),(2,'AX','Islas Gland'),(3,'AL','Albania'),(4,'DE','Alemania'),(5,'AD','Andorra'),(6,'AO','Angola'),(7,'AI','Anguilla'),(8,'AQ','Antártida'),(9,'AG','Antigua y Barbuda'),(10,'AN','Antillas Holandesas'),(11,'SA','Arabia Saudí'),(12,'DZ','Argelia'),(13,'AR','Argentina'),(14,'AM','Armenia'),(15,'AW','Aruba'),(16,'AU','Australia'),(17,'AT','Austria'),(18,'AZ','Azerbaiyán'),(19,'BS','Bahamas'),(20,'BH','Bahréin'),(21,'BD','Bangladesh'),(22,'BB','Barbados'),(23,'BY','Bielorrusia'),(24,'BE','Bélgica'),(25,'BZ','Belice'),(26,'BJ','Benin'),(27,'BM','Bermudas'),(28,'BT','Bhután'),(29,'BO','Bolivia'),(30,'BA','Bosnia y Herzegovina'),(31,'BW','Botsuana'),(32,'BV','Isla Bouvet'),(33,'BR','Brasil'),(34,'BN','Brunéi'),(35,'BG','Bulgaria'),(36,'BF','Burkina Faso'),(37,'BI','Burundi'),(38,'CV','Cabo Verde'),(39,'KY','Islas Caimán'),(40,'KH','Camboya'),(41,'CM','Camerún'),(42,'CA','Canadá'),(43,'CF','República Centroafricana'),(44,'TD','Chad'),(45,'CZ','República Checa'),(46,'CL','Chile'),(47,'CN','China'),(48,'CY','Chipre'),(49,'CX','Isla de Navidad'),(50,'VA','Ciudad del Vaticano'),(51,'CC','Islas Cocos'),(52,'CO','Colombia'),(53,'KM','Comoras'),(54,'CD','República Democrática del Congo'),(55,'CG','Congo'),(56,'CK','Islas Cook'),(57,'KP','Corea del Norte'),(58,'KR','Corea del Sur'),(59,'CI','Costa de Marfil'),(60,'CR','Costa Rica'),(61,'HR','Croacia'),(62,'CU','Cuba'),(63,'DK','Dinamarca'),(64,'DM','Dominica'),(65,'DO','República Dominicana'),(66,'EC','Ecuador'),(67,'EG','Egipto'),(68,'SV','El Salvador'),(69,'AE','Emiratos Árabes Unidos'),(70,'ER','Eritrea'),(71,'SK','Eslovaquia'),(72,'SI','Eslovenia'),(73,'ES','España'),(74,'UM','Islas ultramarinas de Estados Unidos'),(75,'US','Estados Unidos'),(76,'EE','Estonia'),(77,'ET','Etiopía'),(78,'FO','Islas Feroe'),(79,'PH','Filipinas'),(80,'FI','Finlandia'),(81,'FJ','Fiyi'),(82,'FR','Francia'),(83,'GA','Gabón'),(84,'GM','Gambia'),(85,'GE','Georgia'),(86,'GS','Islas Georgias del Sur y Sandwich del Sur'),(87,'GH','Ghana'),(88,'GI','Gibraltar'),(89,'GD','Granada'),(90,'GR','Grecia'),(91,'GL','Groenlandia'),(92,'GP','Guadalupe'),(93,'GU','Guam'),(94,'GT','Guatemala'),(95,'GF','Guayana Francesa'),(96,'GN','Guinea'),(97,'GQ','Guinea Ecuatorial'),(98,'GW','Guinea-Bissau'),(99,'GY','Guyana'),(100,'HT','Haití'),(101,'HM','Islas Heard y McDonald'),(102,'HN','Honduras'),(103,'HK','Hong Kong'),(104,'HU','Hungría'),(105,'IN','India'),(106,'ID','Indonesia'),(107,'IR','Irán'),(108,'IQ','Iraq'),(109,'IE','Irlanda'),(110,'IS','Islandia'),(111,'IL','Israel'),(112,'IT','Italia'),(113,'JM','Jamaica'),(114,'JP','Japón'),(115,'JO','Jordania'),(116,'KZ','Kazajstán'),(117,'KE','Kenia'),(118,'KG','Kirguistán'),(119,'KI','Kiribati'),(120,'KW','Kuwait'),(121,'LA','Laos'),(122,'LS','Lesotho'),(123,'LV','Letonia'),(124,'LB','Líbano'),(125,'LR','Liberia'),(126,'LY','Libia'),(127,'LI','Liechtenstein'),(128,'LT','Lituania'),(129,'LU','Luxemburgo'),(130,'MO','Macao'),(131,'MK','ARY Macedonia'),(132,'MG','Madagascar'),(133,'MY','Malasia'),(134,'MW','Malawi'),(135,'MV','Maldivas'),(136,'ML','Malí'),(137,'MT','Malta'),(138,'FK','Islas Malvinas'),(139,'MP','Islas Marianas del Norte'),(140,'MA','Marruecos'),(141,'MH','Islas Marshall'),(142,'MQ','Martinica'),(143,'MU','Mauricio'),(144,'MR','Mauritania'),(145,'YT','Mayotte'),(146,'MX','México'),(147,'FM','Micronesia'),(148,'MD','Moldavia'),(149,'MC','Mónaco'),(150,'MN','Mongolia'),(151,'MS','Montserrat'),(152,'MZ','Mozambique'),(153,'MM','Myanmar'),(154,'NA','Namibia'),(155,'NR','Nauru'),(156,'NP','Nepal'),(157,'NI','Nicaragua'),(158,'NE','Níger'),(159,'NG','Nigeria'),(160,'NU','Niue'),(161,'NF','Isla Norfolk'),(162,'NO','Noruega'),(163,'NC','Nueva Caledonia'),(164,'NZ','Nueva Zelanda'),(165,'OM','Omán'),(166,'NL','Países Bajos'),(167,'PK','Pakistán'),(168,'PW','Palau'),(169,'PS','Palestina'),(170,'PA','Panamá'),(171,'PG','Papúa Nueva Guinea'),(172,'PY','Paraguay'),(173,'PE','Perú'),(174,'PN','Islas Pitcairn'),(175,'PF','Polinesia Francesa'),(176,'PL','Polonia'),(177,'PT','Portugal'),(178,'PR','Puerto Rico'),(179,'QA','Qatar'),(180,'GB','Reino Unido'),(181,'RE','Reunión'),(182,'RW','Ruanda'),(183,'RO','Rumania'),(184,'RU','Rusia'),(185,'EH','Sahara Occidental'),(186,'SB','Islas Salomón'),(187,'WS','Samoa'),(188,'AS','Samoa Americana'),(189,'KN','San Cristóbal y Nevis'),(190,'SM','San Marino'),(191,'PM','San Pedro y Miquelón'),(192,'VC','San Vicente y las Granadinas'),(193,'SH','Santa Helena'),(194,'LC','Santa Lucía'),(195,'ST','Santo Tomé y Príncipe'),(196,'SN','Senegal'),(197,'CS','Serbia y Montenegro'),(198,'SC','Seychelles'),(199,'SL','Sierra Leona'),(200,'SG','Singapur'),(201,'SY','Siria'),(202,'SO','Somalia'),(203,'LK','Sri Lanka'),(204,'SZ','Suazilandia'),(205,'ZA','Sudáfrica'),(206,'SD','Sudán'),(207,'SE','Suecia'),(208,'CH','Suiza'),(209,'SR','Surinam'),(210,'SJ','Svalbard y Jan Mayen'),(211,'TH','Tailandia'),(212,'TW','Taiwán'),(213,'TZ','Tanzania'),(214,'TJ','Tayikistán'),(215,'IO','Territorio Británico del Océano Índico'),(216,'TF','Territorios Australes Franceses'),(217,'TL','Timor Oriental'),(218,'TG','Togo'),(219,'TK','Tokelau'),(220,'TO','Tonga'),(221,'TT','Trinidad y Tobago'),(222,'TN','Túnez'),(223,'TC','Islas Turcas y Caicos'),(224,'TM','Turkmenistán'),(225,'TR','Turquía'),(226,'TV','Tuvalu'),(227,'UA','Ucrania'),(228,'UG','Uganda'),(229,'UY','Uruguay'),(230,'UZ','Uzbekistán'),(231,'VU','Vanuatu'),(232,'VE','Venezuela'),(233,'VN','Vietnam'),(234,'VG','Islas Vírgenes Británicas'),(235,'VI','Islas Vírgenes de los Estados Unidos'),(236,'WF','Wallis y Futuna'),(237,'YE','Yemen'),(238,'DJ','Yibuti'),(239,'ZM','Zambia'),(240,'ZW','Zimbabue');

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompania` text COLLATE utf8_spanish_ci NOT NULL,
  `cuit` text COLLATE utf8_spanish_ci NOT NULL,
  `nombreContacto` text COLLATE utf8_spanish_ci,
  `telefonoFijo` text COLLATE utf8_spanish_ci,
  `telefonoCelular` text COLLATE utf8_spanish_ci,
  `provincia` text COLLATE utf8_spanish_ci,
  `localidad` text COLLATE utf8_spanish_ci,
  `email` text COLLATE utf8_spanish_ci,
  `direccion` text COLLATE utf8_spanish_ci,
  `codigoPostal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `proveedores` */

insert  into `proveedores`(`idProveedor`,`nombreCompania`,`cuit`,`nombreContacto`,`telefonoFijo`,`telefonoCelular`,`provincia`,`localidad`,`email`,`direccion`,`codigoPostal`) values (1,'Coca-Cola','20-32131321-13','Juan','0351-423213','0351-15593161','Cordoba','Cordoba','juan@coca-cola.com','San Martin 321',5000),(2,'Quilmes','31231231','Raul','0321-321313','3231-323131233','La Rioja','La Rioja','juan@pepsi.com','Maipu 2313',33213),(4,'Prityyy','32132312','Juancito','32132','321521',NULL,'La Falda',NULL,NULL,321312),(7,'32131','32131','','','','1','','','',0),(8,'sisiiii','andraaaa',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(9,'Pepsi','123231',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(10,'eewqeqw','32132',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(11,'eewqeqw','32132',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(12,'eewqeqw','32132',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(13,'ewe','3123131',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL),(14,'Mirinda','2312331',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL);

/*Table structure for table `provincias` */

DROP TABLE IF EXISTS `provincias`;

CREATE TABLE `provincias` (
  `idProvincia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `provincias` */

insert  into `provincias`(`idProvincia`,`nombre`) values (1,'Buenos Aires'),(2,'Catamarca'),(3,'Chaco'),(4,'Chubut'),(5,'Córdoba'),(6,'Corrientes'),(7,'Entre Ríos'),(8,'Formosa'),(9,'Jujuy'),(10,'La Pampa'),(11,'La Rioja'),(12,'Mendoza'),(13,'Misiones'),(14,'Neuquén'),(15,'Rio Negro'),(16,'Salta'),(17,'San Juan'),(18,'San Luis'),(19,'Santa Cruz'),(20,'Santa Fe'),(21,'Santiago del Estero'),(22,'Tierra del Fuego'),(23,'Tucuman'),(24,'Antártida e Islas del Atlántico Sur');

/*Table structure for table `reservas` */

DROP TABLE IF EXISTS `reservas`;

CREATE TABLE `reservas` (
  `idReserva` int(10) NOT NULL AUTO_INCREMENT,
  `idCliente` int(10) NOT NULL,
  `idHabitacion` int(10) NOT NULL,
  `idTarifa` int(10) DEFAULT NULL,
  `idEstado` int(10) NOT NULL,
  `idTipoHuesped` int(10) NOT NULL,
  `fechaIn` date NOT NULL,
  `fechaOut` date NOT NULL,
  `cantidadAdultos` int(5) NOT NULL,
  `cantidadMenores` int(5) DEFAULT NULL,
  `idPago` int(10) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idReserva`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `reservas` */

insert  into `reservas`(`idReserva`,`idCliente`,`idHabitacion`,`idTarifa`,`idEstado`,`idTipoHuesped`,`fechaIn`,`fechaOut`,`cantidadAdultos`,`cantidadMenores`,`idPago`,`comentario`) values (1,2,3,3,2,1,'2014-11-03','2014-11-16',0,0,0,NULL),(2,12,21,323,0,0,'2014-11-03','0000-00-00',0,0,0,NULL),(3,12,6,0,1,0,'2014-11-14','2014-11-19',0,0,0,NULL),(4,132,11,0,3,0,'2014-11-15','2014-12-31',0,0,0,NULL),(5,23,23,0,0,0,'2014-11-10','2014-11-14',0,0,0,NULL),(6,0,7,0,0,0,'2014-11-18','2014-11-21',0,0,0,NULL),(7,0,7,NULL,1,1,'2014-12-02','2014-12-10',23,NULL,0,''),(8,0,17,NULL,1,1,'2014-12-04','2014-12-09',3,NULL,0,'siiiii'),(9,1,7,NULL,1,1,'2014-12-09','2014-12-12',4,NULL,0,''),(10,1,7,NULL,1,1,'2014-12-12','2014-12-15',4,NULL,0,'');

/*Table structure for table `tarifas` */

DROP TABLE IF EXISTS `tarifas`;

CREATE TABLE `tarifas` (
  `idTarifa` int(10) NOT NULL AUTO_INCREMENT,
  `monto` int(10) NOT NULL,
  `vigencia` date NOT NULL,
  `idCategoria` int(10) NOT NULL,
  `idTipoHuesped` int(11) NOT NULL,
  PRIMARY KEY (`idTarifa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tarifas` */

insert  into `tarifas`(`idTarifa`,`monto`,`vigencia`,`idCategoria`,`idTipoHuesped`) values (2,450,'2015-03-18',2,3),(5,555,'2015-03-18',2,3);

/*Table structure for table `tarjetas` */

DROP TABLE IF EXISTS `tarjetas`;

CREATE TABLE `tarjetas` (
  `idTarjeta` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idTarjeta`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tarjetas` */

insert  into `tarjetas`(`idTarjeta`,`nombre`) values (6,'American Express'),(5,'Mastercard'),(7,'Naranja'),(8,'Nativa'),(4,'Visa');

/*Table structure for table `tipohuespedes` */

DROP TABLE IF EXISTS `tipohuespedes`;

CREATE TABLE `tipohuespedes` (
  `idTipoHuesped` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idTipoHuesped`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipohuespedes` */

insert  into `tipohuespedes`(`idTipoHuesped`,`nombre`) values (1,'Afiliado'),(2,'Congresista'),(3,'Huesped'),(9,'Particular'),(10,'Preuba'),(11,'Preuba');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreUsuario` (`nombreUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idUsuario`,`nombreUsuario`,`clave`,`email`) values (1,'ozzytop','123456','mattff@live.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
