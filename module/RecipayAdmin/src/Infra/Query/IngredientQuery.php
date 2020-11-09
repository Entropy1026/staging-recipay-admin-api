<?php
namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Ingredient;
use Doctrine\ORM\QueryBuilder;

class IngredientQuery {

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
        $qb->from(Ingredient::class, "i");
        $qb->addOrderBy("i.id","ASC");
        return $this;
    }
    public function ingredientsById($product){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("i.recipe", $qb->expr()->literal($product)));
        return $this;
    }
    public function findbyId($id){
        $this->select();
        $qb = $this->qb;
        $qb->andWhere($qb->expr()->eq("i.id", $qb->expr()->literal($id)));
        return $this;
    }
  
}
