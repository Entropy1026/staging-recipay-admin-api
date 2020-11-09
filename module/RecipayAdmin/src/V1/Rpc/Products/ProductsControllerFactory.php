<?php
namespace RecipayAdmin\V1\Rpc\Products;

use Application\Infrastructure\Utils\UrlHandler;
use Interop\Container\ContainerInterface;
use RecipayAdmin\Domain\Product\ProductIngredientsRepository;
use RecipayAdmin\Domain\Product\ProductRepository;
use RecipayAdmin\Domain\IngredientsItem\IngredientsItemRepository;
use RecipayAdmin\Domain\Category\CategoryRepository;
use RecipayAdmin\Domain\Menu\MenuRepository;
use RecipayAdmin\Domain\Ratings\RatingRepository;
use RecipayAdmin\Domain\Favorites\FavoriteRepository;
use RecipayIdentity\Domain\User\UserRepository;

use RecipayAdmin\Domain\Advertisement\AdvertisementRepository;
use RecipayAdmin\Domain\Ingredient\IngredientRepository;


class ProductsControllerFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ProductsController(
            $container->get(ProductIngredientsRepository::class)   ,
            $container->get(ProductRepository::class) ,  
            $container->get(IngredientsItemRepository::class) ,
            $container->get(CategoryRepository::class),
            $container->get(MenuRepository::class),
            $container->get(FavoriteRepository::class),
            $container->get(RatingRepository::class),
            $container->get(UserRepository::class)
        );
    }
  

}
