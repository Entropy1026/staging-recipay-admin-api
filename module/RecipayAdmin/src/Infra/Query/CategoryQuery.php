<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Category;
use Doctrine\ORM\QueryBuilder;

class CategoryQuery {

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
        $qb->from(Category::class, "c");
        $qb->addOrderBy("c.name","ASC");
        return $this;
    }
    public function categorylist(){
        $this->select();
        $qb = $this->qb;
        return $this;
    }
    public function findbyid($id) {
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.id", $qb->expr()->literal($id)));
        return $this;
    }
    public function findbytype($type) {
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("c.type", $qb->expr()->literal($type)));
        return $this;
    }
  
}
