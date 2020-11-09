<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Menu;
use Doctrine\ORM\QueryBuilder;

class MenuQuery {

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
        $qb->select("m");
        $qb->from(Menu::class, "m");
        $qb->addOrderBy("m.name","ASC");
        return $this;
    }
    public function findbyid($id) {
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.id", $qb->expr()->literal($id)));
        return $this;
    }
    public function findbycuisine($id) {
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.cuisine_id", $qb->expr()->literal($id)));
        return $this;
    }

   
  
}
