<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="recipay_messages")
 */
class Messages
{
    /**
     * @ORM\Column(name="message_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50, name="message_from" , nullable=true)
     * @var string
     */
    protected $from;
    /**
     * @ORM\Column(type="string", length=50, name="message_to" , nullable=true)
     * @var string
     */
    protected $to;
    /**
     * @ORM\Column(type="string", length=200, name="message_attachment" , nullable=true)
     * @var string
     */
    protected $attachment;
    /**
     * @ORM\Column(type="string", length=500, name="message" , nullable=true)
     * @var string
     */
    protected $message;
    /**
     * @ORM\Column(type="date", name="message_date" , nullable=true)
     * @var string
     */
    protected $date;
    /**
     * @ORM\Column(type="string", length=50, name="message_status" , nullable=true)
     * @var string
     */
    protected $status;
    /**
     * @ORM\Column(type="string", length=50, name="message_type" , nullable=true)
     * @var string
     */
    protected $type;
     /**
     * @ORM\Column(type="string", length=50, name="recipe_id" , nullable=true)
     * @var string
     */
    private $recipe;
     
    public function __construct($from ,$to,$attachment ,$message,$date,$status,$type,$recipe)
    {
        $this->from = $from;
        $this->to = $to;
        $this->attachment = $attachment;
        $this->message = $message;
        $this->date = $date;
        $this->status = $status;
        $this->type = $type;
        $this->recipe = $recipe;
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
     * Get the value of from
     *
     * @return  string
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @param  string  $from
     *
     * @return  self
     */ 
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of to
     *
     * @return  string
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @param  string  $to
     *
     * @return  self
     */ 
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string  $message
     *
     * @return  self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of date
     *
     * @return  string
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param  string  $date
     *
     * @return  self
     */ 
    public function setDate(string $date)
    {
        $this->date = $date;

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
     * Get the value of attachment
     *
     * @return  string
     */ 
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set the value of attachment
     *
     * @param  string  $attachment
     *
     * @return  self
     */ 
    public function setAttachment(string $attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get *@var Recipe
     */ 
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set *@var Recipe
     *
     * @return  self
     */ 
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }
}