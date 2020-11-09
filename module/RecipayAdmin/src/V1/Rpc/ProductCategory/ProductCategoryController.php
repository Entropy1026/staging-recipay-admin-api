<?php

namespace RecipayAdmin\V1\Rpc\ProductCategory;

// use Assert\InvalidArgumentException;
use Application\ApplicationException;
use Application\Controller\BaseLogActionController;
use Zend\View\Model\JsonModel;
use RecipayAdmin\Infra\Entity\Menu;
use RecipayAdmin\Domain\Cuisine\CuisineRepository;
use RecipayAdmin\Domain\Menu\MenuRepository;
use RecipayAdmin\Infra\Entity\Category;
use RecipayAdmin\Domain\Category\CategoryRepository;

class ProductCategoryController extends BaseLogActionController
{
 /**
     * @var MenuRepository
     */
    private $menuRepository;
        /**
     * @var CuisineRepository
     */
    private $cuisineRepository;
        /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    public function __construct(MenuRepository $menuRepository, CuisineRepository $cuisineRepository ,CategoryRepository $categoryRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->cuisineRepository = $cuisineRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function menuForReturn(Menu $menu){
       return [
        "id"=>$menu->getId(),
        "name"=>$menu->getName(),
        "img"=>$menu->getImage(),
        "description"=>$menu->getDescription(),
        "cuisine"=> ["id"=>$menu->getCuisine_id()->getId(), "name"=>$menu->getCuisine_id()->getName()]
       
       ];
    }
    public function menuList(){
        $menu =  $this->menuRepository->fetchAll();
        $forReturn = [];
        foreach($menu as $m){
          $forReturn[] = $this->menuForReturn($m);
        }
        return $forReturn;
    }
    public function menuByCuisine($id){
        $menu =  $this->menuRepository->findbycuisine($id);
        $forReturn = [];
        foreach($menu as $m){
          $forReturn[] = $this->menuForReturn($m);
        }
        return $forReturn;
    }
    public function menubycuisineAction(){
        $params = $this->getParams();
        return new JsonModel($this->menuByCuisine($params["id"]));
    }
    public function menulistAction(){
       return new JsonModel($this->menuList());
    }
    public function createmenuAction()
    {
        try {
            $params = $this->getParams();
            if($params['id']!=null){
                $cuisine = $this->cuisineRepository->findbyid($params['cuisine_id']);
                $menu = $this->menuRepository->findbyid($params['id']);
                $menu[0]->setName($params['name']);
                $menu[0]->setDescription($params['desc']);
                $menu[0]->setImage($params['fileurl']);
                $menu[0]->setCuisine_id($cuisine[0]);
                $this->menuRepository->persist($menu[0]);
                $this->menuRepository->flush();
            }
            else{
            $cuisine = $this->cuisineRepository->findbyid($params['cuisine_id']);
            $menu = new Menu($params['name'],$params['desc'],$cuisine[0],$params['fileurl']);
            $this->menuRepository->persist($menu);
            $this->menuRepository->flush();

            }
          return new JsonModel($this->menuList());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deletemenuAction()
    {
        try {
            $params = $this->getParams();
            $menu = $this->menuRepository->findbyid($params['id']);
            $this->menuRepository->remove($menu[0]);
            $this->menuRepository->flush();
            return new JsonModel($this->menuList());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    //category
    public function categoryForReturn(Category $menu){
        return [
         "id"=>$menu->getId(),
         "name"=>$menu->getName(),
         "img"=>$menu-> getPic_url() 
        ];
     }
    public function categoryList(){
        $category =  $this->categoryRepository->fetchAll();
        $forReturn = [];
        foreach($category as $c){
          $forReturn[] = $this->categoryForReturn($c);
        }
        return $forReturn;
    }
    public function categorylistAction(){
        $params = $this->getParams();
        return new JsonModel($this->categoryList());
    }
    public function createcategoryAction()
    {
        try {
            $params = $this->getParams();
            if($params['id']!=null){
                $category = $this->categoryRepository->findbyid($params['id']);
                $category[0]->setName($params['name']);
                $category[0]->setPic_url($params['fileurl']);
                $this->categoryRepository->persist($category[0]);
                $this->categoryRepository->flush();
            }
            else{
            $category = new Category($params['name'],$params['fileurl']);
            $this->categoryRepository->persist($category);
            $this->categoryRepository->flush();

            }
          return new JsonModel($this->categoryList());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deletecategoryAction()
    {
        try {
            $params = $this->getParams();
            $category = $this->categoryRepository->findbyid($params['id']);
            $this->categoryRepository->remove($category[0]);
            $this->categoryRepository->flush();
            return new JsonModel($this->categoryList());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    
}
