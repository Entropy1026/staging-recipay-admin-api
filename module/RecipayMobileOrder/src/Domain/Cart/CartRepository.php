<?php

namespace RecipayMobileOrder\Domain\Cart;

use Application\Infra\Repository\BaseRepository;
use RecipayMobileOrder\Infra\Entity\Cart;
use RecipayMobileOrder\Infra\Query\CartQuery;

class CartRepository extends BaseRepository {
    /**
     * 
     * @return CartQuery
     */
    private function createQuery() {
        return new CartQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function findBy($field,$id){
        $builder = $this->createQuery();
        $builder->findby($field,$id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }
    public function findById($field,$id){
        $builder = $this->createQuery();
        $builder->findby($field,$id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchMyCart($id){
        $builder = $this->createQuery();
        $builder->myCart($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchOrderItems($id){
        $builder = $this->createQuery();
        $builder->getmyorders($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    



}
