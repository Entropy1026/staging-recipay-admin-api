<?php
namespace RecipayAdmin\V1\Rpc\ProductCategory;


use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Menu\MenuRepository;
use RecipayAdmin\Domain\Cuisine\CuisineRepository;
use RecipayAdmin\Domain\Category\CategoryRepository;
class ProductCategoryControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductCategoryController(
            $container->get(MenuRepository::class),
            $container->get(CuisineRepository::class),
            $container->get(CategoryRepository::class)
        );
    }
}
