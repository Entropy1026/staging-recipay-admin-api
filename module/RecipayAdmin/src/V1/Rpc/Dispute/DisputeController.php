<?php
namespace RecipayAdmin\V1\Rpc\Dispute;

use Application\Controller\BaseLogActionController;
use Zend\View\Model\JsonModel;
use RecipayAdmin\Domain\Messages\MessagesRepository;
use RecipayAdmin\Domain\Ratings\RatingRepository;
use RecipayAdmin\Infra\Entity\Messages;
use RecipayIdentity\Domain\User\UserRepository;

class DisputeController extends BaseLogActionController
{

    /**
     * @var MessagesRepository
     */
    private $messagesRepository;
     /**
     * @var RatingRepository
     */
    private $ratingRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    public function __construct(MessagesRepository $messagesRepository,
    UserRepository $userRepository,RatingRepository $ratingRepository) {
        $this->messagesRepository = $messagesRepository;
        $this->userRepository = $userRepository;
        $this->ratingRepository = $ratingRepository;
    }
    public function getUsername($id){
        if($id === 'admin')
        {
            return 'admin';
        }
        else{
            $user = $this->userRepository->findById($id);
            return $user[0]->getUser_username();  
        }
    }
    public function getPicture($id){
        if($id === 'admin')
        {
            return null;
        }
        else{
            $user = $this->userRepository->findById($id);
            return $user[0]->getUser_image();  
        }
    }
    public function createDisputeAction(){
        try {
          $forReturn = [];
          $params = $this->getParams();
          $dispute = $this->messagesRepository->findbyOrder($params['order_id']);
          if(count($dispute) > 0){
            $forReturn["error"] = true;
            $forReturn["message"] = "Error Requesting Dispute: There is a existing unresolve dispute report on this order";
          }
          else{
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Sent Dispute Report";
  
            $dj = date('Y-m-d');
            $today = new \DateTime($dj);
            $response = new Messages($params['user_id'],'admin',$params['attachment'],$params['message'],$today,$params['status'],$params['type'],$params['order_id']);
            $this->messagesRepository->persist($response);
            $this->messagesRepository->flush();
  
          }
                   
          return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
          return $this->processApplicationError($ex);
        }
      }
    public function fetchAllAction()
    {
        $forReturn = [];
        try {
            $dispute = $this->messagesRepository->fetchAll();
            $params = $this->getParams();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Dispute";
            if($dispute){
            foreach ($dispute as $d) {
                $forReturn['data'][] = [
                    "id" => $d->getId(),
                    "from" => $this->getUsername($d->getFrom()),
                    "attachment" => $d->getAttachment(),
                    "message" => $d->getMessage(),
                    "date" => $d->getDate(),
                    "status" => $d->getStatus(),
                ];
            }
        }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function getPersonalMessageAction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $dispute = $this->messagesRepository->userMessage($params['user_id']);
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Dispute";
            if($dispute){
            foreach ($dispute as $d) {
                $forReturn['data'][] = [
                    "id" => $d->getId(),
                    "from" => $this->getUsername($d->getFrom()),
                    "attachment" => $d->getAttachment(),
                    "message" => $d->getMessage(),
                    "date" => $d->getDate(),
                    "image" => $this->getPicture($d->getFrom()),
                    "status" => $d->getStatus(),
                    "type" =>$d->getType()
                ];
            }
        }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function selectedDisputeAction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $dispute = $this->messagesRepository->fetchselected($params['status']);
            $params = $this->getParams();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Dispute";
            foreach ($dispute as $d) {
                $forReturn['data'][] = [
                    "id" => $d->getId(),
                    "from" => $this->getUsername($d->getFrom()),
                    "attachment" => $d->getAttachment(),
                    "message" => $d->getMessage(),
                    "date" => $d->getDate(),
                    "status" => $d->getStatus(),
                ];
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deleteAction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $dispute = $this->messagesRepository->delete($params['id']);
            $this->messagesRepository->remove($dispute[0]);
            $this->messagesRepository->flush();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Deleted Dispute";
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function solveDisputeAction(){
        try {
          $params = $this->getParams();
         $message = $this->messagesRepository->findbyid($params['id']);
          $message[0]->setStatus('solved');
          $this->messagesRepository->persist($message[0]);
          $this->messagesRepository->flush();
          
          $forReturn["error"] = false;
          $forReturn["message"] = "Successfully Sent Response";
          return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
          return $this->processApplicationError($ex);
        }
      }
    public function disputeResponseAction(){
        try {
          $params = $this->getParams();
          $user = $this->userRepository->findUsername($params['username']);
          $userid = $user[0]->getId();
          $params = $this->getParams();
          $dj = date('Y-m-d');
          $today = new \DateTime($dj);
          $response = new Messages('admin',$userid,'',$params['message'],$today,'not readed','response','');
          $this->messagesRepository->persist($response);
          $this->messagesRepository->flush();
          $message = $this->messagesRepository->delete($params['id']);
          $message[0]->setStatus('unresolved');
          $this->messagesRepository->persist($message[0]);
          $this->messagesRepository->flush();
          
          $forReturn["error"] = false;
          $forReturn["message"] = "Successfully Sent Response";
          return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
          return $this->processApplicationError($ex);
        }
      }
    public function sendResponseReviewAction(){
        try {
          $params = $this->getParams();
          $user = $this->userRepository->findUsername($params['username']);
          $userid = $user[0]->getId();
          $params = $this->getParams();
          $dj = date('Y-m-d');
          $today = new \DateTime($dj);
          $response = new Messages('admin',$userid,'',$params['message'],$today,'not readed','response');
          $this->messagesRepository->persist($response);
          $this->messagesRepository->flush();
          $ratings = $this->ratingRepository->findbyid($params['id']);
          $ratings[0]->setStatus('readed');
          $this->messagesRepository->persist($ratings[0]);
          $this->messagesRepository->flush();
          
          $forReturn["error"] = false;
          $forReturn["message"] = "Successfully Sent Response";
          return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
          return $this->processApplicationError($ex);
        }
      }
}
