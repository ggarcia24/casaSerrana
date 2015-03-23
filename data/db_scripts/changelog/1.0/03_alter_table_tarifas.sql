--liquibase formatted sql
--changeset author:ggarcia

ALTER TABLE tarifas
CHANGE `vigencia` `start_date` DATETIME NOT NULL,
ADD COLUMN `end_date` DATETIME NULL AFTER `start_date`,
ADD CONSTRAINT `tarifas_idCategoria_FK` FOREIGN KEY (`idCategoria`) REFERENCES `categoriahabitaciones`(`idCategoria`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `tarifas_idTipoHuesped_FK` FOREIGN KEY (`idTipoHuesped`) REFERENCES `tipohuespedes`(`idTipoHuesped`) ON UPDATE CASCADE ON DELETE CASCADE;
