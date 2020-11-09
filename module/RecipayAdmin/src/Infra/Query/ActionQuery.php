<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\ActionLog;
use Doctrine\ORM\QueryBuilder;

class ActionQuery {

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
        $qb->from(ActionLog::class, "a");
        $qb->addOrderBy("a.id","DESC");
        return $this;
    }
    public function lastloged($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("a.id", $qb->expr()->literal($id)));
        $qb->andWhere($qb->expr()->eq("a.action", $qb->expr()->literal("Logged-in")));
        return $this;
    }
  
}
