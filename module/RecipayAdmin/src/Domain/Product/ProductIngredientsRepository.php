<?php

namespace RecipayAdmin\Domain\Product;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\ProductIngredients;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\ProductIngredientsQuery;

class ProductIngredientsRepository extends BaseRepository
{
    const CACHE_TIME = 86400;
    /**
     * 
     * @return ProductIngredientsQuery
     */
    private function createQuery()
    {
        return new ProductIngredientsQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function findall()
    {
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findbyid($id)
    {
        $builder = $this->createQuery();
        $builder->findbyid($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchbyproduct($id)
    {
        $builder = $this->createQuery();
        $builder->byProductId($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
