<?php
namespace Album\Form;

use Zend\Form\Annotation\AnnotationBuilder;
use Album\Model\Album;

class FormBuilder {
    private $genres;
    public function __construct($genres) {
        $this->genres = $genres;
    }
    public function newForm(){
        $builder = new AnnotationBuilder();
        $form = $builder->createForm(new Album());

        $form->get('genre')->setValueOptions(
            $this->genres->fetchAllAsArray()
        );
        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
            'type'  => 'submit',
            'value' => 'Add',
            'id' => 'submitbutton',
            ),  
        ));
        return $form;
    }

}
