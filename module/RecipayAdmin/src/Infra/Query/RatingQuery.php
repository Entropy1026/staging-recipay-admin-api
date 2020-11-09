<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Ratings;
use Doctrine\ORM\QueryBuilder;

class RatingQuery {

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
        $qb->from(Ratings::class, "r");
        $qb->addOrderBy("r.id","ASC");
        return $this;
    }
    public function ratingsById($product){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("r.recipe", $qb->expr()->literal($product)));
        return $this;
    }
    public function findbyid($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("r.id", $qb->expr()->literal($id)));
        return $this;
    }
    public function findByUserIdAndProdId($id,$user){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("r.user", $qb->expr()->literal($user)));
        $qb->andWhere($qb->expr()->eq("r.recipe", $qb->expr()->literal($id)));
        return $this;
    }
    public function selectedratings($status){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("r.status", $qb->expr()->literal($status)));
        return $this;
    }
    
  
}
