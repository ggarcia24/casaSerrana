--liquibase formatted sql
--changeset author:ggarcia

CREATE TABLE `huespedesporreserva`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` TEXT NOT NULL,
  `documento` INT(11) NOT NULL,
  `fecha_nac` DATE NOT NULL,
  `check_in` DATETIME NOT NULL,
  `check_out` DATETIME NOT NULL,
  `idHabitacion` INT(11) NOT NULL,
  `idReserva` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`documento`, `idHabitacion`, `idReserva`),
  CONSTRAINT `huespedesporreserva_idHabitacion_FK` FOREIGN KEY (`idHabitacion`) REFERENCES `habitaciones`(`idHabitacion`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `huespedesporreserva_idReserva_FK` FOREIGN KEY (`idReserva`) REFERENCES `reservas`(`idReserva`)  ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB;
