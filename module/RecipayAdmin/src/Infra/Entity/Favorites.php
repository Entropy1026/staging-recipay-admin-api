<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_favorite")
 */
class Favorites
{
    /**
     * @ORM\Column(name="favorite_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="product_id", type="integer")
     * @ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     * @var Product
     */
    private $product_id;
    /**
     * @ORM\Column(name="user_id", type="integer")
     * @ManyToOne(targetEntity="RecipayIdentity\Infra\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user_id;
    
    public function __construct($user_id,$product_id)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
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
}