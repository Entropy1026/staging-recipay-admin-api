<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_product")
 */
class Recipe  {

    /**
     * @ORM\Column(name="recipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="recipe_name",length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="recipe_image" , length=255, nullable=false)
     */
    protected $image;

    /**
     * @var string
     * @ORM\Column(type="string",name="recipe_instruction" , length=1000)
     */
    protected $textinstruction;

    /**
     * @ORM\Column(type="string", length=100, name="recipe_video" , nullable=true)
     * @var string
     */
    protected $recipevideo;
     /**
     * @ORM\Column(name="recipe_added", type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="string", length=100, name="recipe_category" , nullable=true)
     * @var string
     */
    protected $category;
    /**
     * @ORM\Column(name="recipe_price", type="integer")
     */
    protected $baseprice;
    /**
     * @ORM\Column(name="default_pax", type="integer")
     */
    protected $pax;
        /**
     * @ORM\Column(name="recipe_type", type="string" ,length=50)
     */
    protected $type;
    /**
     * @ORM\Column(name="product_sales", type="integer")
     */
    protected $sales_count;
    /**
     * @ORM\Column(name="product_available", type="integer")
     */
    protected $stock;
    /**
     * @ORM\Column(name="restock_amount", type="integer")
     */
    protected $restock;
    /**
     * @ORM\Column(name="replenish_amount", type="integer")
     */
    protected $replenish;
    /**
     * Get the value of id
     */ 
    public function __construct($name ,$image,$textinstruction ,$recipevideo,
    $date ,$category,$baseprice ,$pax,
    $type ,$stock,$restock ,$replenish,$sales_count)
    {
        $this->name = $name;
        $this->image = $image;
        $this->textinstruction = $textinstruction;
        $this->recipevideo = $recipevideo;
        $this->date = $date;
        $this->category = $category;
        $this->baseprice = $baseprice;
        $this->pax = $pax;
        $this->type = $type;
        $this->stock = $stock;
        $this->restock = $restock;
        $this->replenish = $replenish;
        $this->sales_count = $sales_count;  
    }
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
     * Get the value of pax
     */ 
    public function getPax()
    {
        return $this->pax;
    }

    /**
     * Set the value of pax
     *
     * @return  self
     */ 
    public function setPax($pax)
    {
        $this->pax = $pax;

        return $this;
    }

    /**
     * Get the value of baseprice
     */ 
    public function getBaseprice()
    {
        return $this->baseprice;
    }

    /**
     * Set the value of baseprice
     *
     * @return  self
     */ 
    public function setBaseprice($baseprice)
    {
        $this->baseprice = $baseprice;

        return $this;
    }

    /**
     * Get the value of recipevideo
     *
     * @return  string
     */ 
    public function getRecipevideo()
    {
        return $this->recipevideo;
    }

    /**
     * Set the value of recipevideo
     *
     * @param  string  $recipevideo
     *
     * @return  self
     */ 
    public function setRecipevideo(string $recipevideo)
    {
        $this->recipevideo = $recipevideo;

        return $this;
    }

    /**
     * Get the value of textinstruction
     *
     * @return  string
     */ 
    public function getTextinstruction()
    {
        return $this->textinstruction;
    }

    /**
     * Set the value of textinstruction
     *
     * @param  string  $textinstruction
     *
     * @return  self
     */ 
    public function setTextinstruction(string $textinstruction)
    {
        $this->textinstruction = $textinstruction;

        return $this;
    }

    /**
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage(string $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return  string
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  string  $category
     *
     * @return  self
     */ 
    public function setCategory(string $category)
    {
        $this->category = $category;

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
     * Get the value of sales_count
     */ 
    public function getSales_count()
    {
        return $this->sales_count;
    }

    /**
     * Set the value of sales_count
     *
     * @return  self
     */ 
    public function setSales_count($sales_count)
    {
        $this->sales_count = $sales_count;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of restock
     */ 
    public function getRestock()
    {
        return $this->restock;
    }

    /**
     * Set the value of restock
     *
     * @return  self
     */ 
    public function setRestock($restock)
    {
        $this->restock = $restock;

        return $this;
    }

    /**
     * Get the value of replenish
     */ 
    public function getReplenish()
    {
        return $this->replenish;
    }

    /**
     * Set the value of replenish
     *
     * @return  self
     */ 
    public function setReplenish($replenish)
    {
        $this->replenish = $replenish;
        return $this;
    }
}