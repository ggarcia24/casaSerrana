<?php

namespace Cliente\Model;

 class Reserva
 {
     public $idReserva;
     public $idCliente;
     public $idHabitacion;

     public function exchangeArray($data)
     {
         $this->idReserva     = (!empty($data['idReserva'])) ? $data['idReserva'] : null;
         $this->idCliente = (!empty($data['idCliente'])) ? $data['idCliente'] : null;
         $this->idHabitacion  = (!empty($data['idHabitacion'])) ? $data['idHabitacion'] : null;
     }
 }