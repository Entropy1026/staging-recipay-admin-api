<?php
namespace RecipayMobileOrder\Infra\Query;

use RecipayMobileOrder\Infra\Entity\Cart;
use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\Constraint\IsNull;

class CartQuery {

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
        $qb->select("c");
        $qb->from(Cart::class, "c");
        $qb->addOrderBy("c.id","ASC");
        return $this;
    }
    public function myCart($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.user_id", $qb->expr()->literal($id)));
        $qb->andWhere($qb->expr()->isNull("c.order_id"));
        return $this;
    }
    public function findby($field,$id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.$field", $qb->expr()->literal($id)));
        return $this;
    }
    public function getmyorders($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.user_id", $qb->expr()->literal($id)));
        $qb->andWhere($qb->expr()->isNull("c.order_id"));
        return $this;
       }
       

  
}
