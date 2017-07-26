<?php
namespace User\Model;


use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;

class User implements InputFilterAwareInterface
{
   protected $id;
   protected $email;
   protected $password;
   protected $role;
   protected $inputFilter;                       // <-- Add this variable
     
/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

/**
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

/**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

/**
     * @param field_type $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

/**
     * @param field_type $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

/**
     * @param field_type $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function exchangeArray($data)
     {
         $this->id     = (isset($data['id']))     ? $data['id']     : null;
         $this->email = (isset($data['email'])) ? $data['email'] : null;
         $this->password  = (isset($data['password']))  ? $data['password']  : null;
         $this->role     = (isset($data['role']))     ? $data['role']     : 'default';
          
     }
     // Add the following method:
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
 // ...
     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }
     
     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             
             $inputFilter = new InputFilter();
     
             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
     
             $inputFilter->add(array(
                 'name'     => 'email',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
     
             $inputFilter->add(array(
                 'name'     => 'password',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 6,
                             'max'      => 64,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'cfm_password',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Identical',
                         'options' => array(
                             'token' => 'password',
                             'min'      => 6,
                             'max'      => 64,
                         ),
                     ),
                 ),
             ));
     
             $this->inputFilter = $inputFilter;
         }
     
         return $this->inputFilter;
     }

     
     public function getLoginInputFilter()
     {
         if (!$this->inputFilter) {
              
             $inputFilter = new InputFilter();
        
              
             $inputFilter->add(array(
                 'name'     => 'email',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
              
             $inputFilter->add(array(
                 'name'     => 'password',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 6,
                             'max'      => 64,
                         ),
                     ),
                 ),
             ));
     
              
             $this->inputFilter = $inputFilter;
         }
          
         return $this->inputFilter;
     }
      
}

?>