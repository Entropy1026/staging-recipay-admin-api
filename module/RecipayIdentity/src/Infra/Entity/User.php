<?php
namespace RecipayIdentity\Infra\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_users")
 */
class User  {

    /**
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_fname",length=255, nullable=false)
     */
    protected $fname;

     /**
     * @var string
     * @ORM\Column(type="string", name="user_lname",length=50, nullable=false)
     */
    protected $lname;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_mname",length=50, nullable=false)
     */
    protected $mname;
    /**
     * @var string
     * @ORM\Column(type="string", name="user_username",length=50, nullable=true)
     */
    protected $user_username;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_password",length=50, nullable=false)
     */
    protected $user_password;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_type",length=50, nullable=false)
     */
    protected $user_type;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_email",length=50, nullable=false)
     */
    protected $user_email;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_mobile",length=20, nullable=true)
     */
    protected $contact;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_image",length=1000, nullable=true)
     */
    protected $user_image;
     /**
     * @var string
     * @ORM\Column(type="string", name="permanent_address",length=100, nullable=true)
     */
    protected $permanent_address;
    /**
     * @var string
     * @ORM\Column(type="string", name="address",length=100, nullable=true)
     */
    protected $address;
     /**
     * @var string
     * @ORM\Column(type="string", name="user_status",length=50, nullable=false)
     */
    protected $user_status;
    /**
     * @var string
     * @ORM\Column(type="date", name="user_joined")
     */
    protected $user_joined;
    

    public function __construct($user_username ,$fname ,$mname
    ,$lname,$user_email,$contact,$user_type,$user_status,$user_password,$today
    )
    {
        $this->user_username = $user_username;
        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->user_email = $user_email;
        $this->contact = $contact;
        $this->user_type = $user_type;
        $this->user_status = $user_status;
        $this->user_password = $user_password;
        $this->user_joined = $today;
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
     * Get the value of fname
     *
     * @return  string
     */ 
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set the value of fname
     *
     * @param  string  $fname
     *
     * @return  self
     */ 
    public function setFname(string $fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get the value of lname
     *
     * @return  string
     */ 
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set the value of lname
     *
     * @param  string  $lname
     *
     * @return  self
     */ 
    public function setLname(string $lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get the value of mname
     *
     * @return  string
     */ 
    public function getMname()
    {
        return $this->mname;
    }

    /**
     * Set the value of mname
     *
     * @param  string  $mname
     *
     * @return  self
     */ 
    public function setMname(string $mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get the value of user_username
     *
     * @return  string
     */ 
    public function getUser_username()
    {
        return $this->user_username;
    }

    /**
     * Set the value of user_username
     *
     * @param  string  $user_username
     *
     * @return  self
     */ 
    public function setUser_username(string $user_username)
    {
        $this->user_username = $user_username;

        return $this;
    }

    /**
     * Get the value of user_password
     *
     * @return  string
     */ 
    public function getUser_password()
    {
        return $this->user_password;
    }

    /**
     * Set the value of user_password
     *
     * @param  string  $user_password
     *
     * @return  self
     */ 
    public function setUser_password(string $user_password)
    {
        $this->user_password = $user_password;

        return $this;
    }

    /**
     * Get the value of user_type
     *
     * @return  string
     */ 
    public function getUser_type()
    {
        return $this->user_type;
    }

    /**
     * Set the value of user_type
     *
     * @param  string  $user_type
     *
     * @return  self
     */ 
    public function setUser_type(string $user_type)
    {
        $this->user_type = $user_type;

        return $this;
    }

    /**
     * Get the value of user_email
     *
     * @return  string
     */ 
    public function getUser_email()
    {
        return $this->user_email;
    }

    /**
     * Set the value of user_email
     *
     * @param  string  $user_email
     *
     * @return  self
     */ 
    public function setUser_email(string $user_email)
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * Get the value of user_image
     *
     * @return  string
     */ 
    public function getUser_image()
    {
        return $this->user_image;
    }

    /**
     * Set the value of user_image
     *
     * @param  string  $user_image
     *
     * @return  self
     */ 
    public function setUser_image(string $user_image)
    {
        $this->user_image = $user_image;

        return $this;
    }

    /**
     * Get the value of contact
     *
     * @return  string
     */ 
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set the value of contact
     *
     * @param  string  $contact
     *
     * @return  self
     */ 
    public function setContact(string $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get the value of user_status
     *
     * @return  string
     */ 
    public function getUser_status()
    {
        return $this->user_status;
    }

    /**
     * Set the value of user_status
     *
     * @param  string  $user_status
     *
     * @return  self
     */ 
    public function setUser_status(string $user_status)
    {
        $this->user_status = $user_status;

        return $this;
    }

    /**
     * Get the value of user_joined
     *
     * @return  string
     */ 
    public function getUser_joined()
    {
        return $this->user_joined;
    }

    /**
     * Set the value of user_joined
     *
     * @param  string  $user_joined
     *
     * @return  self
     */ 
    public function setUser_joined(string $user_joined)
    {
        $this->user_joined = $user_joined;

        return $this;
    }

    /**
     * Get the value of permanent_address
     *
     * @return  string
     */ 
    public function getPermanent_address()
    {
        return $this->permanent_address;
    }

    /**
     * Set the value of permanent_address
     *
     * @param  string  $permanent_address
     *
     * @return  self
     */ 
    public function setPermanent_address(string $permanent_address)
    {
        $this->permanent_address = $permanent_address;

        return $this;
    }

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
}