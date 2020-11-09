<?php

namespace RecipayAdmin\V1\Rpc\Advertisement;

use Application\Controller\BaseLogActionController;
use Zend\View\Model\JsonModel;
use Application\ApplicationException;
use RecipayAdmin\Domain\Advertisement\AdvertisementRepository;
use RecipayAdmin\Infra\Entity\Advertisement;

class AdvertisementController extends BaseLogActionController
{

    /**
     * @var AdvertisementRepository
     */
    private $advertisementRepository;
    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }
    public function fetchAAAction()
    {
        $forReturn = [];
        try {
            $ads = $this->advertisementRepository->fetchAll();
            $params = $this->getParams();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Fetch Advertisement";
            foreach ($ads as $a) {
                $forReturn['data'][] = [
                    "id" => $a->getId(),
                    "name" => $a->getName(),
                    "description" => $a->getDescription(),
                    "fileurl" => $a->getFile(),
                     "url"=>$a->getUrl(),
                    "status" => $a->getStatus(),
                    "subbed" => $a->getDate_subscribed(),
                ];
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function updateAdsaction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $ads = $this->advertisementRepository->findbyid($params['id']);
            $ads[0]->setName($params['name']);
            $ads[0]->setDescription($params['desc']);
            $ads[0]->setFile($params['fileurl']);
            $this->advertisementRepository->persist($ads[0]);
            $this->advertisementRepository->flush();
            // $a->setStatus();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Updated Advertisement";


            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function deleteAdsaction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $ads = $this->advertisementRepository->findbyid($params['id']);
            $this->advertisementRepository->remove($ads[0]);
            $this->advertisementRepository->flush();
            // $a->setStatus();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Deleted Advertisement";
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function createAdsaction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            if($params['id']!=null){
                $ads = $this->advertisementRepository->findbyid($params['id']);
                $ads[0]->setName($params['name']);
                $ads[0]->setDescription($params['desc']);
                $ads[0]->setFile($params['fileurl']);
                $this->advertisementRepository->persist($ads[0]);
                $this->advertisementRepository->flush();
                // $a->setStatus();
                $forReturn["error"] = false;
                $forReturn["message"] = "Successfully Updated Advertisement";
            }
            else{
            $dj = date('Y-m-d');
            $today = new \DateTime($dj);
            $ads = new Advertisement($params['name'],$params['desc'],$params['fileurl'],'active',$today);
            $this->advertisementRepository->persist($ads);
            $this->advertisementRepository->flush();
            // $a->setStatus();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Added Advertisement";
            }
            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
    public function updateAdstatusAction()
    {
        $forReturn = [];
        try {
            $params = $this->getParams();
            $ads = $this->advertisementRepository->findbyid($params['id']);
            $ads[0]->setStatus($params['status']);
            $this->advertisementRepository->persist($ads[0]);
            $this->advertisementRepository->flush();
            // $a->setStatus();
            $forReturn["error"] = false;
            $forReturn["message"] = "Successfully Updated Advertisement";


            return new JsonModel($forReturn);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        }
    }
}
