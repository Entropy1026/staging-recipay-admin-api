<?php
namespace RecipayAdmin\Infra\Entity;

use RecipayAdmin\Infra\Entity\Menu;
use RecipayAdmin\Infra\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product  {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name",length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="image_url" , length=255, nullable=false)
     */
    protected $image;

    /**
     * @var string
     * @ORM\Column(type="string",name="instruction" , length=1000)
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
     * @ORM\ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Menu")
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id", nullable=false)
     * @var Menu
     */
    private $menu;
     /**
     * @ORM\ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     * @var Category
     */
    private $category;
    /**
     * @ORM\Column(name="recipe_price", type="integer")
     */
    protected $baseprice;
    /**
     * @ORM\Column(name="default_pax", type="integer")
     */
    protected $pax;
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

    public function __construct($name ,$image,$textinstruction ,$recipevideo,
    $date ,$menu , $category, $baseprice ,$pax,$stock,$restock ,$replenish,$sales_count)
    {
        $this->name = $name;
        $this->image = $image;
        $this->textinstruction = $textinstruction;
        $this->recipevideo = $recipevideo;
        $this->date = $date;
        $this->menu =$menu;
        $this->category = $category;
        $this->baseprice = $baseprice;
        $this->pax = $pax;
        $this->stock = $stock;
        $this->restock = $restock;
        $this->replenish = $replenish;
        $this->sales_count = $sales_count;  
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;

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
    public function getImage()
    {
        return $this->image;
    }
    public function setImage(string $image)
    {
        $this->image = $image;

        return $this;
    }
    public function getTextinstruction()
    {
        return $this->textinstruction;
    }
    public function setTextinstruction(string $textinstruction)
    {
        $this->textinstruction = $textinstruction;

        return $this;
    }
    public function getRecipevideo()
    {
        return $this->recipevideo;
    }

    public function setRecipevideo(string $recipevideo)
    {
        $this->recipevideo = $recipevideo;

        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of menu
     *
     * @return  Menu
     */ 
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set the value of menu
     *
     * @param  Menu  $menu
     *
     * @return  self
     */ 
    public function setMenu(Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return  Category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  Category  $category
     *
     * @return  self
     */ 
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }
    public function getBaseprice()
    {
        return $this->baseprice;
    }
    public function setBaseprice($baseprice)
    {
        $this->baseprice = $baseprice;

        return $this;
    }
    public function getPax()
    {
        return $this->pax;
    }
    public function setPax($pax)
    {
        $this->pax = $pax;

        return $this;
    }
    public function getSales_count()
    {
        return $this->sales_count;
    }
    public function setSales_count($sales_count)
    {
        $this->sales_count = $sales_count;

        return $this;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
    public function getRestock()
    {
        return $this->restock;
    }
    public function setRestock($restock)
    {
        $this->restock = $restock;

        return $this;
    }
    public function getReplenish()
    {
        return $this->replenish;
    }

    public function setReplenish($replenish)
    {
        $this->replenish = $replenish;

        return $this;
    }
}