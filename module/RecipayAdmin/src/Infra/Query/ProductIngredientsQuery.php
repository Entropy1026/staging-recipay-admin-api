<?php

namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\ProductIngredients;
use Doctrine\ORM\QueryBuilder;

class ProductIngredientsQuery {

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
        $qb->from(ProductIngredients::class, "p");
        $qb->addOrderBy("p.id","ASC");
        return $this;
    }
    public function byProductId($id) {
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("p.product_id", $qb->expr()->literal($id)));
        return $this;
    }
    public function findbyid($id) {
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("p.id", $qb->expr()->literal($id)));
        return $this;
    }
    // 
}
