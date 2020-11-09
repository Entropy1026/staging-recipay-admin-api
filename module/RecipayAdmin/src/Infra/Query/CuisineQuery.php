<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\CuisineTypes;
use Doctrine\ORM\QueryBuilder;

class CuisineQuery {

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
        $qb->from(CuisineTypes::class, "c");
        $qb->addOrderBy("c.name","ASC");
        return $this;
    }
    public function findbyid($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.id", $qb->expr()->literal($id)));
        return $this;
    }
  
}
