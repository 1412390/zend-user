<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\User;
use User\Form\RegisterForm;
use User\Form\EditForm;
use User\Form\LoginForm;
class UserController extends AbstractActionController
{
    /**
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    protected $userTable;
    
    public function indexAction()
    {
        // TODO Auto-generated method stub
        return new ViewModel(array(
             'users' => $this->getUserTable()->fetchAll(),
         ));
        
    }
    public function editAction() {
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            
            return $this->redirect()->toRoute('user', array(
                'action' => 'register'
            ));
        }
        
        // Get the user with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            
            $user = $this->getuserTable()->getuser($id);
        }
        catch (\Exception $ex) {
            
            return $this->redirect()->toRoute('user', array(
                'action' => 'index'
            ));
        }
        
        $form  = new EditForm();
        
        $form->bind($user);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $form->setInputFilter($user->getInputFilter());
            
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
                
                $this->getuserTable()->saveUser($user);
      
                // Redirect to list of users
                return $this->redirect()->toRoute('user');
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
    
    }
    public function deleteAction() {
    
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('user');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $del = $request->getPost('del');
        
            if ($del == 'Yes') {
                
                $id = (int) $request->getPost('id');
                
                $this->getUserTable()->deleteUser($id);
            }
            
            // Redirect to list of users
            return $this->redirect()->toRoute('user');
        }
        
        return array(
            'id'    => $id,
            'user' => $this->getuserTable()->getuser($id)
        );
    }
    public function loginAction()
    {
       
      
        $form = new LoginForm();
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $user = new User();
             
            $form->setInputFilter($user->getLoginInputFilter());
            
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
            
                $user->exchangeArray($form->getData());
                 
                if($this->getUserTable()->isExist($user))
                {
                    // successful
                    return $this->redirect()->toRoute('user', array('action' => 'profile'));
                }
               //error
            }  
        }
        
        return array('form' => $form);
    }
    public function logoutAction() {
    
    
    }
    public function registerAction() {
    
        $form = new RegisterForm();
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $user = new User();
                 
            $form->setInputFilter($user->getInputFilter());
            
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
                
                $user->exchangeArray($form->getData());
       
                $this->getUserTable()->saveUser($user);
        
                // Redirect to list of users
                return $this->redirect()->toRoute('user');
            }
        }
        return array('form' => $form);
    }
    public function profileAction()
    {
        
     
        
        return new ViewModel();
    }
    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }

}

?>