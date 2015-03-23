--liquibase formatted sql
--changeset author:ggarcia

CREATE TABLE `habitacionporreserva`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `idHabitacion` INT(11) NOT NULL,
  `idReserva` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `UNIQUE` (`idHabitacion`, `idReserva`),
  CONSTRAINT `habitacionporreserva_idHabitacion_FK` FOREIGN KEY (`idHabitacion`) REFERENCES `habitaciones`(`idHabitacion`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `habitacionporreserva_idReserva_FK` FOREIGN KEY (`idReserva`) REFERENCES `reservas`(`idReserva`) ON UPDATE CASCADE ON DELETE CASCADE
);
