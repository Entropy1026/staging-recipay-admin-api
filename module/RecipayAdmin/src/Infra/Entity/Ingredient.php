<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_ingredients")
 */
class Ingredient
{
    /**
     * @ORM\Column(name="ingredients_id", type="integer")
     * @ORM\Id  
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\Column(name="recipe_id", type="integer")
     * @ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Recipe")
     * @JoinColumn(name="recipe_id", referencedColumnName="id")
     *@var Recipe
     */
    protected $recipe;
    /**
     * @var string
     * @ORM\Column(type="string", name="ingredients_name",length=255, nullable=false)
     */
    protected $name;

    /**
      * @ORM\Column(type="decimal", precision=4, scale=2 , name="ingredients_quantity")
     */
    protected $quantity;
    /**
     * @var string
     * @ORM\Column(type="string", name="ingredients_unit",length=255, nullable=false)
     */
    protected $unit;

    public function __construct($name ,$recipe,$quantity ,$unit)
    {
        $this->name = $name;
        $this->recipe = $recipe;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }


    /**
     * Get the value of quantity
     *
     * @return  string
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @param  string  $quantity
     *
     * @return  self
     */ 
    public function setQuantity(string $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get *@var Recipe
     */ 
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set *@var Recipe
     *
     * @return  self
     */ 
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

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
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of unit
     *
     * @return  string
     */ 
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set the value of unit
     *
     * @param  string  $unit
     *
     * @return  self
     */ 
    public function setUnit(string $unit)
    {
        $this->unit = $unit;

        return $this;
    }
}