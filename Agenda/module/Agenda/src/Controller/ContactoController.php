<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda\Controller;

use Agenda\Forms\Forms;
use Agenda\Model\Collection\Contactos;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactoController extends AbstractActionController
{
    public function showContactoAction()
    {
        $data = (new Contactos)->fetchAll();
        $form = new Forms('Contacto', 'Contacto');
        $arr = [];
/*echo "<pre>";
print_r($data);
echo "</pre>";*/
        foreach ($data as $key => $value)
        {
            array_push($arr, $value->idContacto);
        }

        $newId = max($arr) + 1;

        return new ViewModel(['form' => $form, 'data' => $data, 'newId' => $newId]);
    }

    public function addAction()
    {
        $tmp = (new Contactos)->addRow($this->getRequest()->getPost());

        return $this->redirect()->toRoute('contacto');
    }
}
