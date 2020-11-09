<?php

namespace RecipayAdmin\Domain\Messages;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Messages;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\MessagesQuery;

class MessagesRepository extends BaseRepository {
    const CACHE_TIME = 86400;
    /**
     * 
     * @return MessagesQuery
     */
    private function createQuery() {
        return new MessagesQuery($this->getEntityManager()->createQueryBuilder());
    }
  
    public function fetchAll(){
        $builder = $this->createQuery();
        $builder->fetchall();
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function fetchselected($status){
        $builder = $this->createQuery();
        $builder->fetchselected($status);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function delete($id){
        $builder = $this->createQuery();
        $builder->selectById($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findbyOrder($id){
        $builder = $this->createQuery();
        $builder->selectByOrder($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findbyid($id){
        $builder = $this->createQuery();
        $builder->selectById($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function userMessage($id){
        $builder = $this->createQuery();
        $builder->getUserMessages($id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }



}
