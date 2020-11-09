<?php

namespace RecipayAdmin\Domain\Cuisine;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\CuisineTypes;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\CuisineQuery;

class CuisineRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return CuisineQuery
     */
    private function createQuery() {
        return new CuisineQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchAll(){
        $builder = $this->createQuery();
        $builder->select();
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

}
