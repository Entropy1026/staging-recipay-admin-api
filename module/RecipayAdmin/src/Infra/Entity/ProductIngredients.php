<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use RecipayAdmin\Infra\Entity\CuisineTypes;
/**
 * @ORM\Entity
 * @ORM\Table(name="product_ingredients")
 */
class ProductIngredients
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
     * @var Product
     */
    protected $product_id;
      /**
     * @ORM\ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\IngredientsItem")
     * @ORM\JoinColumn(name="ingredients_id", referencedColumnName="id", nullable=false)
     * @var IngredientsItem
     */
    protected $ingredients_id;
     /**
     * @ORM\Column(type="decimal", precision=4, scale=2 ,name="quantity" , nullable=false)
     * @var string
     */
    protected $quantity;


    public function __construct($product ,$ingredients ,$quantity)
    {
        $this->product_id = $product;
        $this->ingredients_id = $ingredients;
        $this->quantity = $quantity;
    }


    /**
     * Get the value of ingredients_id
     *
     * @return  IngredientsItem
     */ 
    public function getIngredients_id()
    {
        return $this->ingredients_id;
    }

    /**
     * Set the value of ingredients_id
     *
     * @param  IngredientsItem  $ingredients_id
     *
     * @return  self
     */ 
    public function setIngredients_id(IngredientsItem $ingredients_id)
    {
        $this->ingredients_id = $ingredients_id;

        return $this;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity(string $quantity)
    {
        $this->quantity = $quantity;

        return $this;
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
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}