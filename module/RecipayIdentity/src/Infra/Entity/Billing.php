<?php
namespace RecipayIdentity\Infra\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_billing")
 */
class Billing  {

    /**
     * @ORM\Column(name="billing_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\Column(name="user_id", type="integer")
     * @ManyToOne(targetEntity="RecipayIdentity\Infra\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     *@var User
     */
    protected $user; 
    /**
     * @var string
     * @ORM\Column(type="string", name="billing_address",length=255, nullable=false)
     */
    protected $address;
     
     /**
     * @var string
     * @ORM\Column(type="string", name="billing_city",length=50, nullable=false)
     */
    protected $city;
     /**
     * @var string
     * @ORM\Column(type="string", name="billing_region",length=50, nullable=false)
     */
    protected $region;
    /**
     * @var string
     * @ORM\Column(type="string", name="postal_code",length=50, nullable=false)
     */
    protected $postal;
     /**
     * @var string
     * @ORM\Column(type="string", name="billing_country",length=50, nullable=false)
     */
    protected $country;
     /**
     * @var string
     * @ORM\Column(type="string", name="contact_number",length=50, nullable=false)
     */
    protected $mobile;
     

    /**
     * Get the value of address
     *
     * @return  string
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string  $address
     *
     * @return  self
     */ 
    public function setAddress(string $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of city
     *
     * @return  string
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @param  string  $city
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of region
     *
     * @return  string
     */ 
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @param  string  $region
     *
     * @return  self
     */ 
    public function setRegion(string $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the value of postal
     *
     * @return  string
     */ 
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set the value of postal
     *
     * @param  string  $postal
     *
     * @return  self
     */ 
    public function setPostal(string $postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get the value of country
     *
     * @return  string
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @param  string  $country
     *
     * @return  self
     */ 
    public function setCountry(string $country)
    {
        $this->country = $country;

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
    public function __construct($address,$city,$user,$mobile)
    {
       $this->user= $user;
       $this->address = $address;
       $this->city = $city;
       $this->country = "Philippines";
       $this->postal = "6000";
       $this->region = "Visayas Region 7";
       $this->mobile = $mobile;
    }

    /**
     * Get *@var User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set *@var User
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of mobile
     *
     * @return  string
     */ 
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set the value of mobile
     *
     * @param  string  $mobile
     *
     * @return  self
     */ 
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}