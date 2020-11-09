<?php
namespace RecipayMobileOrder\Infra\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_order")
 */
class Order
{
    /**
     * @ORM\Column(name="order_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\Column(name="order_date", type="date")
     */
    private $date;
    /**
     * @ORM\Column(name="billing_id", type="integer",nullable=true)
     */
    private $billing_id;
    /**
     * @ORM\Column(type="datetime",name="order_datetime" , nullable=true)
     */
    protected $deliverydate;
    /**
     * @ORM\Column(type="integer",name="payment_id")
     */
    protected $payment_type;
    /**
     * @ORM\Column(name="order_status", type="string" ,length=50)
     */
    protected $order_status;
    /**
     * @ORM\Column(name="user_id", type="integer")
     * @ManyToOne(targetEntity="RecipayIdentity\Infra\Entity\User")
     * @JoinColumn(name="id", referencedColumnName="id")
     * @var User
     */
    private $user;
    /**
     * @ORM\Column(name="deliverer_id", type="integer",nullable=true)
     */
    private $carrier;
    /**
     * @ORM\Column(type="datetime",name="order_delivered" , nullable=true)
     */
    protected $delivered;
    public function __construct($order_status,$user,$ddp)
    {
        $this->date = new \DateTime();
        $this->order_status = $order_status;
        // $this->deliverydate = new \DateTime('Y-m-d h:i:s',$dateofdelivery);
        $this->user = $user;
        $ddp =  date_create($ddp);
        $date = date_format($ddp,"Y-m-d H:i:s");
        $this->deliverydate = new \DateTime($date);
        // $this->payment_type = $payment_type;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
    /**
     * Get the value of deliverydate
     */ 
    public function getDeliverydate()
    {
        return $this->deliverydate;
    }

    /**
     * Set the value of deliverydate
     *
     * @return  self
     */ 
    public function setDeliverydate($deliverydate)
    {
        $this->deliverydate = $deliverydate;

        return $this;
    }


    /**
     * Get the value of order_status
     */ 
    public function getOrder_status()
    {
        return $this->order_status;
    }

    /**
     * Set the value of order_status
     *
     * @return  self
     */ 
    public function setOrder_status($order_status)
    {
        $this->order_status = $order_status;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  User  $user
     *
     * @return  self
     */ 
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of payment_type
     */ 
    public function getPayment_type()
    {
        return $this->payment_type;
    }

    /**
     * Set the value of payment_type
     *
     * @return  self
     */ 
    public function setPayment_type($payment_type)
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    /**
     * Get the value of billing_id
     */ 
    public function getBilling_id()
    {
        return $this->billing_id;
    }

    /**
     * Set the value of billing_id
     *
     * @return  self
     */ 
    public function setBilling_id($billing_id)
    {
        $this->billing_id = $billing_id;

        return $this;
    }

    /**
     * Get the value of carrier
     */ 
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set the value of carrier
     *
     * @return  self
     */ 
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get the value of delivered
     */ 
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Set the value of delivered
     *
     * @return  self
     */ 
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }
}