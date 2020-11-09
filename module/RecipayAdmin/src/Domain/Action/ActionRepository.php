<?php

namespace RecipayAdmin\Domain\Action;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\ActionLog;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\ActionQuery;

class ActionRepository extends BaseRepository {

    /**
     * 
     * @return FavoritesQuery
     */
    private function createQuery() {
        return new ActionQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function lastlogged($user_id){
        $builder = $this->createQuery();
        $builder->lastloged($user_id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
