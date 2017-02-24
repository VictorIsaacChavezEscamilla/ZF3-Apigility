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
        $form = new Forms('Categoria', 'Categoria');
        $arr = [];

        foreach ($data as $key => $value) {
            array_push($arr, $value->idCategoria);
        }

        $newId = max($arr) + 1;

        return new ViewModel(['form' => $form, 'data' => $data, 'newId' => $newId]);
    }

    public function addAction()
    {
        $tmp = (new Categorias)->addRow($this->getRequest()->getPost());

        return $this->redirect()->toRoute('categoria');
    }
}
