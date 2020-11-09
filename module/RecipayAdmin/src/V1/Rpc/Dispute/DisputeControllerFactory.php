<?php
namespace RecipayAdmin\V1\Rpc\Dispute;

use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Messages\MessagesRepository;
use RecipayAdmin\Domain\Ratings\RatingRepository;
use RecipayIdentity\Domain\User\UserRepository;

class DisputeControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DisputeController(
            $container->get(MessagesRepository::class),
            $container->get(UserRepository::class),
            $container->get(RatingRepository::class)
        );
    }
}

