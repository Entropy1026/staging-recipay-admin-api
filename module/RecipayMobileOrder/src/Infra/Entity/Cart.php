<?php
namespace RecipayMobileOrder\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_cart")
 */
class Cart
{
    /**
     * @ORM\Column(name="cart_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     * @var Product
     */
    private $product_id;
    /**
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $order_id;
    /**
     * @ORM\Column(name="user_id", type="integer")
     * @ManyToOne(targetEntity="RecipayIdentity\Infra\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user_id;
     /**
     * @ORM\Column(name="item_quantity", type="integer")
     */
    private $quantity;
    public function __construct($product_id ,$user_id ,$quantity)
    {
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->quantity = $quantity;
    }
    /**
     * Get the value of product_id
     *
     * @return  Product
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @param  Product  $product_id
     *
     * @return  self
     */ 
    public function setProduct_id(Product $product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of user_id
     *
     * @return  User
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param  User  $user_id
     *
     * @return  self
     */ 
    public function setUser_id(User $user_id)
    {
        $this->user_id = $user_id;

        return $this;
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
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

  

    /**
     * Get the value of order_id
     */ 
    public function getOrder_id()
    {
        return $this->order_id;
    }

    /**
     * Set the value of order_id
     *
     * @return  self
     */ 
    public function setOrder_id($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }
}