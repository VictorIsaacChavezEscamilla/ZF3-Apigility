<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda\Controller;

use Agenda\Forms\Forms;
use Agenda\Model\Collection\Categorias;
use Agenda\Model\Collection\Contactos;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactoController extends AbstractActionController
{
    public function showContactoAction()
    {
        $data      = (new Contactos)->fetchAll();
        $form      = new Forms('add', 'Contacto', 'Contacto');
        $arrIds    = [];
        $contactos = [];

        foreach ($data as $key => $value) {
            array_push($arrIds, $value->idContacto);

            $categoria              = (new Categorias)->getById($value->idCategoria);
            $value->nombreCategoria = $categoria->nombre;

            $item[$key] = $value;
            $contactos += $item;
        }

        $newId = sizeof($arrIds) > 0 ? max($arrIds) + 1 : 1;

        return new ViewModel(['form' => $form, 'data' => $contactos, 'newId' => $newId]);
    }

    public function addAction()
    {
        $resp = (new Contactos)->addRow($this->getRequest()->getPost());
        if (isset($resp['Error'])) {
            //return $this->redirect()->toRoute('contacto', ['action' => 'error', 'id' => 1]);
        } else {
            return $this->redirect()->toRoute('contacto');
        }
    }

    public function editAction()
    {

        $form     = new Forms('update', 'Contacto', 'Contacto');
        $itemEdit = (new Contactos)->getById($this->params()->fromRoute('id', null));

        return new ViewModel(['form' => $form, 'item' => $itemEdit]);
    }

    public function updateAction()
    {
        $resp = (new Contactos)->updateRow($this->getRequest()->getPost());
        if (isset($resp['Error'])) {
            return $this->redirect()->toRoute('contacto', ['action' => 'error', 'id' => 1]);
        } else {
            return $this->redirect()->toRoute('contacto');
        }
    }

    public function deleteAction()
    {
        $resp = (new Contactos)->deleteRow($this->params()->fromRoute('id', null));
        if (isset($resp['Error'])) {
            return $this->redirect()->toRoute('contacto', ['action' => 'error', 'id' => 1]);
        } else {
            return $this->redirect()->toRoute('contacto');
        }
    }

    public function errorAction()
    {
        $id = $this->params()->fromRoute("id", null);

        switch ($id) {
            case 1:
                $msjError = 'Ocurrio un error, y no fue posible guardar el contacto.';
                break;
            case 3:
                $msjError = 'Ocurrio un error, y no fue posible actualizar el contacto.';
                break;
            case 4:
                $msjError = 'Ocurrio un error, y no fue posible eliminar el contacto.';
                break;
            default:
                $msjError = 'Error.';
                break;
        }

        return new ViewModel(['msjError' => $msjError]);
    }
}
