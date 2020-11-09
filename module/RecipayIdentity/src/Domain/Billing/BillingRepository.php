<?php

namespace RecipayIdentity\Domain\Billing;

use Application\Infra\Repository\BaseRepository;
use RecipayIdentity\Infra\Entity\Billing;
use RecipayIdentity\Infra\Query\BillingQuery;

class BillingRepository extends BaseRepository {
    /**
     * 
     * @return BillingQuery
     */
    private function createQuery() {
        return new BillingQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function findById($id){
        $builder = $this->createQuery();
        $builder->findbyid($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }

}
