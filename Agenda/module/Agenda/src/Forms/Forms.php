<?php

namespace Agenda\Forms;

//use Zend\Form\View\Helper\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;
use Agenda\Model\Collection\Categorias;

/**
 *
 */
class Forms extends Form
{

    public function __construct($name = null, $tipo = null)
    {
        parent::__construct($name);

        switch ($tipo) {
            case 'Contacto':
                self::constructFormContacto();
                break;
            case 'Categoria':
                self::constructFormCategoria();
                break;
            default:
                self::constructFormEmpty();
                break;
        }
    }

    private function constructFormEmpty()
    {
    }

    private function constructFormContacto()
    {
        $this->setAttribute('Action', '/contacto/add');

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

    private function constructFormCategoria()
    {
        $this->setAttribute('Action', '/categoria/add');

        $this->add((new Element\Hidden('idCategoria')));

        $this->add((new Element\Text('nombre'))
                ->setLabel('Nombre: ')
                ->setAttributes(array(
                    'class'       => 'form-control',
                    'placeholder' => 'Nombre Categoria',
                ))
        );

        $this->add((new Element\Text('Descripcion'))
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
