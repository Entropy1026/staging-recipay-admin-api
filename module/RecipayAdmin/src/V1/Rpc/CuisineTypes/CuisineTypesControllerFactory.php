<?php
namespace RecipayAdmin\V1\Rpc\CuisineTypes;

use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Cuisine\CuisineRepository;

class CuisineTypesControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CuisineTypesController(
            $container->get(CuisineRepository::class)
        );
    }
}
