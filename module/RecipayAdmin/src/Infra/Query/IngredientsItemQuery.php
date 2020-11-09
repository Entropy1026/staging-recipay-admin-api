<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\IngredientsItem;
use Doctrine\ORM\QueryBuilder;

class IngredientsItemQuery {

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
        $qb->select("i");
        $qb->from(IngredientsItem::class, "i");
        $qb->addOrderBy("i.name","ASC");
        return $this;
    }
    public function findbyid($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("i.id", $qb->expr()->literal($id)));
        return $this;
    }
    public function fetchunique(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("i.is_exist", $qb->expr()->literal(0)));
        return $this;
    }
    public function findbyname($name){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("i.name", $qb->expr()->literal($name)));
        return $this;
    }
}
