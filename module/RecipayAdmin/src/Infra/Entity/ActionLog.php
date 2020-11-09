<?php
namespace RecipayAdmin\Infra\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * @ORM\Entity
 * @ORM\Table(name="user_actions")
 */
class ActionLog
{
    /**
     * @ORM\Column(name="action_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer", name="user_id" , nullable=false)
     * @var string
     */
    protected $user;
    /**
     * @ORM\Column(type="string", length=50, name="action_performed" , nullable=true)
     * @var string
     */
    protected $action;
    /**
     * @ORM\Column(type="integer", name="user_affected" , nullable=true)
     * @var string
     */
    protected $user_affected;
    /**
     * @ORM\Column(type="date", name="action_date" , nullable=false )
     * @var string
     */
    protected $date;


    /**
     * Get the value of user_affected
     *
     * @return  string
     */ 
    public function getUser_affected()
    {
        return $this->user_affected;
    }

    /**
     * Set the value of user_affected
     *
     * @param  string  $user_affected
     *
     * @return  self
     */ 
    public function setUser_affected(string $user_affected)
    {
        $this->user_affected = $user_affected;

        return $this;
    }

    /**
     * Get the value of action
     *
     * @return  string
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @param  string  $action
     *
     * @return  self
     */ 
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  string
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  string  $user
     *
     * @return  self
     */ 
    public function setUser(string $user)
    {
        $this->user = $user;

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
}