<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cuisine_types")
 */
class CuisineTypes
{
    /**
     * @ORM\Column(name="cuisine_id", type="integer")
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
   

    public function __construct($name ,$description , $image)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getId()
    {
        return $this->id;
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
}
