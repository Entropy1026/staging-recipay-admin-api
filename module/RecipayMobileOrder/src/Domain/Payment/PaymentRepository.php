<?php

namespace RecipayMobileOrder\Domain\Payment;

use Application\Infra\Repository\BaseRepository;
use RecipayMobileOrder\Infra\Entity\Payment;
use RecipayMobileOrder\Infra\Query\PaymentQuery;

class PaymentRepository extends BaseRepository {
    /**
     * 
     * @return PaymentQuery
     */
    private function createQuery() {
        return new PaymentQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchall(){
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchbyId($id){
        $builder = $this->createQuery();
        $builder->fetchbyId($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    
    



}
