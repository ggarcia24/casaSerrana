--liquibase formatted sql
--changeset author:ggarcia

ALTER TABLE `reservas`
DROP FOREIGN KEY habitacion_idTarifa_FK,
DROP COLUMN `idTarifa`,
DROP COLUMN `idEstado`,
DROP COLUMN `idTipoHuesped`,
CHANGE `fechaIn` `arrival_date` DATETIME NOT NULL,
CHANGE `fechaOut` `departure_date` DATETIME NOT NULL,
CHANGE `comentario` `comentario` TEXT CHARSET utf8 COLLATE utf8_spanish_ci NOT NULL,
ADD COLUMN `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP  NOT NULL AFTER `comentario`,
ADD COLUMN `updated_date` DATETIME NOT NULL AFTER `created_date`,
ADD  UNIQUE INDEX `UNIQUE` (`idHabitacion`, `arrival_date`);