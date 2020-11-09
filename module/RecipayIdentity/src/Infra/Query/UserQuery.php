<?php 

namespace RecipayIdentity\Infra\Query;

use RecipayIdentity\Infra\Entity\User;
use Doctrine\ORM\QueryBuilder;

class UserQuery {

    private $qb;

    function __construct(QueryBuilder $qb) {
        $this->qb = $qb;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder() {
        return $this->qb;
    }
    public function select() {
        $qb = $this->qb;
        $qb->select("u");
        $qb->from(User::class, "u");
        $qb->addOrderBy("u.fname","DESC");
        return $this;
    }
    public function findbyUsername($username) {
        $this->select();
        $qb = $this->qb;
        $qb->add('where', $qb->expr()->orX(
        $qb->expr()->eq('u.user_username', ':username')));
        $qb->setParameter('username', $username);
        return $this;
    }
    public function findbyid($id) {
        $this->select();
        $qb = $this->qb;
        $qb->add('where', $qb->expr()->orX(
        $qb->expr()->eq('u.id', ':id')));
        $qb->setParameter('id', $id);
        return $this;
    }
   public function checkLogin($username,$password){
    $qb = $this->qb;
        $qb->select("u");
        $qb->from(User::class, "u");
    $qb->andWhere($qb->expr()->eq("u.user_username", $qb->expr()->literal($username)));
    $qb->andWhere($qb->expr()->eq("u.user_password", $qb->expr()->literal($password)));
    return $this;
   }
   public function getcarrier(){ 
    $this->select();
    $qb = $this->qb;
    $qb->andWhere($qb->expr()->eq("u.user_type", $qb->expr()->literal('carrier')));
    $qb->andWhere($qb->expr()->eq("u.user_status", $qb->expr()->literal('available')));
    // $qb->andWhere($qb->expr()->neq("u.status", $qb->expr()->literal('suspended')));

    return $this;
   }
}
