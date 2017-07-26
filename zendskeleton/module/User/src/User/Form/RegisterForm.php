<?php
namespace User\Form;

use Zend\Form\Form;
class RegisterForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('user');
    
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                
                'id' => 'email',
                'class' => 'form-control',
                'required' => 'true',
                'placehoder' => 'Type your Email here'        
            )
            ,
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'id' => 'password',
                'class' => 'form-control',
                'required' => 'true',
                'placehoder' => 'Type your Password here'        
            )
            ,
        ));
        
        $this->add(array(
            'name' => 'cfm_password',
            'type' => 'password',
            'options' => array(
                'label' => 'Confirm Password',
            ),
            'attributes' => array(
                'id' => 'cfm_password',
                'class' => 'form-control',
                'required' => 'true',
                'placehoder' => 'Type your Cfm_Password here'
            )
            ,
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Register',
                'id' => 'submitbutton',
                'class' => 'btn btn-success'   
            ),
        ));
    }
}

?>