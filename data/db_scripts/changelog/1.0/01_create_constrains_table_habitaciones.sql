--liquibase formatted sql
--changeset author:ggarcia

-- First delete all the bogus records
DELETE FROM habitaciones WHERE idPabellon NOT IN (SELECT idPabellon FROM pabellones);
DELETE FROM habitaciones WHERE idCategoria NOT IN (SELECT idCategoria FROM categoriahabitaciones);

-- Then create the proper ForeignKeys
ALTER TABLE `habitaciones`
ADD CONSTRAINT `habitacion_idPabellon_FK` FOREIGN KEY (`idPabellon`) REFERENCES `pabellones`(`idPabellon`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `habitacion_idCategoria_FK` FOREIGN KEY (`idCategoria`) REFERENCES `categoriahabitaciones`(`idCategoria`) ON UPDATE CASCADE ON DELETE CASCADE;