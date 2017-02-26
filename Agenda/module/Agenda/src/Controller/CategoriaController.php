<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda\Controller;

use Agenda\Forms\Forms;
use Agenda\Model\Collection\Categorias;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractActionController
{

    public function showCategoriaAction()
    {
        $data = (new Categorias)->fetchAll();
        $form = new Forms('add', 'Categoria', 'Categoria');
        $arrIds  = [];

        foreach ($data as $key => $value) {
            array_push($arrIds, $value->idCategoria);
        }

        $newId = sizeof($arrIds) > 0 ? max($arrIds) + 1 : 1;

        return new ViewModel(['form' => $form, 'data' => $data, 'newId' => $newId]);
    }

    public function addAction()
    {
        $resp = (new Categorias)->addRow($this->getRequest()->getPost());
		if (isset($resp['Error'])) {
            return $this->redirect()->toRoute('categoria', ['action' => 'error', 'id' => 1]);
        } else {
            return $this->redirect()->toRoute('categoria');
        }
    }

    public function editAction()
    {
        $form     = new Forms('update', 'Categoria', 'Categoria');
        $itemEdit = (new Categorias)->getById($this->params()->fromRoute('id', null));

        return new ViewModel(['form' => $form, 'item' => $itemEdit]);
    }

    public function updateAction()
    {
        $resp = (new Categorias)->updateRow($this->getRequest()->getPost());

        if (isset($resp['Error'])) {
            return $this->redirect()->toRoute('categoria', ['action' => 'error', 'id' => 3]);
        } else {
            return $this->redirect()->toRoute('categoria');
        }
    }

    public function deleteAction()
    {
        $resp = (new Categorias)->deleteRow($this->params()->fromRoute('id', null));

        if (isset($resp['Error'])) {
            return $this->redirect()->toRoute('categoria', ['action' => 'error', 'id' => 4]);
        } else {
            return $this->redirect()->toRoute('categoria');
        }
    }

    public function errorAction()
    {
        $id = $this->params()->fromRoute("id", null);

        switch ($id) {
        	case 1:
                $msjError = 'Ocurrio un error, y no fue posible guardar la categoria.';
        		break;
        	case 3:
                $msjError = 'Ocurrio un error, y no fue posible actualizar la categoria.';
        		break;
            case 4:
                $msjError = 'Ocurrio un error, y no fue posible eliminar la categoria.<br>Es posible que este asignada a uno o mas  contactos.';
                break;
            default:
                $msjError = 'Error.';
                break;
        }

        return new ViewModel(['msjError' => $msjError]);
    }
}
