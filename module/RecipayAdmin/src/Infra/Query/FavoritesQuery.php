<?php 

namespace RecipayAdmin\Infra\Query;

use RecipayAdmin\Infra\Entity\Favorites;
use Doctrine\ORM\QueryBuilder;

class FavoritesQuery {

    private $qb;

    function __construct(QueryBuilder $qb) {
        $this->qb = $qb;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder() {
        return $this->qb;
    }
    public function select() {
        $qb = $this->qb;
        $qb->select("f");
        $qb->from(Favorites::class, "f");
        return $this;
    }
    public function findbyUsername($user_id) {
        $this->select();
        $qb = $this->qb;
        $qb->add('where', $qb->expr()->orX(
        $qb->expr()->eq('f.user_id', ':username')));
        $qb->setParameter('username', $user_id);
        return $this;
    }

}
