<?php 

namespace RecipayIdentity\Infra\Query;

use RecipayIdentity\Infra\Entity\Billing;
use Doctrine\ORM\QueryBuilder;

class BillingQuery {

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
        $qb->select("b");
        $qb->from(Billing::class, "b");
        $qb->addOrderBy("b.id","ASC");
        return $this;
    }
    public function findbyid($id) {
        $this->select();
        $qb = $this->qb;
        $qb->add('where', $qb->expr()->orX(
        $qb->expr()->eq('b.id', ':id')));
        $qb->setParameter('id', $id);
        return $this;
    }
}
