<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use RecipayAdmin\Infra\Entity\CuisineTypes;
/**
 * @ORM\Entity
 * @ORM\Table(name="menu")
 */
class Menu
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
     * @ORM\ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\CuisineTypes")
     * @ORM\JoinColumn(name="cuisine_id", referencedColumnName="cuisine_id", nullable=false)
     * @var CuisineTypes
     */
    protected $cuisine_id;
     /**
     * @ORM\Column(type="string", length=1000, name="img_url" , nullable=true)
     * @var string
     */
    protected $image;


    public function __construct($name ,$description ,$cuisine, $pic)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $pic;
        $this->cuisine_id = $cuisine;

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
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }
 

    /**
     * Get the value of type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param  string  $type
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

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
     * Get the value of cuisine_id
     *
     * @return  CuisineTypes
     */ 
    public function getCuisine_id()
    {
        return $this->cuisine_id;
    }

    /**
     * Set the value of cuisine_id
     *
     * @param  CuisineTypes  $cuisine_id
     *
     * @return  self
     */ 
    public function setCuisine_id(CuisineTypes $cuisine_id)
    {
        $this->cuisine_id = $cuisine_id;

        return $this;
    }
}