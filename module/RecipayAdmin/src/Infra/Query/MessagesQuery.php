<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Messages;
use Doctrine\ORM\QueryBuilder;

class MessagesQuery {

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
        $qb->from(Messages::class, "m");
        $qb->addOrderBy("m.id","ASC");
        return $this;
    }
    public function fetchselected($status){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.status", $qb->expr()->literal($status)));
        $qb->andWhere($qb->expr()->eq("m.to", $qb->expr()->literal("admin")));
        $qb->andWhere($qb->expr()->eq("m.type", $qb->expr()->literal("dispute")));
        return $this;
    }
    public function fetchall(){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.to", $qb->expr()->literal("admin")));
        $qb->andWhere($qb->expr()->eq("m.type", $qb->expr()->literal("dispute")));
        return $this;
    }
    public function selectById($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.id", $qb->expr()->literal($id)));
        // $qb->andWhere($qb->expr()->eq("a.type", $qb->expr()->literal("dispute")));
        return $this;
    }
    public function getUserMessages($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.to", $qb->expr()->literal($id)));
        $qb->orWhere("m.from = $id");
        return $this;
    }
    public function selectByOrder($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("m.recipe", $qb->expr()->literal($id)));
        $qb->andWhere($qb->expr()->eq("m.status", $qb->expr()->literal("unresolve")));
        return $this;
    }
  
}
