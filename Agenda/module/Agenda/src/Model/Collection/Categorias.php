<?php

namespace Agenda\Model\Collection;

use Agenda\Model\DataOperator;

/**
 *
 */
class Categorias
{
    const NAME_ENTITY = 'categoria';

    public function fetchAll()
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, '');
    }

    public function getAll_Id_Nombre()
    {
        $arr = [];
        foreach ((new DataOperator)->dataAction(self::NAME_ENTITY, '') as $key => $value) {
            $tmp[$value->idCategoria] = ($value)->nombre;
            $arr += $tmp;
        }

        return $arr;
    }

    public function getById($findId)
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, 'getById', ['id' => $findId]);
    }

    public function addRow($newRecord)
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, 'create', $newRecord);
    }

    public function updateRow($editrecord)
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, 'update', $editrecord);
    }

    public function deleteRow($deleteRecord)
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, 'delete', ['id' => $deleteRecord]);

    }
}
