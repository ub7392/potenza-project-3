<?php

class Application_Form_Person extends Zend_Form
{
    public function init()
        {
            // Set the method for the display form to POST
            $this->setMethod('post');

            // Add an first name element
            $this->addElement('text', 'first_name', array(
                'label'      => 'First Name:',
                'required'   => true,
                'filters'    => array('StringTrim'),
                'validators' => array('first_name')
            ));

            // Add an last name element
            $this->addElement('text', 'last_name', array(
                'label'      => 'Last Name:',
                'required'   => true,
                'filters'    => array('StringTrim'),
                'validators' => array('last_name')
            ));

            // Add the favorite food element
            $this->addElement('text', 'favorite_food', array(
                'label'      => 'Favorite_food:',
                'required'   => true,
                'validators' => array('favorite_food')
            ));

            // Add the submit button
            $this->addElement('submit', 'submit', array(
                'ignore'   => true,
                'label'    => 'Add Person',
            ));

            // And finally add some CSRF protection
            $this->addElement('hash', 'csrf', array(
                'ignore' => true,
            ));
        }

}
