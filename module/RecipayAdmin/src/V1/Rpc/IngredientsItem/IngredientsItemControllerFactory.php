<?php
namespace RecipayAdmin\V1\Rpc\IngredientsItem;

use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\IngredientsItem\IngredientsItemRepository;

class IngredientsItemControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new IngredientsItemController(
            $container->get(IngredientsItemRepository::class)
        );
    }
}
