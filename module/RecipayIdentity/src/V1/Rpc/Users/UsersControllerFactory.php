<?php
namespace RecipayIdentity\V1\Rpc\Users;
use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Action\ActionRepository;
use RecipayAdmin\Domain\Favorites\FavoriteRepository;
use RecipayIdentity\Domain\User\UserRepository;
use RecipayMobileOrder\Domain\Order\OrderRepository;

class UsersControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new UsersController( $container->get(UserRepository::class),
        $container->get(OrderRepository::class),
        $container->get(FavoriteRepository::class),
        $container->get(ActionRepository::class));
    }
}
