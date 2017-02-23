<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Agenda\Forms\Forms;
use Agenda\Model\Collection\Categorias;

class CategoriaController extends AbstractActionController
{
    public function showCategoriaAction()
    {
        $data =  (new Categorias)->fetchAll();
        $form   = new Forms('Categoria', 'Categoria');
        return new ViewModel(array('form' => $form ,'data' => $data));
    }
}
