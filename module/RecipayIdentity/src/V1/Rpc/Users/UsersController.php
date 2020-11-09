<?php

namespace RecipayIdentity\V1\Rpc\Users;

// use Assert\InvalidArgumentException;
use Application\ApplicationException;
use RecipayIdentity\Domain\User\UserRepository;
use RecipayMobileOrder\Domain\Order\OrderRepository;
use RecipayAdmin\Domain\Favorites\FavoriteRepository;
use RecipayAdmin\Domain\Action\ActionRepository;
use Zend\View\Model\JsonModel;
use Application\Controller\BaseLogActionController;
use RecipayIdentity\Infra\Entity\User;
use Zend\Http\Header\Date;
// use ZfrPusher\Client\Credentials;
// use ZfrPusher\Client\PusherClient;
// use ZfrPusher\Service\PusherService;
use Pusher\Pusher;

class UsersController extends BaseLogActionController
{
  /**
   * @var UserRepository
   */
  private $userRepository;
   /**
   * @var OrderRepository
   */
  private $orderRepository;
  /**
   * @var FavoriteRepository
   */
  private $favoriteRepository;
   /**
   * @var ActionRepository
   */
  private $actionRepository;

  public function __construct(UserRepository $userRepository,OrderRepository $orderRepository,
   FavoriteRepository $favoriteRepository ,  ActionRepository $actionRepository)
  {
    $this->userRepository = $userRepository;
    $this->orderRepository = $orderRepository;
    $this->favoriteRepository = $favoriteRepository;
    $this->actionRepository = $actionRepository;
  }
  public function orderCount($id){
    $myorders = $this->orderRepository->fetchOrderByUser($id);
    $count =count($myorders);
    return "$count";
  }
  public function favoriteCount($id){
    $myfavorite = $this->favoriteRepository->fetchFavorites($id);
    $count =count($myfavorite);
    return "$count";
  }
  public function LastLoggedin($id){
    $last = $this->actionRepository->lastlogged($id);
    if(count($last)>0){ 
    return $last[0]->getDate();
    }
    return " ";
  }
  public function loginAction()
  {
    // $credentials = new Credentials("848354", "54c8120b2564780fce9c", "9cb1201484f8fe60621a");
    // $client      = new PusherClient($credentials);
    // $service     = new PusherService($client);
    $app_id = '848354';
    $app_key = '54c8120b2564780fce9c';
    $app_secret = '9cb1201484f8fe60621a';
    $app_cluster = 'ap1';

    $pusher = new Pusher( $app_key, $app_secret, $app_id, array('cluster' => $app_cluster) );
    
    $forReturn = [];
    try {
      $params = $this->getParams();
      $user = $this->userRepository->login($params['username'], $params['password']);

      if ($user == null) {
        $hasusername = $this->userRepository->findUsername($params['username']);
        if (!$hasusername) {
          $forReturn["error"] = true;
          $forReturn["message"] = "User Doesn't Exist";
        } else {
          $forReturn["error"] = true;
          $forReturn["message"] = "Incorrect Password try again";
        }
      } else {
        $forReturn["error"] = false;
        $forReturn["message"] = "Successfully Login";
        foreach ($user as $u) {
          $forReturn["data"] =
            [
              "id"=>$u->getId(),
              "firstname" => $u->getFname(),
              "lastname" => $u->getLname(),
              "middlename" => $u->getMname(),
              "username" => $u->getUser_username(),
              "user_type" => $u->getUser_type(),
              "email" => $u->getUser_email(),
              "image" => $u->getUser_image(),
              "mobile" => $u->getContact(),
              "password" => $u->getUser_Password()
            ];
        }
      } 
      $pusher->trigger( 'recipay', 'login', ["id"=>"boboka"] );
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function fetchAllAction()
  {
    $forReturn = [];
    try {
      $params = $this->getParams();
      $user = $this->userRepository->fetchall();
      $forReturn["error"] = false;
      $forReturn["message"] = "Successfully Fetch Users";
      foreach ($user as $u) {
      $forReturn["data"][]=
          [
            "id" => $u->getId(),
            "firstname" => $u->getFname(),
            "lastname" => $u->getLname(),
            "middlename" => $u->getMname(),
            "username" => $u->getUser_username(),
            "user_type" => $u->getUser_type(),
            "email" => $u->getUser_email(),
            "image" => $u->getUser_image(),
            "mobile" => $u->getContact(),
            "joined" => $u->getUser_joined(),
            "status" =>$u->getUser_status(),
            "order_made" =>$this->orderCount($u->getId()),
            "product_favorite" => $this->favoriteCount($u->getId()),
            "last_logged"=> $this->LastLoggedin($u->getId())
          ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function adminUpdateStatusAction()
  {
    $forReturn = [];
    try {
      $params = $this->getParams();
      $user = $this->userRepository->findById($params['id']);
      $action = "";
      $action2= "";
      if($params['action']=='active') {
        $action2 = "Unsuspended";
      }
      elseif($params['action']=='suspended'){
        $action2 = "Suspended";
      }
      elseif($params['action']=='deactivate'){
        $action2 = "Deactivate";
      }
      $user[0]->setUser_status($params['action']);
      $this->userRepository->persist($user[0]);
      $this->userRepository->flush($user[0]);
      $forReturn["error"] = false;
      $forReturn["message"] = "Successfully $action2 the user";
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function addforAdminAction()
  {
    $forReturn = [];
    try {
      $params = $this->getParams();
      $username = $this->userRepository->findUsername($params['username']);
      if(count($username)>0){
      $forReturn["error"] = false;
      $forReturn["message"] = "Username Already Exist";
      }
      else{
      $dj = date('Y-m-d');
      $today = new \DateTime($dj);
      $user = new User($params['username'],$params['firstname'],$params['middlename'],$params['lastname'],
      $params['email'],$params['mobile'],$params['user_type'],$params['user_status'],'ilovefood143',$today
      );
      $this->userRepository->persist($user);
      $this->userRepository->flush();
      $forReturn["error"] = false;
      $forReturn["message"] = "Successfully Added user";
    }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function registerAction()
  {
    $forReturn = [];
    try {
      $params = $this->getParams();
      $username = $this->userRepository->findUsername($params['username']);
      if(count($username)>0){
      $forReturn["error"] = true;
      $forReturn["message"] = "Username Already Exist";
      }
      elseif($params['password']!=$params['password2']){
        $forReturn["error"] = true;
        $forReturn["message"] = "Password Didn't Match";
      }
      else{
      $dj = date('Y-m-d');
      $today = new \DateTime($dj);
      $user = new User($params['username'],$params['firstname'],$params['middlename'],$params['lastname'],
      $params['email'],$params['mobile'],'client','active',$params['password'],$today
      );
      $this->userRepository->persist($user);
      $this->userRepository->flush();
      $forReturn["error"] = false;
      $forReturn["message"] = "Successfully Added user";
    }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function getAvailCarrierAction(){
    $forReturn = [];
    try {
      // $params = $this->getParams();
      $user = $this->userRepository->getCarriers();
      $forReturn["error"] = false;
      $forReturn["message"] = "fetch available carrier";  
      foreach ($user as $u) {
        $forReturn["data"][]=
            [
              "id" => $u->getId(),
              "name" => $u->getFname()." , ".$u->getLname(),
            ];
        }
     
      
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function updatePersonalInfoAction(){
    $forReturn = [];
     try {
       $params = $this->getParams();
       $user = $this->userRepository->findById($params['id']);
       $user[0]->setFname($params['fname']);
       $user[0]->setLname($params['lname']);
       $user[0]->setMname($params['mname']);
       $user[0]->setUser_username($params['username']);
       $user[0]->setContact($params['mobile']);
       $this->userRepository->persist($user[0]);
       $this->userRepository->flush($user[0]);
       $forReturn["error"] = false;
       $forReturn["message"] = "Successfully updated info";
       return new JsonModel($forReturn);
     } catch (ApplicationException $ex) {
       return $this->processApplicationError($ex);
     }
   }
   public function updateEmailInfoAction(){
    $forReturn = [];
     try {
       $params = $this->getParams();
       $user = $this->userRepository->findById($params['id']);
       $user[0]->setUser_email($params['email']);
       $this->userRepository->persist($user[0]);
       $this->userRepository->flush($user[0]);
       $forReturn["error"] = false;
       $forReturn["message"] = "Successfully updated info";
       return new JsonModel($forReturn);
     } catch (ApplicationException $ex) {
       return $this->processApplicationError($ex);
     }
   }
   public function updateImageInfoAction(){
    $forReturn = [];
     try {
       $params = $this->getParams();
       $user = $this->userRepository->findById($params['id']);
       $user[0]->setUser_image($params['image']);
       $this->userRepository->persist($user[0]);
       $this->userRepository->flush($user[0]);
       $forReturn["error"] = false;
       $forReturn["message"] = "Successfully updated Image";
       return new JsonModel($forReturn);
     } catch (ApplicationException $ex) {
       return $this->processApplicationError($ex);
     }
   }
   public function updatePasswordInfoAction(){
    $forReturn = [];
     try {
       $params = $this->getParams();
       $user = $this->userRepository->findById($params['id']);
       $user[0]->setUser_username($params['username']);
       $user[0]->setUser_password($params['password']);
       $this->userRepository->persist($user[0]);
       $this->userRepository->flush($user[0]);
       $forReturn["error"] = false;
       $forReturn["message"] = "Successfully updated Password";
       return new JsonModel($forReturn);
     } catch (ApplicationException $ex) {
       return $this->processApplicationError($ex);
     }
   }

   public function loginViaFacebookAction()
   {
     $forReturn = [];
     try {
       $params = $this->getParams();
       $user = $this->userRepository->findUsername($params['username']);
       if(count($user)>0){
        $user[0]->setUser_image($params['user_image']);
        $this->userRepository->persist($user[0]);
        $this->userRepository->flush($user[0]);
        $forReturn["error"] = false;
        $forReturn["message"] = "Successfully Login";
        foreach ($user as $u) {
          $forReturn["data"] =
            [
              "id"=>$u->getId(),
              "firstname" => $u->getFname(),
              "lastname" => $u->getLname(),
              "middlename" => $u->getMname(),
              "username" => $u->getUser_username(),
              "user_type" => $u->getUser_type(),
              "email" => $u->getUser_email(),
              "image" => $u->getUser_image(),
              "mobile" => $u->getContact(),
              "password" => $u->getUser_Password()
            ];
          } 
       }
       else{
       $dj = date('Y-m-d');
       $today = new \DateTime($dj);
       $user = new User($params['username'],$params['firstname'],$params['middlename'],$params['lastname'],
       $params['email'],$params['mobile'],'fb-client','active',$params['password'],$today
       );
       $this->userRepository->persist($user);
       $this->userRepository->flush();
       $user = $this->userRepository->findUsername($params['username']);
       if(count($user)>0){
        $user[0]->setUser_image($params['user_image']);
        $this->userRepository->persist($user[0]);
        $this->userRepository->flush($user[0]);
        $forReturn["error"] = false;
        $forReturn["message"] = "Successfully Login";
        foreach ($user as $u) {
          $forReturn["data"] =
            [
              "id"=>$u->getId(),
              "firstname" => $u->getFname(),
              "lastname" => $u->getLname(),
              "middlename" => $u->getMname(),
              "username" => $u->getUser_username(),
              "user_type" => $u->getUser_type(),
              "email" => $u->getUser_email(),
              "image" => $u->getUser_image(),
              "mobile" => $u->getContact(),
              "password" => $u->getUser_Password()
            ];
          } 
       }
     }
       return new JsonModel($forReturn);
     } catch (ApplicationException $ex) {
       return $this->processApplicationError($ex);
     }
   }
}
    