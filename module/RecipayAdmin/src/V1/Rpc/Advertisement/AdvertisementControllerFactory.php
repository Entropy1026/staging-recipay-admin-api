<?php
namespace RecipayAdmin\V1\Rpc\Advertisement;

use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Advertisement\AdvertisementRepository;

class AdvertisementControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AdvertisementController(
            $container->get(AdvertisementRepository::class)
        );
    }
}

