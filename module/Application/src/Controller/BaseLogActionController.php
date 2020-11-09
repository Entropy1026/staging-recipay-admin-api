<?php 

namespace Application\Controller;
use Application\ApplicationException;
use BTRIdentity\Infra\Entity\User;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
class BaseLogActionController extends AbstractActionController {
    public function __construct() {
     
    }
    public function getParams() {
       
        if ($_POST) {
            return $this->getRequest()->getPost();
        }
        return json_decode($this->getRequest()->getContent(), true);
    }
    /**
     * @return InputFilter
     */
    public function getInputFilter() {
        $event = $this->getEvent();
        $inputFilter = $event->getParam("ZF\ContentValidation\InputFilter");
        return $inputFilter;
    }
    /**
     * @return User
     */
    public function getUser() {
        return $this->getIdentity()->getUser();
    }
    public function processApplicationError($ex) {
        return new ApiProblemResponse(new ApiProblem(500, $ex->getMessage()));
    }
}