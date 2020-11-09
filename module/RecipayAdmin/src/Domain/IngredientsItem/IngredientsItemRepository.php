<?php

namespace RecipayAdmin\Domain\IngredientsItem;

use Application\Infra\Repository\BaseRepository;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\IngredientsItemQuery;

class IngredientsItemRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return IngredientsItemQuery
     */
    private function createQuery() {
        return new IngredientsItemQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchAll(){
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchunique(){
        $builder = $this->createQuery();
        $builder->fetchunique();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findbyid($id){
        $builder = $this->createQuery();
        $builder->findbyid($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function findbyname($name){
        $builder = $this->createQuery();
        $builder->findbyname($name);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
