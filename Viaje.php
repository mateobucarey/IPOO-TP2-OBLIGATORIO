<?php

class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    private $objResponsable;

    public function __construct($codigoViaje, $destino, $cantMaxPasajeros, $pasajeros, ResponsableV $objResponsable){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->pasajeros = $pasajeros;
        $this->objResponsable = $objResponsable;
    }

    public function getCodigoViaje()
    {
        return $this->codigoViaje;
    }

    public function setCodigoViaje($codigoViaje)
    {
        $this->codigoViaje = $codigoViaje;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($destino)
    {
        $this->destino = $destino;
    }

    public function getCantMaxPasajeros()
    {
        return $this->cantMaxPasajeros;
    }
 
    public function setCantMaxPasajeros($cantMaxPasajeros)
    {
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function getPasajeros()
    {
        return $this->pasajeros;
    }

    public function setPasajeros($pasajeros)
    {
        $this->pasajeros = $pasajeros;
    }

    public function getObjResponsable()
    {
        return $this->objResponsable;
    }
 
    public function setObjResponsable($objResponsable)
    {
        $this->objResponsable = $objResponsable;
    }

    public function __toString(){

        $cadenaPasajeros = "";
        for ($i=0; $i < count($this->getPasajeros()); $i++) { 
            $cadenaPasajeros = 
            $cadenaPasajeros."\n".$this->getPasajeros()[$i]->__toString();
        }
        return
        "\n Codigo del viaje: ".$this->getCodigoViaje().
        "\n Destino: ".$this->getDestino().
        "\n Cantidad maxima de pasajeros: ".$this->getCantMaxPasajeros().
        "\n Informacion de pasajeros: \n". $cadenaPasajeros.
        "\n Responsable del viaje: \n".$this->getObjResponsable();
    }

}