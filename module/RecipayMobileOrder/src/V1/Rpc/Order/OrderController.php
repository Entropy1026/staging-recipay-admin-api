<?php

namespace RecipayMobileOrder\V1\Rpc\Order;

use Zend\View\Model\JsonModel;
use Application\Controller\BaseLogActionController;
use RecipayMobileOrder\Domain\Order\OrderRepository;
use RecipayAdmin\Domain\Product\ProductRepository;
use RecipayIdentity\Domain\Billing\BillingRepository;
use RecipayIdentity\Domain\User\UserRepository;
use RecipayIdentity\Infra\Entity\Billing;
use RecipayMobileOrder\Domain\Payment\PaymentRepository;
use RecipayMobileOrder\Infra\Entity\Payment;
use RecipayMobileOrder\Domain\Cart\CartRepository;
use RecipayMobileOrder\Infra\Entity\Cart;
use RecipayMobileOrder\Infra\Entity\Order;
use ZfrPusher\Client\Credentials;
use ZfrPusher\Client\PusherClient;
use ZfrPusher\Service\PusherService;

use Pusher\Pusher;

class OrderController extends BaseLogActionController
{

  private $app_id = '848354';
  private $app_key = '54c8120b2564780fce9c';
  private $app_secret = '9cb1201484f8fe60621a';
  private $app_cluster = 'ap1';


  /**
   * @var OrderRepository
   */
  private $orderRepository;
  /**
   * @var CartRepository
   */
  private $cartRepository;
  /**
   * @var ProductRepository
   */
  private $productRepository;
  /**
   * @var BillingRepository
   */
  private $billingRepository;
  /**
   * @var PaymentRepository
   */
  private $paymentRepository;
  /**
   * @var UserRepository
   */
  private $userRepository;



  public function __construct(
    OrderRepository $orderRepository,
    CartRepository $cartRepository,
    ProductRepository $productRepository,
    BillingRepository $billingRepository,
    PaymentRepository $paymentRepository ,
    UserRepository $userRepository
  ) {
    $this->orderRepository = $orderRepository;
    $this->cartRepository = $cartRepository;
    $this->productRepository = $productRepository;
    $this->billingRepository = $billingRepository;
    $this->paymentRepository = $paymentRepository;
    $this->userRepository = $userRepository;
  }
  public function getItemPrice($price, $quantity)
  {
    return $price * $quantity;
  }
  public function getCartItemsAction()
  {
    try {
      $forReturn = [];
      $params = $this->getParams();
      $cart  = $this->cartRepository->fetchMyCart($params['id']);
      if (count($cart) == 0) {
        $forReturn["error"] = false;
        $forReturn["message"] = "No Cart Items";
        $forReturn['data'] = [];
      } else {
        foreach ($cart as $c) {
          $product = $this->productRepository->fetchById($c->getProduct_id());
          $forReturn["error"] = false;
          $forReturn["message"] = "Successfully Fetch Cart Items";
          foreach ($product as $p) {
            $forReturn['data'][] = [
              "cart_id" => $c->getId(),
              "product_id" => $p->getId(),
              "image" => $p->getImage(),
              "name" => $p->getName(),
              "qty" => $c->getQuantity(),
              "price" => $this->getItemPrice($p->getBaseprice(), $c->getQuantity())
            ];
          }
        }
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function addCartItemAction()
  {
    try {
      $params = $this->getParams();
      $cart = new Cart($params['product_id'], $params['user_id'], $params['quantity']);
      $this->cartRepository->persist($cart);
      $this->cartRepository->flush();
      $forReturn = [
        "error" => false,
        "message" => "Added to Cart"
      ];
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function deleteCartItemAction()
  {
    $params = $this->getParams();
    try {
      if (!isset($params['id'])) {
        $forReturn = ["status" => true, "message" => "Error Deleting Required ID"];
      } else {
        $cart = $this->cartRepository->findBy("id", $params['id']);
        $this->cartRepository->remove($cart);
        $this->cartRepository->flush();
        $forReturn = ["status" => false, "message" => "Item Removed from Cart"];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
  }
  public function getBillingInfo($id)
  {
    $billing = $this->billingRepository->findById($id);
    $user    =  
    $forReturn = [];
    if (count($billing) > 0) {
       $forReturn["Address"]  = $billing[0]->getAddress();
       $forReturn["City"] = $billing[0]->getCity();
       $forReturn["Region"] = $billing[0]->getRegion();
       $forReturn["Country"] = $billing[0]->getCountry();
       $forReturn["Postal"] = $billing[0]->getPostal();
       $forReturn["Contact"] = $billing[0]->getMobile();

    
    }
    return $forReturn;
  }
  public function getCartItemsOnOrder($id)
  {
    $forReturn = [];
    $cartitems = $this->cartRepository->findById("order_id", $id);
    foreach ($cartitems as $c) {
      $product = $this->productRepository->fetchById($c->getProduct_id());
      array_push(
        $forReturn,
        [ 
          "id" => $product[0]->getId(),
          "name" => $product[0]->getName(),
          "qty" => $c->getQuantity(),
          "price" => $product[0]->getBaseprice() * $c->getQuantity()
        ]
      );
    }
    return $forReturn;
  }
  public function getPaymentInfo($id)
  {
    $forReturn = [];
    $paymentinfo = $this->paymentRepository->fetchbyId($id);
    $forReturn["amount"] =  $paymentinfo[0]->getAmount();
    $forReturn["method"] =  $paymentinfo[0]->getMethod();
    $forReturn["transaction_id"] = $paymentinfo[0]->getTransaction();
     
    return $forReturn;
  }

  public function orderAction()
  {
    $params = $this->getParams();

    $forReturn = [];
    try {
      $date = date_create($params['delivery_date_picked']);
      $pickeddate = date_format($date, 'Y-m-d H:i:s');
      $order = new Order("Prepairing", $params["user_id"], $pickeddate);
      $billing = new Billing($params['billing_address'], $params['billing_city'], $params['user_id'] , $params['contact_info']);
      $this->billingRepository->persist($billing);
      $this->billingRepository->flush();
      $payment = new Payment($params['amount'], $params['method'], $params['transaction']);
      $this->paymentRepository->persist($payment);
      $this->paymentRepository->flush();
      $order->setBilling_id($billing->getId());
      $order->setPayment_type($payment->getId());
      $this->orderRepository->persist($order);
      $this->orderRepository->flush();
      $items = $this->cartRepository->fetchOrderItems($params['user_id']);
      foreach ($items as $item) {
        $item->setOrder_id($order->getId());
        $this->cartRepository->persist($item);
        $this->cartRepository->flush($item);

        $product = $this->productRepository->fetchById($item->getProduct_id());
        $product[0]->setStock($product[0]->getStock()-$item->getQuantity());
        $product[0]->setSales_count($product[0]->getSales_count()+$item->getQuantity());
        $this->productRepository->persist($product[0]);
        $this->productRepository->flush($product[0]);
      }
 
      // Single channel
      $service->trigger('recipay', 'orderBuy', array('hello' => 'World'));

      $forReturn = ["error" => false, "message" => "Thank you for your Purchase"];
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function mydeliveryAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "My Orders"];
      $myorders = $this->orderRepository->fetchOrderByCarrier($params['user_id']);
      if(count($myorders)==0){
        $forReturn['data'] = [];
      }
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function receiveOrderAction()
  {
    $params = $this->getParams();
    $date = date('Y-m-d');
    $today = new \DateTime($date);
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Succesfully Delivered","data"=>[]];
      $myorders = $this->orderRepository->findBy('id',$params['order_id']);
      $myorders[0]->setOrder_status("Delivered");
      $myorders[0]->setDelivered($today);
      $this->orderRepository->persist($myorders[0]);
      $this->orderRepository->flush($myorders[0]);

      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function completeOrderByCarrierAction()
  {
    $params = $this->getParams();
    $date = date('Y-m-d');
    $today = new \DateTime($date);
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Succesfully Delivered","data"=>[]];
      $myorders = $this->orderRepository->findBy('id',$params['order_id']);
      $myorders[0]->setOrder_status("Waiting User Confirmation");
      $myorders[0]->setDelivered($today);
      $this->orderRepository->persist($myorders[0]);
      $this->orderRepository->flush($myorders[0]);

      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function myorderAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "My Orders"];
      $myorders = $this->orderRepository->fetchOrderByUser($params['user_id']);
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function findMyOrderAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "My Orders"];
      $myorders = $this->orderRepository->findByUser($params['user_id'],$params['order_id']);
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function adminfetchOrderAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Orders Loaded"];
      $myorders = $this->orderRepository->fetchAllOrder();
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "user" => $mo->getUser(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function preparationOrderAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Orders Loaded"];
      $myorders = $this->orderRepository->fetchpreparation();
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "user" => $mo->getUser(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function carrierName($id){
   $user = $this->userRepository->findById($id);
   return $user[0]->getFname().",".$user[0]->getLname();
  //  return count($user);
  }
  public function username($id){
    $user = $this->userRepository->findById($id); 
    return $user[0]->getUser_username();
   //  return count($user);
   }
  public function workOrdersAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Orders Loaded"];
      $myorders = $this->orderRepository->workOrders();
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "user" => $mo->getUser(),
          "date" => $mo->getDate(),
          "status" => $mo->getOrder_status(),
          "carrier" => $this->carrierName($mo->getCarrier()),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function updatetoPrepairAction()
  {
    $forReturn = [];

    try {
      $pusher = new Pusher( $this->app_key, $this->app_secret, $this->app_id, array('cluster' => $this->app_cluster));
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Updated to On Proccess"];
      $product = $this->orderRepository->findBy('id',$params['id']);
      $product[0]->setOrder_status('On Proccess');
      $this->orderRepository->persist($product[0]);
      $this->orderRepository->flush();
      $id = $params['id'];
      $pusher->trigger( 'recipay', 'order', ["id"=>$product[0]->getUser() , "Message"=> "Your Order with id ($id) is on preparation"] );
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }

    return new JsonModel($forReturn);
  }
  public function cancelOrderAction()
  {
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Cancelled  Order"];
      $product = $this->orderRepository->findBy('id',$params['id']);
      $product[0]->setOrder_status('Cancelled');
      $this->orderRepository->persist($product[0]);
      $this->orderRepository->flush();
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function AssignCarrierAction()
  {
    $forReturn = [];
    try {
      $pusher = new Pusher( $this->app_key, $this->app_secret, $this->app_id, array('cluster' => $this->app_cluster));
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Successfully Assigned Delivery Man"];
      $product = $this->orderRepository->findBy('id',$params['id']);
      $product[0]->setCarrier($params['carrier']);
      $product[0]->setOrder_status('On Delivery');
      $this->orderRepository->persist($product[0]);
      $this->orderRepository->flush();
      $pusher->trigger( 'recipay', 'order', ["id"=>$product[0]->getUser() , "Message"=> "Your Order with id ($id) is on Delivery"] );
      $pusher->trigger( 'recipay', 'order', ["id"=>$product[0]->getCarrier() , "Message"=> "Order with id ($id) is on assigned to you"] );
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function OrderSalesAction()
  {
    $params = $this->getParams();
    $forReturn = [];
    try {
      $params = $this->getParams();
      $forReturn = ["error" => false, "message" => "Sales"];
      $myorders = $this->orderRepository->fetchdelivered();
      foreach ($myorders as $mo) {
        $forReturn['data'][] = [
          "id" => $mo->getId(),
          "user" => $this->username($mo->getUser()),
          "date" => $mo->getDate(),
          // "status" => $mo->getOrder_status(),
          "items" => $this->getCartItemsOnOrder($mo->getId()),
          "billinginfo" => $this->getBillingInfo($mo->getBilling_id()),
          "payment" => $this->getPaymentInfo($mo->getPayment_type()),
          "delivery_datetime" => $mo->getDeliverydate(),
          "carrier"=> $this->carrierName($mo->getCarrier()),
          "delivered"=> $mo->getDelivered()
        ];
      }
      return new JsonModel($forReturn);
    } catch (ApplicationException $ex) {
      return $this->processApplicationError($ex);
    }
    return new JsonModel($forReturn);
  }
  public function OrderSalesSummaryAction()
  {
  //   $params = $this->getParams();
  //   $forReturn = [];
  //   try {
  //     $params = $this->getParams();
    
  //     $myorders = $this->orderRepository->fetchdelivered();
  //     $forReturn = ["error" => false, "message" => ""];
  //     $totalsales =0;
  //     foreach($myorders as $m){
  //       $totalsales +=r
  //     }
  //     return new JsonModel($forReturn);
  //   } catch (ApplicationException $ex) {
  //     return $this->processApplicationError($ex);
  //   }
  //   return new JsonModel($forReturn);
  // }
  }
}
