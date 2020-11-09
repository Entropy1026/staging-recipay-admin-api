<?php
namespace RecipayAdmin\V1\Rpc\CuisineTypes;

use Application\Controller\BaseLogActionController;
use RecipayAdmin\Domain\Cuisine\CuisineRepository;
use Application\ApplicationException;
use Zend\View\Model\JsonModel;
use RecipayAdmin\Infra\Entity\CuisineTypes;

class CuisineTypesController extends BaseLogActionController
{

    /**
     * @var CuisineRepository
     */
    private $cuisineRepository;
    public function __construct(CuisineRepository $cuisineRepository)
    {
        $this->cuisineRepository = $cuisineRepository;
    }
    public function getCuisineTypes(){
        $cuisines = $this->cuisineRepository->fetchAll();
        $forReturn = [];
        foreach ($cuisines as $c) {
            $forReturn[] = $this->cuisineForReturn($c);
        }
        return $forReturn; 
    }
    public function cuisineTypesAction()
    {
      return new JsonModel($this->getCuisineTypes());
    }
    public function createAction()
    {
        $create = false;
        try {
            $params = $this->getParams();
            if($params['id']!=null){
                $create= false;
                $cuisine = $this->cuisineRepository->findbyid($params['id']);
                $cuisine[0]->setName($params['name']);
                $cuisine[0]->setDescription($params['desc']);
                $cuisine[0]->setImage($params['fileurl']);
                $this->cuisineRepository->persist($cuisine[0]);
                $this->cuisineRepository->flush();
            }
            else{
            $create = true;
            $cuisine = new CuisineTypes($params['name'],$params['desc'],$params['fileurl']);
            $this->cuisineRepository->persist($cuisine);
            $this->cuisineRepository->flush();
            }
            return new JsonModel($this->getCuisineTypes());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deleteAction()
    {
        try {
            $params = $this->getParams();
            $cuisine = $this->cuisineRepository->findbyid($params['id']);
            $this->cuisineRepository->remove($cuisine[0]);
            $this->cuisineRepository->flush();
            return new JsonModel($this->getCuisineTypes());
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }

    public function cuisineForReturn(CuisineTypes $cuisine)
    {
        return [
            "id" => $cuisine->getId(),
            "name" => $cuisine->getName(),
            "description" => $cuisine->getDescription(),
            "image" => $cuisine->getImage(),
        ];
    }
}
