<?php

namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Product;
use Doctrine\ORM\QueryBuilder;

class ProductQuery {

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
        $qb->select("r");
        $qb->from(Product::class, "r");
        $qb->addOrderBy("r.name","ASC");
        return $this;
    }
    public function sortById() {
        $qb = $this->qb;
        $qb->select("r");
        $qb->from(Product::class, "r");
        $qb->addOrderBy("r.id","ASC");
        return $this;
    }
    public function selectbyCategory($category) {
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("r.category", $qb->expr()->literal($category)));
        return $this;
    }
    public function fetchByMenu($menu) {
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("r.menu", $qb->expr()->literal($menu)));
        return $this;
    }
    public function selecyById($id) {
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("r.id", $qb->expr()->literal($id)));
        return $this;
    }
    public function RecentlyAdded($date){
        $this->select();
        $qb = $this->qb;
        $qb = $this->getQueryBuilder();
        $qb->where('r.date BETWEEN :n7days AND :today');
        $qb->setParameter('today', date('Y-m-d'));
        $qb->setParameter('n7days', $date);
    }
    public function mostSales() {
        $qb = $this->qb;
        $qb->select("r");
        $qb->from(Product::class, "r");
        $qb->addOrderBy("r.sales_count","DESC");
        $qb->setMaxResults(3);
        return $this;
    }
}
