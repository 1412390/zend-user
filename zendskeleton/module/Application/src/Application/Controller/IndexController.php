<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		
		echo "fdasjhfdjaushfuk";
        return new ViewModel();
        $model->setVariable("postHot", $postHot);
        $page = (int) $this->params()->fromQuery('page',1);
        $data = $this->getAllPostByCategory($getAllCate->id, $this->language, 'post_general', 60, '', $page);
        $model->setVariable("paginator", $data['paginator']);
        $model->setVariable("data", $data);
        $postHot = $this->getPostByCategoryDefault($getAllCate->id, $this->language, 'post_general', ($device == 'phone')?18 : 20, 'new_promotion');
        $model->setVariable("postHot", $postHot);
        $page = (int) $this->params()->fromQuery('page',1);
        $data = $this->getAllPostByCategory($getAllCate->id, $this->language, 'post_general', 60, '', $page);
        $model->setVariable("paginator", $data['paginator']);
        $model->setVariable("data", $data);
        $model->setVariable("postHot", $postHot);
        $page = (int) $this->params()->fromQuery('page',1);
        $data = $this->getAllPostByCategory($getAllCate->id, $this->language, 'post_general', 60, '', $page);
        $model->setVariable("paginator", $data['paginator']);
        $model->setVariable("data", $data);
    }
}
