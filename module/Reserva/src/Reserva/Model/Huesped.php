<?php
/**
 * Created by IntelliJ IDEA.
 * User: ggarcia
 * Date: 05/01/2015
 * Time: 11:11 PM
 */

namespace Reserva\Model;


class Huesped {

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $fechaNac;

    /**
     * @var string
     */
    protected $documento;

    /**
     * @var int
     */
    protected $reserva_id;

    /**
     * @var Reserva
     */
    protected $reserva;

    /**
     * @var int
     */
    protected $habitacion_id;

    /**
     * @var Habitacion
     */
    protected $habitacion;

    const EDAD_MENOR = 5;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Huesped
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * @param string $nombreHuesped
     * @return Huesped
     */
    public function setNombre($nombreHuesped) {
        $this->nombre = $nombreHuesped;
        return $this;
    }

    /**
     * @return string
     */
    public function getFechaNac() {
        return $this->fechaNac;
    }

    /**
     * @param string $fechaNacHuesped
     * @return Huesped
     */
    public function setFechaNac($fechaNacHuesped) {
        $this->fechaNac = $fechaNacHuesped;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentoHuesped() {
        return $this->documento;
    }

    /**
     * @param string $documentoHuesped
     * @return Huesped
     */
    public function setDocumentoHuesped($documentoHuesped) {
        $this->documento = $documentoHuesped;
        return $this;
    }

    /**
     * @return bool
     */
    public function esAdulto() {
        return $this->getEdad() >= self::EDAD_MENOR;
    }

    /**
     * @return bool
     */
    public function esMenor() {
        return $this->getEdad() < self::EDAD_MENOR;
    }

    /**
     * @return int
     */
    public function getEdad() {
        return date_diff(date_create($this->getFechaNac()), date_create('today'))->y;
    }


}