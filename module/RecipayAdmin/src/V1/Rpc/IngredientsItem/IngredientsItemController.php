<?php
namespace RecipayAdmin\V1\Rpc\IngredientsItem;

use Application\Controller\BaseLogActionController;
use RecipayAdmin\Domain\IngredientsItem\IngredientsItemRepository;
use Zend\View\Model\JsonModel;
use Application\ApplicationException;
use RecipayAdmin\Infra\Entity\IngredientsItem;


class IngredientsItemController extends BaseLogActionController
{
    private $ingredientsItemRepository;
    public function __construct(IngredientsItemRepository $ingredientsItemRepository)
    {
        $this->ingredientsItemRepository = $ingredientsItemRepository;
    }
    public function itemsForReturn(IngredientsItem $item)
    {
        return [
            "id" => $item->getId(),
            "name" => $item->getName(),
            "description" => $item->getDescription(),
            "image" => $item->getImage(),
            "unit"=>$item->getUnit(),
            "life"=>$item->getShelf_life(),
            "quantity"=> $item->getQuantity(),
            "available"=> $item->getAvailable(),
            "unique"=> $item->getIs_exist(),
            "date"=> $item->getDate_added(),
        ];
    }
    public function getIngredientsItems(){
        $ingItems = $this->ingredientsItemRepository->fetchAll();
        $forReturn = [];
        foreach ($ingItems as $i) {
            $forReturn[] = $this->itemsForReturn($i);
        }
        return $forReturn; 
    }
    public function getUniqueIngredientsItems(){
        $ingItems = $this->ingredientsItemRepository->fetchunique();
        $forReturn = [];
        foreach ($ingItems as $i) {
            $forReturn[] = $this->itemsForReturn($i);
        }
        return $forReturn; 
    }
    public function itemsAction()
    {
      return new JsonModel($this->getIngredientsItems());
    }
    public function uniqueitemsAction()
    {
      return new JsonModel($this->getUniqueIngredientsItems());
    }
    public function createAction()
    {
        $create = false;
        try {
            $params = $this->getParams();
            if($params['id']!=null){
                $items = $this->ingredientsItemRepository->findbyid($params['id']);
                $items[0]->setName($params['name']);
                $items[0]->setDescription($params['desc']);
                $items[0]->setImage($params['fileurl']);
                $items[0]->setUnit($params['unit']);
                $items[0]->setShelf_life($params['life']);
                $items[0]->setQuantity($params['quantity']);
                $items[0]->setAvailable($params['available']);
                $this->ingredientsItemRepository->persist($items[0]);
                $this->ingredientsItemRepository->flush();
            }
            else{
            $dj = date('Y-m-d');
            $today = new \DateTime($dj);
            $exist= [];
            $forReturn=[];
            $unique = 0 ;
    
            $exist = $this->ingredientsItemRepository->findbyname($params["name"]);
            $unique = count($exist) > 0 ? 1 : 0;
    
           
            $items = new IngredientsItem($params['name'],$params['desc'],$params['fileurl'],$today,$unique,$params['life'],$params['quantity'],$params['available'],$params['unit']);
            $this->ingredientsItemRepository->persist($items);
            $this->ingredientsItemRepository->flush();

            }
          return new JsonModel($this->getIngredientsItems());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    public function deleteAction()
    {
        try {
            $params = $this->getParams();
            $item = $this->ingredientsItemRepository->findbyid($params['id']);
            $this->ingredientsItemRepository->remove($item[0]);
            $this->ingredientsItemRepository->flush();
            return new JsonModel($this->getIngredientsItems());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

}
