<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
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
     * @ORM\Column(type="string", length=1000, name="image_url" , nullable=true)
     * @var string
     */
    protected $pic_url;

    public function __construct($name ,$pic_url)
    {   
        $this->name = $name;
        $this->pic_url = $pic_url;
    }
   

    /**
     * Get the value of pic_url
     *
     * @return  string
     */ 
    public function getPic_url()
    {
        return $this->pic_url;
    }

    /**
     * Set the value of pic_url
     *
     * @param  string  $pic_url
     *
     * @return  self
     */ 
    public function setPic_url(string $pic_url)
    {
        $this->pic_url = $pic_url;

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
}