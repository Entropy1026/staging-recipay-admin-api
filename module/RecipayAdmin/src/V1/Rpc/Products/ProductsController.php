<?php
namespace RecipayAdmin\V1\Rpc\Products;

// use Assert\InvalidArgumentException;
use Application\Controller\BaseLogActionController;
use RecipayAdmin\Domain\Category\CategoryRepository;
use RecipayAdmin\Domain\IngredientsItem\IngredientsItemRepository;
use RecipayAdmin\Domain\Menu\MenuRepository;
use RecipayAdmin\Domain\Product\ProductIngredientsRepository;
use RecipayAdmin\Domain\Product\ProductRepository;
use RecipayAdmin\Infra\Entity\Product;
use RecipayAdmin\Infra\Entity\ProductIngredients;
use RecipayAdmin\Domain\Ratings\RatingRepository;
use RecipayAdmin\Domain\Favorites\FavoriteRepository;
use RecipayIdentity\Domain\User\UserRepository;
use Zend\View\Model\JsonModel;
use RecipayAdmin\Infra\Entity\Favorites;
use RecipayAdmin\Infra\Entity\Ratings;

class ProductsController extends BaseLogActionController
{

    // ProductIngredientsRepository
    /**
     * @var ProductIngredientsRepository
     */
    private $productIngredientsRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var IngredientsItemRepository
     */
    private $ingredientsItemRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var MenuRepository
     */
    private $menuRepository;
    /**
     * @var RatingRepository
     */
    private $ratingRepository; 
    /**
     * @var FavoriteRepository
     */
    private $favoriteRepository; 
    /**
     * @var UserRepository
     */
    private $userRepository; 
    public function __construct(ProductIngredientsRepository $productIngredientsRepository, ProductRepository $productRepository, IngredientsItemRepository $ingredientsItemRepository,
        CategoryRepository $categoryRepository, MenuRepository $menuRepository ,  FavoriteRepository $favoriteRepository , RatingRepository $ratingRepository , UserRepository $userRepository 
    ) {
        $this->productIngredientsRepository = $productIngredientsRepository;
        $this->productRepository = $productRepository;
        $this->ingredientsItemRepository = $ingredientsItemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->menuRepository = $menuRepository;
        $this->favoriteRepository = $favoriteRepository;
        $this->ratingRepository = $ratingRepository;
        $this->userRepository = $userRepository;
    }
    //START OF  Product Ingredients Functionalities
    public function productIngredientsJson($id)
    {
        $forReturn = [];
        $ingredients = $this->productIngredientsRepository->fetchbyproduct($id);
        foreach ($ingredients as $i) {
            $forReturn[] = [
                "id" => $i->getId(),
                "name" => $i->getIngredients_id()->getName(),
                "unit" => $i->getIngredients_id()->getUnit(),
                "quantity" => $i->getQuantity(),
            ];
        }
        return $forReturn;
    }
    public function productingredientslistAction()
    {

    }
    public function createProductIngredients($id, $product_id, $ingredients_id, $quantity)
    {
        if ($id) {
            $ingredient = $this->productIngredientsRepository->findbyid($id);
            $ingredient[0]->setQuantity($quantity);
            $this->productIngredientsRepository->persist($ingredient[0]);
            $this->productIngredientsRepository->flush();
        } else {
            $ingredient = $this->ingredientsItemRepository->findbyid($ingredients_id);
            $product = $this->productRepository->fetchById($product_id);
            $items = new ProductIngredients($product[0], $ingredient[0], $quantity);
            $this->productIngredientsRepository->persist($items);
            $this->productIngredientsRepository->flush();
        }

    }
    public function createproductingredientsAction()
    {
        $params = $this->getParams();
        foreach ($params['ingredients'] as $i) {
            $this->createProductIngredients($i["id"] ? $i["id"] : null, $i["product_id"], $i["ingredients_id"], $i["quantity"]);
        }

    }
    public function deleteproductingredientsAction()
    {
        $params = $this->getParams();
        $ingredient = $this->productIngredientsRepository->findbyid($params['id']);
        $this->productIngredientsRepository->remove($ingredient[0]);
        $this->productIngredientsRepository->flush();
        return new JsonModel(["success" => true]);
    }
    //END OF Product Ingredients Functionalities

    //START OF PRODUCT CRUD FUNCTIONALITIES
    public function productListJson($menu,$user)
    {
        $forReturn = [];
        $product = $this->productRepository->fetchByMenu($menu);
        foreach ($product as $p) {
            $forReturn[] = [
                "id" => $p->getId(),
                "name" => $p->getName(),
                "image" => $p->getImage(),
                "ingredients" => $this->productIngredientsJson($p->getId()),
                "text_instruction" => $p->getTextinstruction(),
                "video" => $p->getRecipevideo(),
                "price" => $p->getBaseprice(),
                "category" => $p->getCategory(),
                "sold" => $p->getSales_count(),
                "available" => $p->getStock(),
                "restock" => $p->getRestock(),
                "replinesh" => $p->getReplenish(),
                "menu" => [
                    "id" => $p->getMenu()->getId(),
                    "name" => $p->getMenu()->getName(),
                ],
                "category" => [
                    "id" => $p->getCategory()->getId(),
                    "name" => $p->getCategory()->getName(),
                ],
                "favorite"=>$this->checkfavorite($user,$p->getId()),
                "pax" => $p->getPax(),
                "rate" => $this->getratings($p->getId()),
                "comments" => $this->getComment($p->getId())
            ];
        }
        return $forReturn;
    }
    public function productlistAction()
    {
        $params = $this->getParams();
        return new JsonModel($this->productListJson($params['menu']["id"],$params['user']));
    }
    public function createproductAction()
    {
        try {
            $params = $this->getParams();
            if ($params["id"]) {
                $product = $this->productRepository->fetchById($params["id"]);
                $category = $this->categoryRepository->findbyid($params['category']['id']);
                $menu = $this->menuRepository->findbyid($params['category']['id']);
                $product[0]->setName($params["name"]);
                $product[0]->setImage($params["image"]);
                $product[0]->setTextinstruction($params["instruction"]);
                $product[0]->setRecipevideo($params["video"]);
                $product[0]->setBaseprice($params["price"]);
                $product[0]->setCategory($category[0]);
                $product[0]->setStock($params["available"]);
                $product[0]->setRestock($params["restock"]);
                $product[0]->setReplenish($params["replinesh"]);
                $product[0]->setPax($params["pax"]);
                $this->productRepository->persist($product[0]);
                $this->productRepository->flush();
                foreach ($params['ingredients'] as $i) {
                    $this->createProductIngredients($i["id"] ? $i["id"] : null, $params["id"], $i["ingredients_id"], $i["quantity"]);
                }
            } else {
                $dj = date('Y-m-d');
                $today = new \DateTime($dj);
                $category = $this->categoryRepository->findbyid($params['category']['id']);
                $menu = $this->menuRepository->findbyid($params['menu']['id']);

                $product = new Product($params['name'], $params['image'], $params["instruction"], $params["video"], $today, $menu[0], $category[0], $params["price"], $params["pax"], $params["available"], $params["restock"], $params["replinesh"], 0);
                $this->productRepository->persist($product);
                $this->productRepository->flush();
                $latest = $this->productRepository->findall();
                foreach ($params['ingredients'] as $i) {
                    $this->createProductIngredients($i["id"] ? $i["id"] : null, $latest[(count($latest) - 1)]->getId(), $i["ingredients_id"], $i["quantity"]);
                }
            }

            return new JsonModel($this->productListJson($params['menu']["id"],$params['user']));
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deleteproductAction()
    {

        $params = $this->getParams();
        $ingredient = $this->productIngredientsRepository->fetchbyproduct($params['id']);
        foreach ($ingredient as $i) {
            $this->productIngredientsRepository->remove($i);
            $this->productIngredientsRepository->flush();
        }
        $product = $this->productRepository->fetchById($params['id']);
        $this->productRepository->remove($product[0]);
        $this->productRepository->flush();
        return new JsonModel(["success" => true]);
    }

    public function replenishProductAction(){
        try {
          $params = $this->getParams();
          $product = $this->productRepository->fetchById($params['id']);
          $value = $product[0]->getStock() + $product[0]->getReplenish() ;
          $product[0]->setStock($value);
          $this->productRepository->persist($product[0]);
          $this->productRepository->flush();
          return new JsonModel($this->productListJson($params['menu']["id"],$params['user']));
        } catch (ApplicationException $ex) {
          return $this->processApplicationError($ex);
        }
     } 
    //END OF PRODUCT Functionalities


    // START OF FAVORITE
    public function checkfavorite($user, $product)
    {
        $favorites = $this->favoriteRepository->fetchFavorites($user);
        $flag = false;
        foreach ($favorites as $f) {
            if ($f->getProduct_id() == $product) {
                $flag = true;
            }
        }
        return $flag;
    }
    public function addFavoriteAction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $favorites = $this->favoriteRepository->fetchFavorites($params['user_id']);
            if ($favorites) {
                for ($i = 0; $i < count($favorites); $i++) {
                    if ($favorites[$i]->getProduct_id() == $params['prod']) {
                        $this->ratingRepository->remove($favorites[$i]);
                        $this->ratingRepository->flush();
                        $forReturn["error"] = false;
                        $forReturn["message"] = "Successfully removed from favorites";
                        return new JsonModel($forReturn);
                    }
                }
            }

            $favorite = new Favorites($params['user_id'], $params['prod']);
            $this->favoriteRepository->persist($favorite);
            $this->favoriteRepository->flush();
            $forReturn["error"] = false;
            $forReturn["message"] = "Succesfully Added to favorites";
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    // END OF FAVORITE



    // START OF RATING
    public function getratings($id)
    {
        $ratings = $this->ratingRepository->fetchRatingById($id);
        $rate = 0;
        if (count($ratings) == 0) {
            $rate = "no ratings yet";
            return $rate;
        } else {
            foreach ($ratings as $r) {
                $rate = $rate + $r->getRating();
            }
            $rate = $rate / count($ratings);
            $users = "user";
            if (count($ratings) > 1) {
                $users = "users";
            }
            $count = count($ratings);
            return "$rate out of 5 rated by $count $users";
        }
    }
    public function getComment($id)
    {
        $forReturn = [];
        $ratings = $this->ratingRepository->fetchRatingById($id);
        foreach ($ratings as $r) {
            $user = $this->userRepository->findbyId($r->getUser());
            array_push(
                $forReturn,
                [
                    "username" => $user[0]->getUser_username(),
                    "picture" => $user[0]->getUser_Image(),
                    "comment" => $r->getComment(),
                    "rating" => $r->getRating(),
                    "date" => $r->getDate('m-d-Y'),
                ]
            );
        }
        return $forReturn;
    }
    public function getUsername($id)
    {
        $user = $this->userRepository->findById($id);
        return $user[0]->getUser_username();
    }
    public function getProductname($id)
    {
        $product = $this->productRepository->findall($id);
        return $product[0]->getName();
    }
    public function fetchallRatingAction()
    {
        try {
            $review = $this->ratingRepository->fetchratings();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Review List";
            foreach ($review as $p) {
                $forReturn['data'][] = [
                    "id" => $p->getId(),
                    "user" => $this->getUsername($p->getUser()),
                    "product" => $this->getProductname($p->getRecipe()),
                    "comment" => $p->getComment(),
                    "rating" => $p->getRating(),
                    "date" => $p->getDate(),
                    "status" => $p->getStatus(),
                ];
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function selectedRatingAction()
    {
        try {
            $params = $this->getParams();
            $review = $this->ratingRepository->selectedratings($params['status']);
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Review List";
            foreach ($review as $p) {
                $forReturn['data'][] = [
                    "id" => $p->getId(),
                    "user" => $this->getUsername($p->getUser()),
                    "product" => $this->getProductname($p->getRecipe()),
                    "comment" => $p->getComment(),
                    "rating" => $p->getRating(),
                    "date" => $p->getDate(),
                    "status" => $p->getStatus(),
                ];
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    public function deleteRatingAction()
    {
        try {
            $params = $this->getParams();
            $review = $this->ratingRepository->findbyid($params['id']);
            $this->ratingRepository->remove($review[0]);
            $this->ratingRepository->flush();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Deleted Review";
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function updateRatingAction()
    {
        try {
            $params = $this->getParams();
            $review = $this->ratingRepository->findbyid($params['id']);
            $review[0]->setComment($params['comment']);
            $review[0]->setStatus('read');
            $this->ratingRepository->persist($review[0]);
            $this->ratingRepository->flush();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Updated Review";
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    public function makeReviewAction()
    {
        $forReturn = [];
        try {
            $dj = date('Y-m-d');
            $today = new \DateTime($dj);
            $params = $this->getParams();
            $rating = $this->ratingRepository->findByUserIdAndProdId($params['prod_id'], $params['user_id']);
            if (count($rating) > 0) {
                $rating[0]->setRating($params['rating']);
                $rating[0]->setComment($params['comment']);
                $rating[0]->setDate($today);
                $this->ratingRepository->persist($rating[0]);
                $this->ratingRepository->flush();
                $forReturn["error"] = false;
                $forReturn["message"] = "Succesfully Rated";
            } else {
                $product = $this->productRepository->fetchById($params['prod_id']);
                // function __construct($user ,$recipe , $comment ,$rating ,$date ,$status)
                $rating = new Ratings($params['user_id'], $product[0] , $params['comment'], $params['rating'], $today, 'unread');
                $this->ratingRepository->persist($rating);
                $this->ratingRepository->flush();
                $forReturn["error"] = false;
                $forReturn["message"] = "Succesfully Rated";
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }

    }
    // END OF RATING
}
