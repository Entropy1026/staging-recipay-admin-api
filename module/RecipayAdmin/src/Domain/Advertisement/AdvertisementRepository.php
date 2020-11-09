<?php

namespace RecipayAdmin\Domain\Advertisement;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Advertisement;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\AdvertisementQuery;

class AdvertisementRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return AdvertisementQuery
     */
    private function createQuery() {
        return new AdvertisementQuery($this->getEntityManager()->createQueryBuilder());
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
