<?php

namespace RecipayAdmin\Domain\Menu;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Menu;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\MenuQuery;

class MenuRepository extends BaseRepository {

    /**
     * 
     * @return MenuQuery
     */
    private function createQuery() {
        return new MenuQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function fetchAll()
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

    public function findbycuisine($id){
        $builder = $this->createQuery();
        $builder->findbycuisine($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }




}
