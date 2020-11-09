<?php
namespace RecipayMobileOrder\Infra\Query;

use RecipayMobileOrder\Infra\Entity\Payment;
use Doctrine\ORM\QueryBuilder;

class PaymentQuery {

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
        $qb->select("p");
        $qb->from(Payment::class, "p");
        $qb->addOrderBy("p.id","ASC");
        return $this;
    }
    public function fetchbyId($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("p.id", $qb->expr()->literal($id)));
        return $this;
    }
   
}
