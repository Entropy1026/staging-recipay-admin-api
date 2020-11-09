<?php

namespace RecipayMobileOrder\Domain\Order;

use Application\Infra\Repository\BaseRepository;
use RecipayMobileOrder\Infra\Entity\Order;
use RecipayMobileOrder\Infra\Query\OrderQuery;

class OrderRepository extends BaseRepository {
    /**
     * 
     * @return OrderQuery
     */
    private function createQuery() {
        return new OrderQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchMyOrder($username){
        $builder = $this->createQuery();
        $builder->myOrder($username);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findBy($field,$data){
        $builder = $this->createQuery();
        $builder->findBy($field,$data);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findByUser($user,$id){
        $builder = $this->createQuery();
        $builder->findbyUser($user,$id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function fetchOrderByUser($id){
        $builder = $this->createQuery();
        $builder->existingOrders($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchOrderByCarrier($id){
        $builder = $this->createQuery();
        $builder->carrierdelivery($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchAllOrder(){
        $builder = $this->createQuery();
        $builder->ordersforconfirmation();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchpreparation(){
        $builder = $this->createQuery();
        $builder->ordersforpreparation();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function workOrders(){
        $builder = $this->createQuery();
        $builder->onproccessOrders();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchdelivered(){
        $builder = $this->createQuery();
        $builder->delivered();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    



}
