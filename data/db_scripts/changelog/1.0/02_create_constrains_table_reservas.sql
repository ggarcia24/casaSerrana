--liquibase formatted sql
--changeset author:ggarcia

-- First delete all the bogus records
DELETE FROM reservas WHERE idCliente NOT IN (SELECT idCliente FROM clientes);
DELETE FROM reservas WHERE idHabitacion NOT IN (SELECT idHabitacion FROM habitaciones);
DELETE FROM reservas WHERE idTarifa NOT IN (SELECT idTarifa FROM tarifas);

-- Then create the proper ForeignKeys
ALTER TABLE `reservas`
ADD CONSTRAINT `reservas_idCliente_FK` FOREIGN KEY (`idCliente`) REFERENCES `clientes`(`idCliente`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `habitacion_idHabitacion_FK` FOREIGN KEY (`idHabitacion`) REFERENCES `habitaciones`(`idHabitacion`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `habitacion_idTarifa_FK` FOREIGN KEY (`idTarifa`) REFERENCES `tarifas`(`idTarifa`) ON UPDATE CASCADE ON DELETE CASCADE;