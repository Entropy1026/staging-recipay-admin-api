<?php

namespace RecipayAdmin\Domain\Ratings;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Ratings;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\RatingQuery;

class RatingRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return RatingQuery
     */
    private function createQuery() {
        return new RatingQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function findall(){
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchRatingById($product){
        $builder = $this->createQuery();
        $builder->ratingsById($product);
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
    public function findByUserIdAndProdId($id,$user){
        $builder = $this->createQuery();
        $builder->findByUserIdAndProdId($id,$user);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchratings(){
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function selectedratings($status){
        $builder = $this->createQuery();
        $builder->selectedratings($status);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
