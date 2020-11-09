<?php

namespace RecipayAdmin\Domain\Category;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Category;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\CategoryQuery;

class CategoryRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return CategoryQuery
     */
    private function createQuery() {
        return new CategoryQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchAll(){
        $builder = $this->createQuery();
        $builder->categorylist();
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
