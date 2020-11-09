<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_rating")
 */
class Ratings
{
    /**
     * @ORM\Column(name="ratings_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ManyToOne(targetEntity="RecipayAdmin\Infra\Entity\Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     *@var Product
     */
    private $recipe;
    /**
     * @ORM\Column(name="user", type="integer")
     * @ManyToOne(targetEntity="RecipayIdentity\Infra\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var User
     */
    private $user;
    /**
     * @ORM\Column(name="comment", type="integer")
     * @ORM\Column(type="string", length=100, name="ratings_comment" , nullable=true)
     * @var string
     */
    protected $comment;

    /**
     * @ORM\Column(name="ratings_score", type="integer")
     */
    protected $rating;
    /**
     * @ORM\Column(name="rating_date", type="date")
     */
    protected $date;
    /**
     * @ORM\Column(name="rating_status", type="string",length=50)
     */
    protected $status;

    public function __construct($user ,$recipe , $comment ,$rating ,$date ,$status)
    {   
        $this->user = $user;
        $this->recipe = $recipe;
        $this->comment = $comment;
        $this->rating = $rating;
        $this->date = $date;
        $this->status = 'unread';
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of comment
     *
     * @return  string
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @param  string  $comment
     *
     * @return  self
     */ 
    public function setComment(string $comment)
    {
        $this->comment = $comment;

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
     * Get the value of recipe
     */ 
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set the value of recipe
     *
     * @return  self
     */ 
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

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
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}