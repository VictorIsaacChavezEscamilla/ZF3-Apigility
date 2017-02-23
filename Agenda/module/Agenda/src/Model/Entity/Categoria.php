<?php

namespace Agenda\Model\Entity;

/**
 *
 */
class Categoria
{
    public $idCategoria;
    public $descripcion;
    public $nombre;

    public function exchangeArray(array $data)
    {
        $this->idCategoria = !empty($data['idCategoria']) ? $data['idCategoria'] : null;
        $this->descripcion = !empty($data['descripcion']) ? $data['descripcion'] : null;
        $this->nombre      = !empty($data['nombre']) ? $data['nombre'] : null;
    }
}
