<?php

namespace Agenda\Model\Collection;

use Agenda\Model\DataOperator;

/**
 *
 */
class Contactos
{
	const NAME_ENTITY = 'contacto';

        public function fetchAll()
    {
        return (new DataOperator)->dataAction(self::NAME_ENTITY, '');
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
