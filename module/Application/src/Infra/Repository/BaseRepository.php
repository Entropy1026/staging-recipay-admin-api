<?php
namespace Application\Infra\Repository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
class BaseRepository {
    private $em;
    public function __construct(EntityManager $em) {
        $this->em = $em;

    }
    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->em;
    }
    public function persist($entity) {
        $this->getEntityManager()->persist($entity);
    }
    public function beginTransaction() {
        $em = $this->getEntityManager();
        $em->getConnection()->beginTransaction();
    }
    public function flush() {
        $this->getEntityManager()->flush();
    }
    public function commit() {
        $this->getEntityManager()->getConnection()->commit();
    }
    public function rollbackAndClose() {
        $this->getEntityManager()->getConnection()->rollback();
        $this->getEntityManager()->close();
    }
    public function remove($entity) {
        $this->getEntityManager()->remove($entity);
    }
    private function getFirstResult($page, $maxResult) {
        return ($page - 1) * $maxResult;
    }
    /**
     * @param $query
     * @param $currentPage
     * @param $maxResults
     * @return Query
     */
    protected function getResultPagination($query, $currentPage, $maxResults) {
        $doctrineQuery = $query->setFirstResult($this->getFirstResult($currentPage, $maxResults))
            ->setMaxResults($maxResults);
        return $doctrineQuery;
    }
}