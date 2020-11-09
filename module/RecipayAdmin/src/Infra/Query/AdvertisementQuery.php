<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Advertisement;
use Doctrine\ORM\QueryBuilder;

class AdvertisementQuery {

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
        $qb->select("a");
        $qb->from(Advertisement::class, "a");
        $qb->addOrderBy("a.id","ASC");
        return $this;
    }
    public function findbyid($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("a.id", $qb->expr()->literal($id)));
        // $qb->andWhere($qb->expr()->eq("a.type", $qb->expr()->literal("dispute")));
        return $this;
    }
  
}
