<?php

namespace Agenda\Model\Entity;

/**
 *
 */
class Contacto
{
    public $idContacto;
    public $correo;
    public $nombre;
    public $telefono;
    public $idCategoria;

    public function exchangeArray(array $data)
    {
        $this->idContacto  = !empty($data['idContacto']) ? $data['idContacto'] : null;
        $this->correo      = !empty($data['correo']) ? $data['correo'] : null;
        $this->nombre      = !empty($data['nombre']) ? $data['nombre'] : null;
        $this->telefono    = !empty($data['telefono']) ? $data['telefono'] : null;
        $this->idCategoria = !empty($data['idCategoria']) ? $data['idCategoria'] : null;
    }
}
