<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ingredients_item")
 */
class IngredientsItem
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, name="name" , nullable=true)
     * @var string
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=1000, name="description" , nullable=true)
     * @var string
     */
    protected $description;
    /**
     * @ORM\Column(type="string", length=1000, name="image" , nullable=true)
     * @var string
     */
    protected $image;
        /**
     * @ORM\Column(type="date",name="date_added" , nullable=true)
     * @var string
     */
    protected $date_added;
      /**
     * @ORM\Column(name="is_exist", type="integer")
     */
    protected $is_exist;
     /**
     * @ORM\Column(name="shelf_life", type="integer")
     */
    protected $shelf_life;
     /**
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;
      /**
     * @ORM\Column(name="available", type="integer")
     */
    protected $available;
    /**
     * @ORM\Column(type="string", length=50, name="unit" , nullable=true)
     * @var string
     */
    protected $unit;

    public function __construct($name ,$description , $image ,$date , $unique , $shelf, $quantity ,$available ,$unit)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->date_added = $date;
        $this->is_exist = $unique;
        $this->shelf_life = $shelf;
        $this->quantity = $quantity;
        $this->available = $available;
        $this->unit = $unit;
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
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;

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

    public function getDate_added()
    {
        return $this->date_added;
    }

    public function setDate_added(string $date_added)
    {
        $this->date_added = $date_added;

        return $this;
    }

    public function getShelf_life()
    {
        return $this->shelf_life;
    }
    public function setShelf_life($shelf_life)
    {
        $this->shelf_life = $shelf_life;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
    public function getUnit()
    {
        return $this->unit;
    }
    public function setUnit(string $unit)
    {
        $this->unit = $unit;

        return $this;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }
    public function getIs_exist()
    {
        return $this->is_exist;
    }
    public function setIs_exist($is_exist)
    {
        $this->is_exist = $is_exist;

        return $this;
    }
}