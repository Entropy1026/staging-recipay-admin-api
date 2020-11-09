<?php

namespace RecipayAdmin\Domain\Ingredient;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Ingredient;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\IngredientQuery;

class IngredientRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return IngredientQuery
     */
    private function createQuery() {
        return new IngredientQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchIngredientById($product){
        $builder = $this->createQuery();
        $builder->ingredientsById($product);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findbyId($product){
        $builder = $this->createQuery();
        $builder->findbyId($product);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
