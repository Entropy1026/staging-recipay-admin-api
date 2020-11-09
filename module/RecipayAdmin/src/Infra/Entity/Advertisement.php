<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_ads")
 */
class Advertisement
{
    /**
     * @ORM\Column(name="ads_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50, name="ad_name" , nullable=true)
     * @var string
     */
    protected $name;
    /**
     * @ORM\Column(type="string", length=255, name="ad_description" , nullable=true)
     * @var string
     */
    protected $description;
     /**
     * @ORM\Column(type="string", length=255, name="ad_file" , nullable=true)
     * @var string
     */
    protected $file;
     /**
     * @ORM\Column(type="string", length=50, name="ad_status" , nullable=true)
     * @var string
     */
    protected $status;
     /**
     * @ORM\Column(type="string", length=50, name="ad_url" , nullable=true)
     * @var string
     */
    protected $ad_url;
     /**
     * @ORM\Column(type="date",name="date_subscribed" , nullable=true)
     * @var string
     */
    protected $date_subscribed;

    public function __construct($name ,$description ,$fileurl,$status,$subbed)
    {
        $this->name = $name;
        $this->description  = $description;
        $this->file = $fileurl;
        $this->status = $status;
        $this->date_subscribed =$subbed;
        
    }
    public function getUrl()
    {
        return $this->ad_url;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */ 
    public function setUrl(string $ad_url)
    {
        $this->ad_url = $ad_url;

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
     * Get the value of file
     *
     * @return  string
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @param  string  $file
     *
     * @return  self
     */ 
    public function setFile(string $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  string
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  string  $status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of date_subscribed
     *
     * @return  string
     */ 
    public function getDate_subscribed()
    {
        return $this->date_subscribed;
    }

    /**
     * Set the value of date_subscribed
     *
     * @param  string  $date_subscribed
     *
     * @return  self
     */ 
    public function setDate_subscribed(string $date_subscribed)
    {
        $this->date_subscribed = $date_subscribed;

        return $this;
    }
}