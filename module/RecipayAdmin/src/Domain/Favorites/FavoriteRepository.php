<?php

namespace RecipayAdmin\Domain\Favorites;

use Application\Infra\Repository\BaseRepository;
use RecipayAdmin\Infra\Entity\Favorites;
use Application\Infra\Utils\CachesNames;
use RecipayAdmin\Infra\Query\FavoritesQuery;

class FavoriteRepository extends BaseRepository {

    /**
     * 
     * @return FavoritesQuery
     */
    private function createQuery() {
        return new FavoritesQuery($this->getEntityManager()->createQueryBuilder());
    }
    public function fetchFavorites($user_id){
        $builder = $this->createQuery();
        $builder->findbyUsername($user_id);
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getResult();
    }


}
