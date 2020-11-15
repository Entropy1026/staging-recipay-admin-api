<?php

namespace RecipayAdmin\Domain\Product;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Product;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\ProductQuery;

class ProductRepository extends BaseRepository
{
     const CACHE_TIME = 86400;
    /**
     * 
     * @return ProductQuery
     */
    private function createQuery()
    {
        return new ProductQuery($this->getEntityManager()->createQueryBuilder());
    }

    public function fetchbyCategory($category)
    {
        $builder = $this->createQuery();
        $builder->selectbyCategory($category);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchByMenu($menu_id)
    {
        $builder = $this->createQuery();
        if($menu_id){
        $builder->fetchByMenu($menu_id);
        }
        else{
        $builder->select();  
        }
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findall()
    {
        $builder = $this->createQuery();
        $builder->sortById();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchById($id)
    {
        $builder = $this->createQuery();
        $builder->selecyById($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function fetchRecentlyAdded($date)
    {
        $builder = $this->createQuery();
        $builder->recentlyAdded($date);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchPopular()
    {
        $builder = $this->createQuery();
        $builder->mostSales();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
