<?php

namespace Agenda\Forms;

//use Zend\Form\View\Helper\Captcha;
use Agenda\Model\Collection\Categorias;
use Zend\Form\Element;
use Zend\Form\Form;

/**
 *
 */
class Forms extends Form
{

    public function __construct($action, $name = null, $tipo = null)
    {
        parent::__construct($name);

        switch ($tipo) {
            case 'Contacto':
                self::constructFormContacto($action);
                break;
            case 'Categoria':
                self::constructFormCategoria($action);
                break;
            default:
                self::constructFormEmpty();
                break;
        }
    }

    private function constructFormEmpty()
    {
    }

    private function constructFormContacto($action)
    {
        $this->setAttribute('Action', '/contacto/' . $action);

        $this->add((new Element\Hidden('idContacto')));

        $this->add((new Element\Text('nombre'))
                ->setLabel('Nombre: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'Nombre Completo',
                ))
        );

        $this->add((new Element\Text('telefono'))
                ->setLabel('Telefono: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => '(00) 000-0000',
                ))
        );

        $this->add((new Element\Text('correo'))
                ->setLabel('Correo: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'email@dominio',
                ))
        );

        $this->add((new Element\Select('idCategoria'))
                ->setLabel('Categoria: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'Categoria',
                ))
                ->setValueOptions((new Categorias)->getAll_Id_Nombre())
        );

        //__________________BOTONES__________________
        $this->add((new Element('btnGuardar'))
                ->setAttributes(array(
                    'type'  => 'submit',
                    'value' => 'Guardar',
                    'title' => 'Guardar',
                    'class' => 'btn btn-info',
                )
                ));
    }

    private function constructFormCategoria($action)
    {
        $this->setAttribute('Action', '/categoria/' . $action);

        $this->add((new Element\Hidden('idCategoria')));

        $this->add((new Element\Text('nombre'))
                ->setLabel('Nombre: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'Nombre Categoria',
                ))
        );

        $this->add((new Element\Text('descripcion'))
                ->setLabel('Descripcion: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'Descripcion...',
                ))
        );

        //__________________BOTONES__________________
        $this->add((new Element('btnGuardar'))
                ->setAttributes(array(
                    'type'  => 'submit',
                    'value' => 'Guardar',
                    'title' => 'Guardar',
                    'class' => 'btn btn-info',
                )
                ));
    }

}
