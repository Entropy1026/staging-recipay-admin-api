<?php

namespace RecipayIdentity\Domain\User;

use Application\Infra\Repository\BaseRepository;
use RecipayIdentity\Infra\Entity\User;
use RecipayIdentity\Infra\Query\UserQuery;

class UserRepository extends BaseRepository {
    /**
     * 
     * @return UserQuery
     */
    private function createQuery() {
        return new UserQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function findUsername($username){
        $builder = $this->createQuery();
        $builder->findbyUsername($username);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findById($id){
        $builder = $this->createQuery();
        $builder->findbyid($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function getCarriers(){
        $builder = $this->createQuery();
        $builder->getcarrier();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    
    public function login($username,$password){
        $builder = $this->createQuery();
        $builder->checkLogin($username,$password);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchall(){
        $builder = $this->createQuery();
        $builder->select();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
